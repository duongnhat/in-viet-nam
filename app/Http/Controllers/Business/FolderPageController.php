<?php


namespace App\Http\Controllers\Business;


use App\Http\Controllers\Controller;
use App\Http\Services\Admin\FolderService;
use App\models\Folder;

class FolderPageController extends Controller
{
    private $folderService;

    public function __construct(FolderService $folderService)
    {
        $this->folderService = $folderService;
    }

    public function folderLevelPage($id)
    {
        $folder = Folder::find($id);

        if (is_null($folder)) {
            abort(404);
        }

        $listFolder = $this->folderService->getAllChildById($id);
        return view('business.folder-level')->with(['listFolder' => $listFolder, 'folderFather' => $folder]);
    }
}
