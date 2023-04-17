<?php declare(strict_types=1);

namespace Yard\OpenWOO\Models;

class COORDSEntity extends AbstractEntity
{
    protected array $required = ['X', 'Y'];

    protected function data(): array
    {
        if (empty($this->data)) {
            return [];
        }

        return [
            'X' => ! empty($this->data[self::PREFIX . 'X']) ? (int) $this->data[self::PREFIX . 'X'] : '',
            'Y' => ! empty($this->data[self::PREFIX . 'Y']) ? (int) $this->data[self::PREFIX . 'Y'] : '',
        ];
    }
}
