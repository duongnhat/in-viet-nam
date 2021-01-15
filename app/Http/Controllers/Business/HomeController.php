<?php


namespace App\Http\Controllers\Business;


use App\Http\Controllers\Controller;
use App\Http\Services\Admin\FolderService;

class HomeController extends Controller
{
    private $folderService;

    public function __construct(FolderService $folderService)
    {
        $this->folderService = $folderService;
    }

    public function homePage()
    {
        $listFolder = $this->folderService->getAllByLevel(1);
        return view('business.home')->with('listFolder', $listFolder);
    }
}
