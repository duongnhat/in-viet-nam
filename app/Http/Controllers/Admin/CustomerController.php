<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\CustomerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function registerForm()
    {
        return $this->customerService->registerForm();
    }

    public function register(Request $request)
    {
        return $this->customerService->register($request);
    }
}
