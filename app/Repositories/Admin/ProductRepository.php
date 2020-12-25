<?php


namespace App\Repositories\Admin;


use App\Repositories\MyRepository;
use Illuminate\Support\Facades\DB;

class ProductRepository extends MyRepository
{
    public function getPaginationForList()
    {
        return DB::table('product')
            ->select('product.*', 'folder.name as folder_name')
            ->join('folder', 'folder.id', '=', 'product.folder_id')
            ->whereNull('product.deleted_at')
            ->paginate(25);
    }

    public function getAllByFolderId($id)
    {
        return DB::table('product')
            ->where('folder_id', '=', $id)
            ->where('active', '=', 1)
            ->whereNull('deleted_at')
            ->get();
    }
}
