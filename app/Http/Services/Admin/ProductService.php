<?php

namespace App\Http\Services\Admin;

use App\Http\Services\Common\ImageService;
use App\Http\Services\MyService;
use App\Models\Product;
use App\Repositories\Admin\FolderRepository;
use App\Repositories\Admin\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductService extends MyService
{
    private $product;
    private $imageService;
    private $folderRepository;
    private $productRepository;

    public function __construct(Product $product, ImageService $imageService, FolderRepository $folderRepository, ProductRepository $productRepository)
    {
        $this->product = $product;
        $this->imageService = $imageService;
        $this->folderRepository = $folderRepository;
        $this->productRepository = $productRepository;
    }

    public function listPage()
    {
        $list = $this->productRepository->getPaginationForList();

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/product/quan-ly-san-pham');
        }

        return view('product.list')->with('list', $list);
    }

    public function registerForm()
    {
        $listFolderLevel3 = $this->folderRepository->getAllByLevel(3);
        return view('product.add')->with('listFolderLevel3', $listFolderLevel3);
    }

    public function register(Request $request)
    {
        $validator = $this->registerValidate($request->all());

        if ($validator->fails()) {
//            dd($validator->errors());
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $request->merge(['active' => ($request->has('active'))]);

        try {
//            for ($i = 0; $i < 10000; $i++) {
//                $product = new Product($request->all());
//                $product->name .= $i;
//                $product->save();
//            }
            $product = new Product($request->all());
            $product->save();

            $this->imageService->storeImage($request, 'product', $product->id);

            return redirect()->intended('/admin/product/thay-doi-san-pham/' . $product->id)->with('messCommon', 'Tạo mới thành công!');
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            abort(500);
        }
    }

    public function updateForm($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            abort(404);
        }
        $listFolderLevel3 = $this->folderRepository->getAllByLevel(3);

        return view('product.update')->with(['product' => $product, 'listFolderLevel3' => $listFolderLevel3]);
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

        $request->merge(['active' => ($request->has('active'))]);

        try {
            $product->update($request->all());
            $this->imageService->storeImage($request, 'product', $product->id);
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
