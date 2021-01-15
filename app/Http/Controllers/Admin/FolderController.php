<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\FolderService;
use App\models\Folder;
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
        return $this->listPage(1);
    }

    public function listPage2()
    {
        return $this->listPage(2);
    }

    public function listPage3()
    {
        return $this->listPage(3);
    }

    public function registerForm1()
    {
        return $this->registerForm(1);
    }

    public function registerForm2()
    {
        return $this->registerForm(2);
    }

    public function registerForm3()
    {
        return $this->registerForm(3);
    }

    private function listPage($level)
    {
        $list = $this->folderService->getPaginationForList($level);

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/folder/quan-ly-thu-muc/' . $level);
        }

        return view('folder.list')->with(['list' => $list, 'level' => $level]);
    }

    public function registerForm($level)
    {
        $list = $this->folderService->getAllByLevel($level - 1);
        return view('folder.add')->with(['level' => $level, 'listFolder' => $list]);
    }

    public function register(Request $request)
    {
        $validator = $this->folderService->registerValidate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $folder = $this->folderService->register($request->all());

            return redirect()->intended('/admin/folder/chinh-sua-thu-muc/' . $folder->id)->with('messCommon', 'Tạo mới thành công!');
        } catch (\Exception $ex) {
            abort(500);
        }
    }

    public function updateForm($id)
    {
        $folder = Folder::find($id);

        if (is_null($folder)) {
            abort(404);
        }

        $list = $this->folderService->getAllByLevel($folder->level - 1);

        return view('folder.update')->with(['folder' => $folder, 'listFolder' => $list]);
    }

    public function update($id, Request $request)
    {
        $folder = Folder::find($id);

        if (is_null($folder)) {
            abort(404);
        }

        $validator = $this->folderService->updateValidate($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $folder->update($request->all());
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->intended('/admin/folder/chinh-sua-thu-muc/' . $folder->id)->with('messCommon', 'Chỉnh sửa thành công!');
    }

    public function delete($id)
    {
        $folder = Folder::find($id);

        if (is_null($folder)) {
            abort(404);
        }

        try {
            $folder->delete();
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->back()->with('messCommon', 'Xóa thành công!');
    }
}
