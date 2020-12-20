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
//            for ($i = 0; $i < 10000; $i++) {
//                $customer = new Customer($request->all());
//                $customer->name .= $i;
//                $customer->save();
//            }
            $customer = new Customer($request->all());
            $customer->save();

            return redirect()->intended('/admin/customer/thay-doi-thong-tin-khach-hang/' . $customer->id)->with('messCommon', 'Tạo mới thành công!');
        } catch (\Exception $ex) {
            abort(500);
        }
    }

    public function updateForm($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            abort(404);
        }

        return view('customer.update')->with('customer', $customer);
    }

    public function update($id, Request $request)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            abort(404);
        }

        $validator = $this->updateValidate($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $customer->update($request->all());
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->intended('/admin/customer/thay-doi-thong-tin-khach-hang/' . $customer->id)->with('messCommon', 'Chỉnh sửa thành công!');
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
        return redirect()->back()->with('messCommon', 'Xóa thành công!');
    }

    private function registerValidate($request)
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


    private function updateValidate($request, $id)
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
