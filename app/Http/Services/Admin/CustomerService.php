<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerService extends MyService
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function newForm()
    {
        return view('customer.add');
    }

    public function create(Request $request)
    {
//        $validator = $this->ruleCreate($request->all());
//
//        if ($validator->fails()) {
//            return redirect()->back()->withInput()->withErrors($validator->errors());
//        }

        try {

            $customer = $this->customer->Create($request->all());
            return redirect()->intended('/system-admin/company/detail/' . $customer->id)->with('mess', 'Saved');
        } catch (\Exception $ex) {
            abort(500);
        }
    }
}
