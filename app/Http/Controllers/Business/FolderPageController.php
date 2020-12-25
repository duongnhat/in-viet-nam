<?php


namespace App\Http\Controllers\Business;


use App\Http\Controllers\Controller;
use App\Http\Services\Business\FolderPageService;
use App\models\Folder;

class FolderPageController extends Controller
{
    private $folderPageService;

    public function __construct(FolderPageService $folderPageService)
    {
        $this->folderPageService = $folderPageService;
    }

    public function folderLevelPage($id)
    {
        $folder = Folder::find($id);

        if (is_null($folder)) {
            abort(404);
        }

        if ($folder->level == 3) {
        }
        return $this->folderPageService->folderLevelPage($id, $folder);
    }

}
