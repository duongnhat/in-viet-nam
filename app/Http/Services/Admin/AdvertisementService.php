<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\models\Facebook;
use App\models\Zalo;

class AdvertisementService extends MyService
{

    public function saveLogFacebook($input)
    {
        $facebook = new Facebook($input);
        $facebook->save();
        return $facebook;
    }

    public function saveLogZalo($input)
    {
        $zalo = new Zalo($input);
        $zalo->save();
        return $zalo;
    }
}
