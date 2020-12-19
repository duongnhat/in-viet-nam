<?php


namespace App\Http\Controllers\Business;


use App\Http\Controllers\Controller;
use App\Http\Services\Business\PrintService;

class HomeController extends Controller
{
    private $printService;

    public function __construct(F $printService)
    {
        $this->printService = $printService;
    }

    public function home()
    {
        return $this->printService->home();
    }

}
