<?php


namespace App\Http\Controllers\Business;


use App\Http\Controllers\Controller;
use App\Http\Services\Business\HomeService;

class HomeController extends Controller
{
    private $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function homePage()
    {
        return $this->homeService->homePage();
    }

}
