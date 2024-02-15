<?php

declare(strict_types=1);

namespace Yard\OpenWOO\Models;

class COORDSEntity extends AbstractEntity
{
    protected array $required = ['X', 'Y'];

    protected function data(): array
    {
        if (empty($this->data)) {
            return [];
        }

        $x = $this->data[self::PREFIX . 'X'] ?? null;
        $y = $this->data[self::PREFIX . 'Y'] ?? null;

        return [
            'X' => ! empty($x) && is_numeric($x) ? (float) $x : '',
            'Y' => ! empty($y) && is_numeric($y) ? (float) $y : '',
        ];
    }
}
