<?php

namespace App\Helpers;

use App\Models\Configuration;
use App\Facades\AppNameGetter; 


class ConfigHelper{

    public static function getAppName(){
        // $appName = AppNameGetter::getAppName();

        $appName = Configuration::where('type', 'APP_NAME')->value('valeur');
        return $appName;
    }

}