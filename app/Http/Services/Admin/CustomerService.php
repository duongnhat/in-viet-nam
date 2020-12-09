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

    public function registerForm()
    {
        return view('customer.add');
    }

    public function register(Request $request)
    {
//        $validator = $this->ruleCreate($request->all());
//
//        if ($validator->fails()) {
//            return redirect()->back()->withInput()->withErrors($validator->errors());
//        }
        $this->customer->register($request->all());
//        try {
////dd($request->all());
//            $request->except('_token');
//            $customer = Customer::create($request->all());
////            $customer = $this->customer->create($request->all());
//            return redirect()->intended('/system-admin/company/detail/' . $customer->id)->with('mess', 'Saved');
//        } catch (\Exception $ex) {
//            abort(500);
//        }
    }
}
