<?php


namespace App\Repositories\Admin;


use App\Repositories\MyRepository;
use Illuminate\Support\Facades\DB;

class ImageRepository extends MyRepository
{

    public function getAllByFolderId($id)
    {
        return DB::table('image')
            ->select('image.*')
            ->join('product', 'image.product_id', '=', 'product.id')
            ->where('product.folder_id', '=', $id)
            ->where('product.active', '=', 1)
            ->whereNull('product.deleted_at')
            ->get();
    }
}
