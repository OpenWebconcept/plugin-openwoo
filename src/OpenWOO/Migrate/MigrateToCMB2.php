<?php

namespace Yard\OpenWOO\Migrate;

use WP_CLI;
use Yard\OpenWOO\Traits\GravityFormsUploadToMediaLibrary;

class MigrateToCMB2
{
    use GravityFormsUploadToMediaLibrary;

    private const COMMAND = 'openwoo migrate-to-cmb2';

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
            'shortdesc' => 'Migrate Metabox.io values from old to new format so they can work with CMB2',
        ]);
    }

    public function migrate(): void
    {
        $posts = $this->getPosts();

        if (empty($posts)) {
            WP_CLI::error('No openwoo items found, stopping the execution of this command.');
        }

        $this->updatePosts($posts);
    }

    private function getPosts(): array
    {
        $query = new \WP_Query([
            'post_type'      => 'openwoo-item',
            'post_status'    => ['publish', 'draft'],
            'posts_per_page' => -1
        ]);

        return $query->posts;
    }
    
    private function updatePosts(array $posts): void
    {
        foreach ($posts as $post) {
            $this->formatAddress($post);
            $this->replaceSingleAttachmentsIDs($post);
            $this->replaceMultipleAttachmentsURLs($post);
        }
    }

    /**
     * Address should be a multidimensional array.
     * Validate and format when necessary.
     */
    protected function formatAddress(\WP_Post $post)
    {
        $address = \get_post_meta($post->ID, 'woo_Adres', true);

        // When value is empty or already a multidimensional just return.
        if (empty($address) || (! empty($address[0]) && is_array($address[0]))) {
            return;
        }
        
        // When all the values of the group are not set.
        if (! isset($address['woo_Straat__huisnummer']) && ! isset($address['woo_Postcode']) && ! isset($address['woo_Stad'])) {
            return;
        }

        \update_post_meta($post->ID, 'woo_Adres', [$address]);
    }

    /**
     * Must be used for meta fields that have an attachment ID.
     * Replace attachment ID with an attachment URL.
     */
    private function replaceSingleAttachmentsIDs(\WP_Post $post)
    {
        $keys = [
            'woo_Bijlage_informatieverzoek',
            'woo_Bijlage_inventarisatielijst',
            'woo_Bijlage_besluit',
        ];

        $newMeta = $this->getSingleAttachmentsURLs($this->getOldMeta($post, $keys));
        $this->updatePost($post, $newMeta);
    }

    private function getSingleAttachmentsURLs(array $oldMeta): array
    {
        $newMeta = [];

        foreach ($oldMeta as $key => $value) {
            if (empty($value)) {
                continue;
            }

            $attachmentURL = \wp_get_attachment_url($value);

            if (empty($attachmentURL)) {
                continue;
            }

            $newMeta[$key] = $attachmentURL;
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

    private function replaceMultipleAttachmentsURLs(\WP_Post $post): void
    {
        $keys = [
            'woo_Bijlagen'
        ];

        $oldMeta = $this->getOldMeta($post, $keys);
        
        if (empty($oldMeta['woo_Bijlagen']) || ! is_array($oldMeta['woo_Bijlagen'])) {
            return;
        }

        \update_post_meta($post->ID, 'woo_Bijlagen', $this->handleMultipleAttachments($oldMeta['woo_Bijlagen']));
    }

    private function handleMultipleAttachments(array $attachments): array
    {
        $holder = [];

        foreach ($attachments as $attachment) {
            if (empty($attachment['woo_Bijlage'])) {
                $holder[] = $attachment;

                continue;
            }

            if (is_array($attachment['woo_Bijlage']) && ! empty($attachment['woo_Bijlage'][0])) { // When attachment is saved in an array.
                $attachmentURL = \wp_get_attachment_url($attachment['woo_Bijlage'][0]);
            } else {
                $attachmentURL = \wp_get_attachment_url($attachment['woo_Bijlage']);
            }
            
            if (! $attachmentURL) {
                $holder[] = $attachment;
                
                continue;
            }

            $attachment['woo_Bijlage'] = $attachmentURL;
            $attachment['woo_Titel_Bijlage'] = basename($attachmentURL);
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
}
