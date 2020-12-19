<?php


namespace App\Http\Controllers\Business;


use App\Http\Controllers\Controller;
use App\Http\Services\Business\FolderPageService;

class FolderPageController extends Controller
{
    private $folderPageService;

    public function __construct(FolderPageService $folderPageService)
    {
        $this->folderPageService = $folderPageService;
    }

    public function folderLevelPage($id)
    {
        return $this->folderPageService->folderLevelPage($id);
    }

}
