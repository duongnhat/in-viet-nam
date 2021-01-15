<?php


namespace App\Http\Controllers\Business;


use App\Http\Controllers\Controller;
use App\Http\Services\Admin\ProductService;
use App\Http\Services\Common\ImageService;
use App\models\Folder;
use App\models\Product;

class ProductPageController extends Controller
{
    private $productService;
    private $imageService;

    public function __construct(ProductService $productService, ImageService $imageService)
    {
        $this->productService = $productService;
        $this->imageService = $imageService;
    }

    public function productByFolderPage($folderId)
    {
        $folderFather = Folder::find($folderId);

        if (is_null($folderFather)) {
            abort(404);
        }

        $list = $this->productService->getAllByFolderId($folderId);
        $listImage = $this->imageService->getAllByFolderId($folderId);

        return view('business.list-product-by-folder')->with(['list' => $list, 'listImage' => $listImage, 'folderFather' => $folderFather]);
    }

    public function productDetailPage($productId)
    {
        $product = Product::find($productId);

        if (is_null($product)) {
            abort(404);
        }

        $listImage = $this->imageService->getAllByProductId($productId);

        return view('business.product-detail')->with(['listImage' => $listImage, 'product' => $product]);
    }
}
