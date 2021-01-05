<?php

namespace App\Http\Services\Admin;

use App\Http\Services\Common\ImageService;
use App\Http\Services\MyService;
use App\Models\Product;
use App\Repositories\Admin\FolderRepository;
use App\Repositories\Admin\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdvertisementService extends MyService
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

    public function createNewsProduct($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            abort(404);
        }
        return view('advertisement.social_networking')->with('product', $product);
    }
}
