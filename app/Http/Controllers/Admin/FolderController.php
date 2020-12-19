<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\FolderService;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    private $folderService;

    public function __construct(FolderService $folderService)
    {
        $this->folderService = $folderService;
    }

    public function listPage1()
    {
        return $this->folderService->listPage(1);
    }

    public function listPage2()
    {
        return $this->folderService->listPage(2);
    }

    public function listPage3()
    {
        return $this->folderService->listPage(3);
    }

    public function registerForm1()
    {
        return $this->folderService->registerForm(1);
    }

    public function registerForm2()
    {
        return $this->folderService->registerForm(2);
    }

    public function registerForm3()
    {
        return $this->folderService->registerForm(3);
    }

    public function register(Request $request)
    {
        return $this->folderService->register($request);
    }

    public function updateForm($id)
    {
        return $this->folderService->updateForm($id);
    }

    public function update($id, Request $request)
    {
        return $this->folderService->update($id, $request);
    }

    public function delete($id)
    {
        return $this->folderService->delete($id);
    }
}
