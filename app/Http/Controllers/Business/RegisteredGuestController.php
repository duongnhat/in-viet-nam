<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Services\Business\RegisteredGuestService;
use App\Http\Services\Common\ImageService;
use App\models\Product;
use App\Models\RegisteredGuest;
use App\Repositories\Admin\FolderRepository;
use App\Repositories\Admin\RegisteredGuestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisteredGuestController extends Controller
{
    private $registeredGuestService;

    public function __construct(RegisteredGuestService $registeredGuestService)
    {
        $this->registeredGuestService = $registeredGuestService;
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

        try {
//            for ($i = 0; $i < 10000; $i++) {
//                $registeredGuest = new RegisteredGuest($request->all());
//                $registeredGuest->name .= $i;
//                $registeredGuest->save();
//            }
            $registeredGuest = $this->registeredGuestService->register($request);
            $product = Product::find($registeredGuest->product_id);

            return redirect()->intended('/p/' . $product->id . '/' . strtolower(str_replace(" ", "-", $product->text_domain)))->with('messCommon', 'Đăng ký thành công!');
        } catch (\Exception $ex) {
            abort(500);
        }
    }

    public function updateForm($id)
    {
        $registeredGuest = RegisteredGuest::find($id);

        if (is_null($registeredGuest)) {
            abort(404);
        }
        $listFolderLevel3 = $this->folderRepository->getAllByLevel(3);

        return view('registered_guest.update')->with(['product' => $registeredGuest, 'listFolderLevel3' => $listFolderLevel3]);
    }

    public function update($id, Request $request)
    {
        $registeredGuest = RegisteredGuest::find($id);

        if (is_null($registeredGuest)) {
            abort(404);
        }

        $validator = $this->updateValidate($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $request->merge(['active' => ($request->has('active'))]);

        try {
            $registeredGuest->update($request->all());
            $this->imageService->storeImage($request, 'product', $registeredGuest->id);
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->intended('/admin/product/thay-doi-san-pham/' . $registeredGuest->id)->with('messCommon', 'Chỉnh sửa thành công!');
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

    private function registerValidate($request)
    {
        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:product,name,NULL,id,deleted_at,NULL",
            'folder_id' => 'required|exists:folder,id',
            'price' => 'nullable|numeric|digits_between:1,10',
            'summary' => 'required|max:190',
            'introduce' => 'max:10000',
            'code' => 'max:50',
            'text_domain' => 'required|max:50',
            'note' => 'max:500',
            'qty' => 'nullable|numeric|digits_between:1,10',
            'image' => 'required|max:10',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
    }


    private function updateValidate($request, $id)
    {
        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:product,name,$id,id,deleted_at,NULL",
            'folder_id' => 'required|exists:folder,id',
            'price' => 'nullable|numeric|digits_between:1,10',
            'summary' => 'required|max:190',
            'introduce' => 'max:10000',
            'code' => 'max:50',
            'text_domain' => 'required|max:50',
            'note' => 'max:500',
            'qty' => 'nullable|numeric|digits_between:1,10',
            'image' => 'max:10',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
    }
}
