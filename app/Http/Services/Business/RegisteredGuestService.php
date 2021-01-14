<?php

namespace App\Http\Services\Business;

use App\Http\Services\MyService;
use App\models\RegisteredGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisteredGuestService extends MyService
{

    public function listPage()
    {
        $list = $this->productRepository->getPaginationForList();

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/product/quan-ly-san-pham');
        }

        return view('product.list')->with('list', $list);
    }

    public function register(Request $request)
    {
        $request->merge(['completed' => false]);
        $registeredGuest = new RegisteredGuest($request->all());
        $registeredGuest->save();
        return $registeredGuest;
    }

    public function update($registeredGuest, Request $request)
    {
    }

    public function registerValidate($request)
    {
        return $validator = Validator::make($request, [
            'product_id' => 'required|exists:product,id',
            'email' => "nullable|email|max:50",
            'phone' => 'required|max:50',
            'specification' => 'max:190',
            'note' => 'max:190',
            'qty' => 'nullable|numeric|digits_between:1,10',
        ]);
    }


    public function updateValidate($request, $id)
    {
        return $validator = Validator::make($request, [
            'product_id' => 'required|exists:product,id',
            'email' => "nullable|email|max:50",
            'phone' => 'required|max:50',
            'specification' => 'max:190',
            'note' => 'max:190',
            'qty' => 'nullable|numeric|digits_between:1,10',
        ]);
    }
}
