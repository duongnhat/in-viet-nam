<?php

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Services\Contract\MyService;

class CustomerService extends MyService
{
    public function newForm()
    {
        return view('Admin::Customer.add')->with('mess', 'dfdfdf');
    }
}
