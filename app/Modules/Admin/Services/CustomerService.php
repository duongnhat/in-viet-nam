<?php

namespace App\Modules\Admin\Services;

class CustomerService extends MyService
{
    public function newForm()
    {
        return view('Admin::Customer.add')->with('mess', 'dfdfdf');
    }
}
