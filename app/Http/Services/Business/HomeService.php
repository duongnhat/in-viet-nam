<?php


namespace App\Http\Services\Business;


use App\Http\Services\MyService;
use App\Repositories\Admin\FolderRepository;

class HomeService extends MyService
{
    private $folderRepository;

    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    public function homePage()
    {
        $listFolder = $this->folderRepository->getAllByLevel(1);
        return view('business.home')->with('listFolder', $listFolder);
    }
}
