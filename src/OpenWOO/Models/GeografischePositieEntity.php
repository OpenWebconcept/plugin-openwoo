<?php

declare(strict_types=1);

namespace Yard\OpenWOO\Models;

class GeografischePositieEntity extends AbstractEntity
{
    protected array $required = ['Longitude', 'Lattitude'];

    protected function data(): array
    {
        if (empty($this->data)) {
            return [];
        }

        $longitude = $this->data[self::PREFIX . 'Longitude'] ?? null;
        $lattitude = $this->data[self::PREFIX . 'Lattitude'] ?? null;

        return [
            'Longitude' => ! empty($longitude) && is_numeric($longitude) ? (float) $longitude : '',
            'Lattitude' => ! empty($lattitude) && is_numeric($lattitude) ? (float) $lattitude : '',
        ];
    }
}
