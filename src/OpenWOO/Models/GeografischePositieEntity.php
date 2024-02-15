<?php

declare(strict_types=1);

namespace Yard\OpenWOO\Models;

class GeografischePositieEntity extends AbstractEntity
{
    protected array $required = ['Longitude', 'Latitude'];

    protected function data(): array
    {
        if (empty($this->data)) {
            return [];
        }

        $longitude = $this->data[self::PREFIX . 'Longitude'] ?? null;
        $latitude = $this->data[self::PREFIX . 'Lattitude'] ?? null;

        return [
            'Longitude' => ! empty($longitude) && is_numeric($longitude) ? (float) $longitude : '',
            'Latitude' => ! empty($latitude) && is_numeric($latitude) ? (float) $latitude : '',
        ];
    }
}
