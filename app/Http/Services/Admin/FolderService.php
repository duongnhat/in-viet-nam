<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FolderService extends MyService
{

    public function getPaginationForList($level)
    {
        return DB::table('folder')
            ->select('folder.*', 'folder_father.name as folder_father_name', 'folder_father.text_domain as folder_father_text_domain')
            ->leftJoin('folder as folder_father', 'folder_father.id', '=', 'folder.folder_father_id')
            ->whereNull('folder.deleted_at')
//            ->whereNull('folder_father.deleted_at')
            ->where('folder.level', '=', $level)
            ->paginate(25);
    }

    public function getAllByLevel($level)
    {
        return Folder::where('level', '=', $level)->get();
    }

    public function getAllChildById($id)
    {
        return DB::table('folder')
            ->select('folder.*', 'image.path as image_path', 'image.name_to_store as image_name_to_store')
            ->leftJoin('image', 'image.folder_id', '=', 'folder.id')
            ->where('folder_father_id', '=', $id)
            ->whereNull('folder.deleted_at')
            ->paginate(25);
    }

    public function register($input)
    {
        $folder = new Folder($input);
        $folder->save();
        return $folder;
    }

    public function registerValidate($request)
    {
        $folderFatherId = 'nullable|exists:folder,id';

        if ($request['level'] != 1) {
            $folderFatherId = 'required|exists:folder,id';
        }

        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:folder,name,NULL,id,deleted_at,NULL",
            'folder_father_id' => $folderFatherId,
            'level' => 'required|numeric|min:1|max:3',
            'text_domain' => 'required|max:50',
            'description' => 'max:500',
            'image' => 'max:1',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
    }


    public function updateValidate($request, $id)
    {
        $folderFatherId = 'nullable|exists:folder,id';

        if ($request['level'] != 1) {
            $folderFatherId = 'required|exists:folder,id';
        }

        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:folder,name,$id,id,deleted_at,NULL",
            'folder_father_id' => "$folderFatherId|not_in:$id",
            'level' => 'required|numeric|min:1|max:3',
            'text_domain' => 'required|max:50',
            'description' => 'max:500',
            'image' => 'max:1',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
    }
}
