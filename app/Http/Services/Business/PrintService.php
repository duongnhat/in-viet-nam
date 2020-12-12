<?php


namespace App\Http\Services\Business;


use App\Http\Services\MyService;

class PrintService extends MyService
{
    public function __construct()
    {
    }

    public function home()
    {
        return view('business.home');
    }
}
