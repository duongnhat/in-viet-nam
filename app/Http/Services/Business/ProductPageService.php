<?php


namespace App\Http\Services\Business;


use App\Http\Services\MyService;
use App\models\Folder;
use App\Repositories\Admin\ProductRepository;

class ProductPageService extends MyService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function productByFolderPage($folderId)
    {
        $folderFather = Folder::find($folderId);

        if (is_null($folderFather)) {
            abort(404);
        }

        $list = $this->productRepository->getAllByFolderId($folderId);
        return view('business.list-product-by-folder')->with(['list' => $list, 'folderFather' => $folderFather]);
    }
}
