<?php

namespace Yard\OpenWOO\Migrate;

function dd($data): void
{
    echo "<pre>";
    print_r($data);
    exit;
}

class MigrateMetaboxValues
{
    private const COMMAND = 'openwoo migrate-metabox-values';

    public function __invoke($args, $assocArgs)
    {
        $this->migrate();
    }
    
    public function register(): void
    {
        if (! class_exists('WP_CLI')) {
            return;
        }

        \WP_CLI::add_command(self::COMMAND, $this, [
            'shortdesc' => 'Migrate metabox values from old to new format',
        ]);
    }

    public function migrate(): void
    {
        $posts = $this->getPosts();
        $this->updatePosts($posts);
    }

    private function getPosts(): array
    {
        $query = new \WP_Query([
            'post_type'      => 'openwoo-item',
            'post_status'    => 'any',
            'posts_per_page' => -1,
        ]);

        return $query->posts;
    }
    
    private function updatePosts(array $posts): void
    {
        foreach ($posts as $post) {
            $newMeta = $this->getNewMeta($this->getOldMeta($post));
            $this->updatePost($post, $newMeta);
        }
    }

    private function getOldMeta(\WP_Post $post): array
    {
        $keys = [
            'woo_URL_informatieverzoek',
            'woo_URL_inventarisatielijst',
            'woo_URL_besluit',
        ];

        $meta = [];

        foreach ($keys as $key) {
            $meta[$key] = \get_post_meta($post->ID, $key, true);
        }

        return $meta;
    }

    private function getNewMeta(array $oldMeta): array
    {
        $newMeta = [];

        foreach ($oldMeta as $key => $value) {
            if (empty($value)) {
                continue;
            }

            $attachmentID = $this->gfFormsMediaURLToAttachmentID($value);

            if (empty($attachmentID)) {
                continue;
            }

            $newKey = str_replace('URL', 'Bijlage', $key);
            $newMeta[$newKey] = $attachmentID;
        }

        return $newMeta;
    }

    private function updatePost(\WP_Post $post, array $newMeta): void
    {
        foreach ($newMeta as $key => $value) {
            \update_post_meta($post->ID, $key, $value);
        }
    }

    private function gfFormsMediaURLToAttachmentID(string $url): int
    {
        // get the "gf-download" parameter from the url
        $urlParts = parse_url($url);
        parse_str($urlParts['query'] ?? '', $query);
        $gfDownload = $query['gf-download'] ?? '';

        if (empty($gfDownload)) {
            return 0;
        }

        // Remove the "YYYY/MM/" part from the "gf-download" parameter.
        $mediaUrl = \get_site_url() . '/wp-content/uploads/' . $gfDownload;

        // Get the attachment id from the "gf-download" parameter.
        $attachmentID = \attachment_url_to_postid($mediaUrl);

        if (0 !== $attachmentID) {
            return $attachmentID;
        }

        // Try again but add -scaled to the end before the extension.
        $mediaUrl = preg_replace('/(\.[a-z0-9]+)$/', '-scaled$1', $mediaUrl);
        $attachmentID = \attachment_url_to_postid($mediaUrl);

        return $attachmentID;
    }
}
