<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductService extends MyService
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

    public function register($input)
    {
        $product = new Product($input);
        $product->save();
        return $product;
    }

    public function registerValidate($request)
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


    public function updateValidate($request, $id)
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
