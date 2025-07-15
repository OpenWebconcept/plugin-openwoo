<?php

declare(strict_types=1);

namespace Yard\OpenWOO\Models;

class BijlageEntity extends AbstractEntity
{
    protected array $required = ['Titel_Bijlage', 'URL_Bijlage'];

    public function getTime(): string
    {
        $date = $this->data[self::PREFIX . 'Tijdstip_laatste_wijziging_bijlage']['timestamp'] ?? '';

        if (empty($date)) {
            return '';
        }

        return (new \DateTime())->setTimestamp((int) $date)->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d\TH:i:s');
    }

    protected function data(): array
    {
        return [
            'Type_Bijlage' => $this->data[self::PREFIX . 'Type_Bijlage'] ?? '',
            'Status_Bijlage' => $this->data[self::PREFIX . 'Status_Bijlage'] ?? '',
            'Tijdstip_laatste_wijziging_bijlage' => $this->getTime(),
            'Titel_Bijlage' => $this->data[self::PREFIX . 'Titel_Bijlage'] ?? '',
            'URL_Bijlage' => $this->getAttachmentURL(),
            'Grootte_Bijlage' => $this->getFileSize()
        ];
    }

    /**
     * Tries different ways to retrieve the URL in the following order:
     * - 'woo_Bijlage_id' (is set when the post is saved in the editor)
     * - 'woo_Bijlage' (other applications might use the 'woo_Bijlage' field to insert the URL to the attachment directly)
     * - 'woo_URL_Bijlage' (is used when there is no file uploaded directly in to Wordpress)
     */
    protected function getAttachmentURL(): string
    {
        // First try by using the 'woo_Bijlage_id' field.
        $url = \wp_get_attachment_url($this->getAttachmentObjectID()) ?: '';

        if (is_string($url) && 0 < strlen($url)) {
            return $url;
        }

        // Secondly try by using the 'woo_Bijlage' field.
        $objectID = $this->data[self::PREFIX . 'Bijlage'] ?? '';

        if (is_array($objectID)) {
            $objectID = $objectID[0];
        }

        if (empty($objectID)) {
            return $this->data[self::PREFIX . 'URL_Bijlage'] ?? ''; // Still empty? Try 'woo_URL_Bijlage' field.
        }

        if (! is_numeric($objectID)) { // If it is not an numeric value than it is an URL already.
            return $objectID;
        }

        return \wp_get_attachment_url($objectID) ?: '';
    }

    protected function getFileSize(): int
    {
        // First try by using the 'woo_Bijlage_id' field.
        $attachedFile = \get_attached_file($this->getAttachmentObjectID());

        if (! empty($attachedFile)) {
            return \wp_filesize($attachedFile);
        }

        // Secondly try by using the 'woo_Bijlage' field.
        $attachedFileURL = $this->getAttachmentURL();
        $objectID = \attachment_url_to_postid($attachedFileURL);
        $attachedFile = \get_attached_file($objectID);

        return $attachedFile ? \wp_filesize($attachedFile) : 0;
    }

    protected function getAttachmentObjectID(): int
    {
        $objectID = $this->data[self::PREFIX . 'Bijlage_id'] ?? '';

        if (is_array($objectID)) {
            $objectID = $objectID[0] ?? 0;
        }

        if (empty($objectID) || ! is_numeric($objectID)) {
            return 0;
        }

        return $objectID;
    }
}
