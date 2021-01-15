<?php

namespace App\Http\Services\Business;

use App\Http\Services\MyService;
use App\models\RegisteredGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisteredGuestService extends MyService
{

    public function getPaginationForList()
    {
        return DB::table('registered_guest')
            ->select('registered_guest.*', 'product.name as product_name', 'product.text_domain as product_text_domain')
            ->join('product', 'product.id', '=', 'registered_guest.product_id')
            ->whereNull('registered_guest.deleted_at')
            ->paginate(25);
    }

    public function register($input)
    {
        $registeredGuest = new RegisteredGuest($input);
        $registeredGuest->save();
        return $registeredGuest;
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


    public function changeStatusValidate($request)
    {
        return $validator = Validator::make($request, [
            'status' => 'required|numeric|min:0|max:2'
        ]);
    }
}
