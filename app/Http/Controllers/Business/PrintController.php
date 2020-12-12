<?php


namespace App\Http\Controllers\Business;


use App\Http\Controllers\Controller;
use App\Http\Services\Business\PrintService;

class PrintController extends Controller
{
    private $printService;

    public function __construct(PrintService $printService)
    {
        $this->printService = $printService;
    }

    public function home()
    {
        return $this->printService->home();
    }

}
