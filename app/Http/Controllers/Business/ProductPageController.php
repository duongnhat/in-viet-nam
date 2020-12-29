<?php


namespace App\Http\Controllers\Business;


use App\Http\Controllers\Controller;
use App\Http\Services\Business\ProductPageService;

class ProductPageController extends Controller
{
    private $productPageService;

    public function __construct(ProductPageService $productPageService)
    {
        $this->productPageService = $productPageService;
    }

    public function productByFolderPage($folderId)
    {
        return $this->productPageService->productByFolderPage($folderId);
    }

    public function productDetailPage($productId)
    {
        return $this->productPageService->productDetailPage($productId);
    }
}
