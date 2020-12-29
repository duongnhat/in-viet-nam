<?php


namespace App\Http\Services\Business;


use App\Http\Services\MyService;
use App\models\Folder;
use App\models\Product;
use App\Repositories\Admin\ImageRepository;
use App\Repositories\Admin\ProductRepository;

class ProductPageService extends MyService
{
    private $productRepository;
    private $imageRepository;

    public function __construct(ProductRepository $productRepository, ImageRepository $imageRepository)
    {
        $this->productRepository = $productRepository;
        $this->imageRepository = $imageRepository;
    }

    public function productByFolderPage($folderId)
    {
        $folderFather = Folder::find($folderId);

        if (is_null($folderFather)) {
            abort(404);
        }

        $list = $this->productRepository->getAllByFolderId($folderId);
        $listImage = $this->imageRepository->getAllByFolderId($folderId);

        return view('business.list-product-by-folder')->with(['list' => $list, 'listImage' => $listImage, 'folderFather' => $folderFather]);
    }

    public function productDetailPage($productId)
    {
        $product = Product::find($productId);

        if (is_null($product)) {
            abort(404);
        }

        $listImage = $this->imageRepository->getAllByProductId($productId);

        return view('business.product-detail')->with(['listImage' => $listImage, 'product' => $product]);
    }
}
