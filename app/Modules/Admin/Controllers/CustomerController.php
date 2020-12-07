<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Services\CustomerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function newForm()
    {
        return $this->customerService->newForm();
    }
}
