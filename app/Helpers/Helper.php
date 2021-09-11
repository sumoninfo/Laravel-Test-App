<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper
{
    /**
     * return auth user
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function getAuth()
    {
        return Auth::user();
    }
}
