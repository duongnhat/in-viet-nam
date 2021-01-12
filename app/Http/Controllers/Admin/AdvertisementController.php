<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\AdvertisementService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertisementController extends Controller
{
    private $advertisementService;

    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function createNewsProduct($id)
    {
        return $this->advertisementService->createNewsProduct($id);
    }

    public function saveLogFacebook(Request $request)
    {
        return $this->advertisementService->saveLogFacebook($request);
    }
}
