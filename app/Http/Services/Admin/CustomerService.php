<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerService extends MyService
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function listPage()
    {
        $list = Customer::paginate(25);

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/customer/theo-doi-thong-tin-khach-hang');
        }

        return view('customer.list')->with('list', $list);
    }

    public function registerForm()
    {
        return view('customer.add');
    }

    public function register(Request $request)
    {
        $validator = $this->registerValidate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            for ($i = 0; $i < 1000; $i++) {
                $customer = new Customer($request->all());
                $customer->save();
            }
//            return redirect()->intended('/system-admin/company/detail/' . $customer->id)->with('mess', 'Saved');
        } catch (\Exception $ex) {
            abort(500);
        }
        return view('customer.add');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            abort(404);
        }
        try {
            $customer->delete();
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->back()->with('deleted', true);
    }

    private function registerValidate($request)
    {
        return $validator = Validator::make($request, [
            'phone' => 'max:50',
            'email' => "nullable|email|max:50|unique:customer,email",
            'name' => "required|max:50",
            'phone' => 'max:50',
            'address' => 'max:190',
            'day_month' => 'max:50',
            'info_contact' => 'max:190',
            'note' => 'max:500',
        ]);
    }


    private function updateValidate($request, $id)
    {
        return $validator = Validator::make($request, [
            'email' => "required|email|max:190|unique:company,email,$id,id,deleted_at,NULL",
            'name' => "required|max:190|unique:company,name,$id,id,deleted_at,NULL",
            'business_plan_id' => 'required|max:190',
            'phone' => 'max:190',
            'address' => 'max:190',
        ]);
    }
}
