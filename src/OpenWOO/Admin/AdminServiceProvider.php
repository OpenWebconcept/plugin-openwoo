<?php

namespace Yard\OpenWOO\Admin;

use OWC\OpenPub\Base\Settings\SettingsPageOptions;
use WP_Post;
use Yard\OpenWOO\Foundation\Plugin;
use Yard\OpenWOO\Foundation\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    protected SettingsPageOptions $settings;

    public function __construct(Plugin $plugin)
    {
        parent::__construct($plugin);
        $this->settings = SettingsPageOptions::make();
    }
    
    public function register(): void
    {
        $this->plugin->loader->addFilter('post_type_link', $this, 'filterPostLink', 10, 4);
        $this->plugin->loader->addFilter('preview_post_link', $this, 'filterPreviewLink', 10, 2);
        $this->plugin->loader->addAction('rest_prepare_openwoo-item', $this, 'filterPreviewInNewTabLink', 10, 2);
    }

    /**
     * Change the url for preview of published posts in the portal.
     */
    public function filterPostLink(string $link, WP_Post $post, bool $leavename, $sample): string
    {
        if ($post->post_type !== 'openwoo-item' || ! $this->settings->getPortalURL()) {
            return $link;
        }

        return $this->composePortalURL($post) ? $this->composePortalURL($post) : $link;
    }

    /**
     * Change the url for preview of draft posts in the portal.
     */
    public function filterPreviewLink(string $link, WP_Post $post): string
    {
        if ($post->post_type !== 'openwoo-item'  || ! $this->settings->getPortalURL()) {
            return $link;
        }

        return $this->composePortalURL($post) ? sprintf('%s%s', $this->composePortalURL($post), '?draft-preview=true') : $link;
    }

    /**
     * Change the url of "preview in new tab" button for preview in the portal.
     */
    public function filterPreviewInNewTabLink(\WP_REST_Response $response, WP_Post $post): \WP_REST_Response
    {
        if ($post->post_status === 'publish' || ! $this->settings->getPortalURL()) {
            return $response;
        }

        if (! $this->composePortalURL($post)) {
            return $response;
        }

        $response->data['link'] = $this->composePortalURL($post) . "?draft-preview=true";

        return $response;
    }

    protected function composePortalURL(WP_Post $post): string
    {
        $urlParts = array_filter([
            \untrailingslashit($this->settings->getPortalURL()),
            'openwoo',
            \sanitize_title(get_post_meta($post->ID, 'woo_Onderwerp', true)),
            get_post_meta($post->ID, 'woo_UUID', true)
        ]);

        if (count($urlParts) < 4) {
            return '';
        }

        return vsprintf('%s/%s/%s/%s', $urlParts);
    }
}
