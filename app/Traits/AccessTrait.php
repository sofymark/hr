<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

trait AccessTrait
{
    /**
     * Callback function for columns and search rendering purposes
     * @return boolean
     */
    public static function canAccessRoles()
    {
        return self::canAccess();
    }

    public static function canAccess()
    {
        return true;
    }

    public static function canNotAccess()
    {
        return false;
    }
}
