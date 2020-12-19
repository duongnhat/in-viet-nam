<?php


namespace App\Http\Services\Business;


use App\Http\Services\MyService;
use App\models\Folder;
use App\Repositories\Admin\FolderRepository;

class FolderPageService extends MyService
{
    private $folderRepository;

    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    public function folderLevelPage($id)
    {
        $folder = Folder::find($id);

        if (is_null($folder)) {
            abort(404);
        }

        $listFolder = $this->folderRepository->getAllChildById($id);
        return view('business.home')->with('listFolder', $listFolder);
    }
}
