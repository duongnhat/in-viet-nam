<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\CustomerService;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
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
        $validator = $this->customerService->registerValidate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $customer = $this->customerService->register($request->all());

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

        $validator = $this->customerService->updateValidate($request->all(), $id);

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
}
