<?php


namespace App\Http\Services\Business;


use App\Http\Services\MyService;
use App\Repositories\Admin\FolderRepository;

class FolderPageService extends MyService
{
    private $folderRepository;

    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    public function folderLevelPage($id, $folder)
    {
        $listFolder = $this->folderRepository->getAllChildById($id);
        return view('business.folder-level')->with(['listFolder' => $listFolder, 'folderFather' => $folder]);
    }
}
