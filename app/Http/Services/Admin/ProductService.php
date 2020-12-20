<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductService extends MyService
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function listPage()
    {
        $list = Product::paginate(25);

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/product/quan-ly-san-pham');
        }

        return view('product.list')->with('list', $list);
    }

    public function registerForm()
    {
        return view('product.add')->with('test', 'ewioruewiorjelksfjsdlkf');
    }

    public function register(Request $request)
    {
//        dd($request->all());
        $validator = $this->registerValidate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
//            for ($i = 0; $i < 10000; $i++) {
//                $product = new Product($request->all());
//                $product->name .= $i;
//                $product->save();
//            }
            $product = new Product($request->all());
            $product->save();

            return redirect()->intended('/admin/product/thay-doi-san-pham/' . $product->id)->with('messCommon', 'Tạo mới thành công!');
        } catch (\Exception $ex) {
            abort(500);
        }
    }

    public function updateForm($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            abort(404);
        }

        return view('product.update')->with('product', $product);
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            abort(404);
        }

        $validator = $this->updateValidate($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $product->update($request->all());
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->intended('/admin/product/thay-doi-san-pham/' . $product->id)->with('messCommon', 'Chỉnh sửa thành công!');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            abort(404);
        }

        try {
            $product->delete();
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->back()->with('messCommon', 'Xóa thành công!');
    }

    private function registerValidate($request)
    {
        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:product,name,NULL,id,deleted_at,NULL",
            'price' => 'nullable|numeric|digits_between:1,10',
            'introduce' => 'max:10000',
            'code' => 'max:50',
            'text_domain' => 'required|max:50',
            'note' => 'max:500',
            'qty' => 'nullable|numeric|digits_between:1,10',
            'active' => 'accepted',
        ]);
    }


    private function updateValidate($request, $id)
    {
        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:product,name,$id,id,deleted_at,NULL",
            'price' => 'nullable|numeric|digits_between:1,10',
            'introduce' => 'max:10000',
            'code' => 'max:50',
            'text_domain' => 'required|max:50',
            'note' => 'max:500',
            'qty' => 'nullable|numeric|digits_between:1,10',
            'active' => 'accepted',
        ]);
    }
}
