<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerService extends MyService
{

    public function register($input)
    {
        $customer = new Customer($input);
        $customer->save();
        return $customer;
    }

    public function registerValidate($request)
    {
        return $validator = Validator::make($request, [
            'email' => "nullable|email|max:50",
            'name' => "required|max:50|unique:customer,name,NULL,id,deleted_at,NULL",
            'phone' => 'max:50',
            'address' => 'max:190',
            'day_month' => 'max:50',
            'info_contact' => 'max:190',
            'note' => 'max:500',
        ]);
    }


    public function updateValidate($request, $id)
    {
        return $validator = Validator::make($request, [
            'email' => "nullable|email|max:50",
            'name' => "required|max:50|unique:customer,name,$id,id,deleted_at,NULL",
            'phone' => 'max:50',
            'address' => 'max:190',
            'day_month' => 'max:50',
            'info_contact' => 'max:190',
            'note' => 'max:500',
        ]);
    }
}
