<?php declare(strict_types=1);

namespace Yard\OpenWOO\ElasticPress;

use ElasticPress\Elasticsearch;
use ElasticPress\Indexable\Post\Post;
use WP_Post;
use WP_Query;
use Yard\OpenWOO\Foundation\Config;
use Yard\OpenWOO\Repository\OpenWOORepository;

class OpenWOOIndexable extends Post
{
    public $slug = 'openwob-item';
    protected OpenWOORepository $repository;
    protected Config $config;
    protected array $labels;

    /**
     * Create indexable and initialize dependencies
     */
    public function __construct(OpenWOORepository $repository, Config $config)
    {
        $this->config = $config;
        $this->labels = [
            'plural'   => esc_html__('OpenWOO items', OWO_LANGUAGE_DOMAIN),
            'singular' => esc_html__('OpenWOO item', OWO_LANGUAGE_DOMAIN),
        ];
        $this->repository = $repository;
        $this->sync_manager = new OpenWOOSyncManager($this->slug);
    }

    /**
     * Send mapping to Elasticsearch
     *
     * @since  3.0
     *
     * @return array
     */
    public function put_mapping($return_type = 'bool')
    {
        $mapping = require $this->config->get('elasticpress.mapping.file');

        return Elasticsearch::factory()->put_mapping($this->get_index_name(), $mapping, $return_type);
    }

    /**
     * Get the name of the index. Each indexable needs a unique index name
     *
     * @param  int $siteID `null` means current blog.
     *
     * @return string
     */
    public function get_index_name($blog_id = null)
    {
        $siteUrl = pathinfo(get_site_url());
        $siteBasename = $siteUrl['basename'];

        if (defined('EP_INDEX_PREFIX') && EP_INDEX_PREFIX) {
            $siteBasename = EP_INDEX_PREFIX . '--' . $siteBasename;
        }

        $buildIndexName = array_filter(
            [
                $siteBasename .'-openwoo',
                $blog_id,
                $this->getEnvironmentVariable(),
            ]
        );

        return implode('--', $buildIndexName);
    }

    protected function getEnvironmentVariable(): string
    {
        return $_ENV['APP_ENV'] ?? '';
    }

    /**
     * Prepare a post for syncing
     *
     * @param int $post_id Post ID.
     *
     * @return bool|array
     */
    public function prepare_document($post_id)
    {
        $post = get_post($post_id);

        if (empty($post)) {
            return false;
        }

        $post_date = $post->post_date;
        $post_date_gmt = $post->post_date_gmt;
        $post_modified = $post->post_modified;
        $post_modified_gmt = $post->post_modified_gmt;

        // To prevent infinite loop, we don't queue when updated_postmeta.
        remove_action('updated_postmeta', [ $this->sync_manager, 'action_queue_meta_sync' ], 10);

        $post_args = [
            'ID'                    => $post_id,
            'post_date'             => $post_date,
            'post_date_gmt'         => $post_date_gmt,
            'title'                 => $post->post_title,
            'excerpt'               => $post->post_excerpt,
            'content'               => $this->prepare_meta_types($this->prepare_meta($post)), // post_meta removed in 2.4
            'post_name'             => $post->post_name,
            'post_modified'         => $post_modified,
            'post_modified_gmt'     => $post_modified_gmt,
            'post_type'             => $post->post_type,
            'post_mime_type'        => $post->post_mime_type,
            'permalink'             => $this->convertPermalink($post) ?:\get_permalink($post_id),
            'meta'                  => $this->prepare_meta_types($this->prepare_meta($post)), // post_meta removed in 2.4
        ];

        // Turn back on updated_postmeta hook
        add_action('updated_postmeta', [ $this->sync_manager, 'action_queue_meta_sync' ], 10, 4);

        return $post_args;
    }

    /**
     * When an OpenWOO item is indexed.
     * The permalink should point to the portal website.
     */
    protected function convertPermalink(WP_Post $post): ?string
    {
        $options = get_option('_owc_openpub_base_settings');

        if (! is_array($options) || empty($options['_owc_setting_portal_url'])) {
            return null;
        }

        $UUID = get_post_meta($post->ID, 'woo_UUID', true);

        if (empty($UUID)) {
            return null;
        }

        return sprintf('%s/openwoo/%s/%s/', $options['_owc_setting_portal_url'], $post->post_name, $UUID);
    }

    /**
     * Query database for posts
     *
     * @param  array $args Query DB args
     *
     * @return array
     */
    public function query_db($args)
    {
        $items = $this->repository
            ->query(apply_filters('yard/openwoo/rest-api/items/query', [
                'post_type'           => ['openwoo-item'],
                'posts_per_page'      => $this->get_bulk_items_per_page(),
                'post_status'         => $this->get_indexable_post_status(),
                'ignore_sticky_posts' => true,
                'orderby'             => 'ID',
                'order'               => 'desc',
            ]));

        $args = array_merge($args, $items->getQueryArgs());
        $query = new WP_Query($args);

        return [
            'objects'       => $query->posts ?? [],
            'total_objects' => $query->found_posts,
        ];
    }

    /**
     * Returns indexable post types for the current site
     *
     * @since 0.9
     *
     * @return mixed|void
     */
    public function get_indexable_post_types()
    {
        $post_types = parent::get_indexable_post_types();
        unset($post_types['openwoo-item']);
        $post_types = apply_filters('ep_indexable_post_types', $post_types);

        return ['openwoo-item'];
    }
}
