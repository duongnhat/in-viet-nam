<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\models\Facebook;

class AdvertisementService extends MyService
{

    public function saveLogFacebook($input)
    {
        $facebook = new Facebook($input);
        $facebook->save();
        return $facebook;
    }
}
