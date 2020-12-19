<?php


namespace App\Repositories\Admin;


use App\models\Folder;
use App\Repositories\MyRepository;
use Illuminate\Support\Facades\DB;

class FolderRepository extends MyRepository
{
    public function getPaginationForList($level)
    {
        return DB::table('folder')
            ->select('folder.*', 'folder_father.name as folder_father_name')
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
        return Folder::where('folder_father_id', '=', $id)->get();
    }
}
