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

    public function productByFolderPage($folderId, $currentProductId)
    {
        $folderFather = Folder::find($folderId);

        if (is_null($folderFather)) {
            abort(404);
        }

        $list = $this->productService->getAllByFolderId($folderId);
        $currentProduct = null;
        foreach ($list as $product) {
            if ($currentProductId != 0) {
                foreach ($list as $product) {
                    if ($product->id == $currentProductId) {
                        $currentProduct = $product;
                        break;
                    }
                }
            } else {
                $currentProduct = $product;
                break;
            }
        }
        $listImage = $this->imageService->getAllByFolderId($folderId);

        return view('business.list-product-by-folder')->with(['list' => $list, 'currentProduct' => $currentProduct, 'listImage' => $listImage, 'folderFather' => $folderFather]);
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
