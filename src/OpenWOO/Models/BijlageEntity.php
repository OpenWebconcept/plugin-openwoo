<?php declare(strict_types=1);

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
            'URL_Bijlage' => $this->getAttachmentURL() ? $this->getAttachmentURL() : $this->data[self::PREFIX . 'URL_Bijlage'] ?? ''
        ];
    }

    /**
     * Wordpress uploads are connected in the database by an object its ID.
     * Use this ID to get the URL of the upload.
     */
    protected function getAttachmentURL(): string
    {
        $objectID = $this->data[self::PREFIX . 'Bijlage'] ?? '';

        if (is_array($objectID)) {
            $objectID = $objectID[0];
        }

        if (empty($objectID)) {
            return '';
        }

        if (! is_numeric($objectID)) {
            return $objectID;
        }

        return \wp_get_attachment_url($objectID) ?: '';
    }
}
