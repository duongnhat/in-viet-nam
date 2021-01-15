<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Services\Business\RegisteredGuestService;
use App\models\Product;
use App\Models\RegisteredGuest;
use App\Repositories\Admin\RegisteredGuestRepository;
use Illuminate\Http\Request;

class RegisteredGuestController extends Controller
{
    private $registeredGuestService;

    public function __construct(RegisteredGuestService $registeredGuestService)
    {
        $this->registeredGuestService = $registeredGuestService;
    }

    public function listPage()
    {
        $list = $this->registeredGuestService->getPaginationForList();

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/registered-guest/danh-sach-dang-ky-thong-tin-san-pham');
        }

        return view('registered_guest.list')->with('list', $list);
    }

    public function registerForm($id)
    {
        $product = Product::find($id);
        return view('business.registered-guest')->with('product', $product);
    }

    public function register(Request $request)
    {
        $validator = $this->registeredGuestService->registerValidate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $request->merge(['status' => false]);

        try {
            $registeredGuest = $this->registeredGuestService->register($request->all());
            $product = Product::find($registeredGuest->product_id);

            return redirect()->intended('/p/' . $product->id . '/' . strtolower(str_replace(" ", "-", $product->text_domain)))->with('messCommon', 'Đăng ký thành công!');
        } catch (\Exception $ex) {
            abort(500);
        }
    }

    public function changeStatus($id, $status)
    {
        $registeredGuest = RegisteredGuest::find($id);

        if (is_null($registeredGuest)) {
            return redirect()->back()->with('errorCommon', 'Chỉnh sửa thất bại!');
        }

        $validator = $this->registeredGuestService->changeStatusValidate(['status' => $status]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorCommon', 'Chỉnh sửa thất bại!');
        }

        try {
            $registeredGuest->update(['status' => $status]);
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->back()->with('messCommon', 'Chỉnh sửa thành công!');
    }

    public function delete($id)
    {
        $registeredGuest = RegisteredGuest::find($id);

        if (is_null($registeredGuest)) {
            abort(404);
        }

        try {
            $registeredGuest->delete();
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->back()->with('messCommon', 'Xóa thành công!');
    }
}
