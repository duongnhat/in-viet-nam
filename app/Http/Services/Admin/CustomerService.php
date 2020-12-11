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

    public function listPage()
    {
        return view('customer.list')->with('list', Customer::paginate(15));
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

        for ($i = 0; $i<1000; $i++){
            $customer = new Customer($request->all());
            $customer->save();
        }
//        try {
//            return redirect()->intended('/system-admin/company/detail/' . $customer->id)->with('mess', 'Saved');
//        } catch (\Exception $ex) {
//            abort(500);
//        }
        return view('customer.add');
    }
}
