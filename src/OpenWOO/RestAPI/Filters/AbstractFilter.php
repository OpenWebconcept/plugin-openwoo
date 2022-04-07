<?php declare(strict_types=1);

namespace Yard\OpenWOO\RestAPI\Filters;

abstract class AbstractFilter
{
    /** @var [] */
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    abstract public function getQuery(): array;
}
