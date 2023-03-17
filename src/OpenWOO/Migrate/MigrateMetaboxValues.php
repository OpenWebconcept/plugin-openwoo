<?php

namespace Yard\OpenWOO\Migrate;

use WP_CLI;
use Yard\OpenWOO\Traits\GravityFormsUploadToMediaLibrary;

class MigrateMetaboxValues
{
    use GravityFormsUploadToMediaLibrary;

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

        WP_CLI::add_command(self::COMMAND, $this, [
            'shortdesc' => 'Migrate metabox values from old to new format',
        ]);
    }

    public function migrate(): void
    {
        $posts = $this->getPosts();

        if (empty($posts)) {
            WP_CLI::error('No openwoo items found, stopping the execution of this command.');
        }

        $this->updatePosts($posts);

        WP_CLI::log('Migration completed, don\'t forget to clear the old uploads inside the Gravity Forms uploads folder.');
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
            $this->replaceOldMetaKeys($post);

            if (! \is_plugin_active('gravityforms/gravityforms.php')) {
                continue;
            }
            
            $this->replaceSingleAttachmentsURLs($post);
            $this->replaceMultipleAttachmentsURLs($post);
        }
    }

    private function replaceMultipleAttachmentsURLs(\WP_Post $post): void
    {
        $keys = [
            'woo_Bijlagen'
        ];

        $oldMeta = $this->getOldMeta($post, $keys);
        
        if (empty($oldMeta['woo_Bijlagen'])) {
            return;
        }

        \update_post_meta($post->ID, 'woo_Bijlagen', $this->handleMultipleAttachments($oldMeta['woo_Bijlagen']));
    }

    private function handleMultipleAttachments(array $attachments): array
    {
        $holder = [];

        foreach ($attachments as $attachment) {
            if (empty($attachment['woo_URL_Bijlage'])) {
                $holder[] = $attachment;

                continue;
            }

            $attachmentID = $this->gravityFormsUploadToMediaLibrary($attachment['woo_URL_Bijlage']);

            if (! $attachmentID) {
                $holder[] = $attachment;
                
                continue;
            }

            $attachment['woo_Bijlage'] = $attachmentID;
            unset($attachment['woo_URL_Bijlage']);
            $holder[] = $attachment;
        }

        return $holder;
    }

    /**
     * Only update the meta keys.
     * Some form fields have been renamed.
     */
    private function replaceOldMetaKeys(\WP_Post $post): void
    {
        $keys = [
            'woo_ID' => 'woo_Kenmerk',
            'woo_Titel' => 'woo_Onderwerp'
        ];

        $oldMeta = $this->getOldMeta($post, array_keys($keys));

        foreach ($keys as $key => $replacementKey) {
            $containedValue = $oldMeta[$key] ?? '';

            if (empty($containedValue)) {
                continue;
            }
            
            \delete_post_meta($post->ID, $key); // Delete old row with old meta key.
            \update_post_meta($post->ID, $replacementKey, $containedValue); // Create new row with new meta key.
        }
    }

    /**
     * Replaces meta keys and values as well.
     * Must be used for meta fields that have an URL as plain string value only.
     */
    private function replaceSingleAttachmentsURLs(\WP_Post $post)
    {
        $keys = [
            'woo_URL_informatieverzoek',
            'woo_URL_inventarisatielijst',
            'woo_URL_besluit',
        ];

        $newMeta = $this->getSingleAttachmentsURLs($this->getOldMeta($post, $keys));
        $this->updatePost($post, $newMeta);

        foreach ($this->getKeysOfReplacedMeta($keys, $newMeta) as $key) {
            \delete_post_meta($post->ID, $key);
        }
    }

    /**
     * Use the old Gravity Forms upload URL and save upload to the Wordpress uploads folder.
     * This enables the editors to update or delete uploads with using the Wordpress uploader.
     */
    private function getSingleAttachmentsURLs(array $oldMeta): array
    {
        $newMeta = [];

        foreach ($oldMeta as $key => $value) {
            if (empty($value)) {
                continue;
            }

            $attachmentID = $this->gravityFormsUploadToMediaLibrary($value);

            if (empty($attachmentID)) {
                continue;
            }

            $newKey = str_replace('URL', 'Bijlage', $key);
            $newMeta[$newKey] = $attachmentID;
        }

        return $newMeta;
    }

    private function getOldMeta(\WP_Post $post, array $keys): array
    {
        $meta = [];

        foreach ($keys as $key) {
            $meta[$key] = \get_post_meta($post->ID, $key, true);
        }

        return array_filter($meta);
    }

    private function updatePost(\WP_Post $post, array $newMeta): void
    {
        foreach ($newMeta as $key => $value) {
            \update_post_meta($post->ID, $key, $value);
        }
    }

    /**
     * Return the keys which are replaced in the new meta.
     * Replaced keys can be used to delete old post meta safely.
     */
    protected function getKeysOfReplacedMeta(array $keys, array $newMeta): array
    {
        return array_filter($keys, function ($key) use ($newMeta) {
            $newKey = str_replace('URL', 'Bijlage', $key);
            return ! empty($newMeta[$newKey]);
        });
    }
}
