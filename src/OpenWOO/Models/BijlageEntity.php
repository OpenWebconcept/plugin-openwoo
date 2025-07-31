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
     * Retrieve the attachment URL by trying several meta fields in the following order:
     * - 'woo_Bijlage_id' (is set when the post is saved in the editor)
     * - 'woo_Bijlage' (other applications might use the 'woo_Bijlage' field to insert the URL to the attachment directly)
     * - 'woo_URL_Bijlage' (is used when there is no file uploaded directly in to Wordpress)
     */
    protected function getAttachmentURL(): string
    {
        // 1. Try 'woo_Bijlage_id'
        if ($url = $this->getUrlFromAttachmentId()) {
            return $url;
        }

        // 2. Try 'woo_Bijlage'
        if ($url = $this->getUrlFromBijlage()) {
            return $url;
        }

        // 3. Try 'woo_URL_Bijlage'
        return $this->getUrlFromUrlBijlage();
    }

    /**
     * Try to get URL from 'woo_Bijlage_id'.
     */
    private function getUrlFromAttachmentId(): ?string
    {
        $url = wp_get_attachment_url($this->getAttachmentObjectID()) ?: '';

        return $this->isValidUrl($url) ? $url : null;
    }

    /**
     * Try to get URL from 'woo_Bijlage'.
     * - If it's numeric, treat it as attachment ID.
     * - If it's a string (non-numeric), treat it as URL.
     */
    private function getUrlFromBijlage(): ?string
    {
        $objectID = $this->data[self::PREFIX . 'Bijlage'] ?? '';

        // Handle array values: take first element.
        if (is_array($objectID) && isset($objectID[0])) {
            $objectID = (string) ($objectID[0] ?? '');
        } else {
            $objectID = (string) $objectID;
        }

        if (empty($objectID) || ! is_string($objectID)) {
            return null;
        }

        // If it's a non-numeric string, treat it as URL.
        if (! is_numeric($objectID)) {
            return $objectID;
        }

        // Is numeric, try to get attachment URL.
        $url = wp_get_attachment_url((int) $objectID) ?: '';

        return $this->isValidUrl($url) ? $url : null;
    }

    /**
     * Try to get URL from 'woo_URL_Bijlage'.
     */
    private function getUrlFromUrlBijlage(): string
    {
        return (string) ($this->data[self::PREFIX . 'URL_Bijlage'] ?? '');
    }

    /**
     * Validate if URL is a non-empty string.
     */
    private function isValidUrl(?string $url): bool
    {
        return is_string($url) && strlen($url) > 0;
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
