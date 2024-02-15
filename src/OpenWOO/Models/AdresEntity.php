<?php

declare(strict_types=1);

namespace Yard\OpenWOO\Models;

class AdresEntity extends AbstractEntity
{
    protected array $required = ['Straat__huisnummer', 'Postcode', 'Stad'];

    protected function data(): array
    {
        if (empty($this->data)) {
            return [];
        }

        return [
            'Adres' => (string) ($this->data[self::PREFIX . 'Straat__huisnummer'] ?? ''),
            'Postcode' => (string) ($this->data[self::PREFIX . 'Postcode'] ?? ''),
            'Stad' => (string) ($this->data[self::PREFIX . 'Stad'] ?? ''),
        ];
    }
}
