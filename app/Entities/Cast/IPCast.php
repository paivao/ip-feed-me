<?php

namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

// The class must inherit the CodeIgniter\Entity\Cast\BaseCast class
class IPCast extends BaseCast
{
    public static function get($value, array $params = []): string
    {
        $l = strlen($value);
        if ($l == 4 || $l == 16) {
            return inet_ntop(pack("A" . $l, $value));
        }
        //return inet_ntop($value);
        return "";
    }

    public static function set($value, array $params = []): string
    {
        return inet_pton($value);
    }
}
