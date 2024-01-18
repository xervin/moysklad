<?php

namespace App\Services\MoySklad\Helper;

class MetaHref
{
    public static function cutId(string $href): ?string
    {
        $res = explode('/', $href);
        return array_pop($res);
    }
}
