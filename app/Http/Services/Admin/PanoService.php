<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PanoService extends MyService
{

    public function getPaginationForList()
    {
        return DB::table('image')
            ->whereNotNull('pano_id')
            ->orderBy('pano_id')
            ->paginate(25);
    }

    public function registerValidate($request)
    {
        return $validator = Validator::make($request, [
            'pano_id' => 'required',
            'image' => 'required|max:10',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
    }
}
