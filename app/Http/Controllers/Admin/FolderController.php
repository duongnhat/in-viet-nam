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

    public function listPage()
    {
        return $this->folderService->listPage();
    }

    public function registerForm()
    {
        return $this->folderService->registerForm();
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
