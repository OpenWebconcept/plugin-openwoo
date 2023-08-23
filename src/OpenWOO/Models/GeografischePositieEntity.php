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

        return [
            'Longitude' => ! empty($this->data[self::PREFIX . 'Longitude']) ? (float) $this->data[self::PREFIX . 'Longitude'] : '',
            'Latitude' => ! empty($this->data[self::PREFIX . 'Lattitude']) ? (float) $this->data[self::PREFIX . 'Lattitude'] : '',
        ];
    }
}
