<?php

namespace App\Enums;

final class EPermissionNameEnum
{
    // parse permission
    public static function parsePermission($routeName)
    {
        $routeName = str_replace('-', '', $routeName);

        return str_replace('.', '-', $routeName);
    }
}
