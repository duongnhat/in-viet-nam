<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\FolderService;
use App\Http\Services\Admin\ProductService;
use App\Http\Services\Common\ImageService;
use App\models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $productService;
    private $imageService;
    private $folderService;

    public function __construct(ProductService $productService, ImageService $imageService, FolderService $folderService)
    {
        $this->productService = $productService;
        $this->imageService = $imageService;
        $this->folderService = $folderService;
    }

    public function listPage()
    {
        $list = $this->productService->getPaginationForList();

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/product/quan-ly-san-pham');
        }

        return view('product.list')->with('list', $list);
    }

    public function registerForm()
    {
        $listFolderLevel2 = $this->folderService->getAllByLevel(2);
        return view('product.add')->with('listFolderLevel3', $listFolderLevel2);
    }

    public function register(Request $request)
    {
        $validator = $this->productService->registerValidate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $request->merge(['active' => ($request->has('active'))]);

        try {
            $product = $this->productService->register($request->all());

            $this->imageService->storeImage($request, 'product', $product->id);

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
        $listFolderLevel3 = $this->folderService->getAllByLevel(3);

        return view('product.update')->with(['product' => $product, 'listFolderLevel3' => $listFolderLevel3]);
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            abort(404);
        }

        $validator = $this->productService->updateValidate($request->all(), $id);

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
}
