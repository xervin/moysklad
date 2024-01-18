<?php

namespace App\Services\MoySklad\VO;

readonly class TableRow
{
    public function __construct(
        public ?string $name = null,
        public string|array|null $value = null
    )
    {}
}
