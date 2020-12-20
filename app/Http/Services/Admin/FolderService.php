<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\Models\Folder;
use App\Repositories\Admin\FolderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FolderService extends MyService
{

    private $folderRepository;

    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    public function listPage($level)
    {
        $list = $this->folderRepository->getPaginationForList($level);

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/folder/quan-ly-thu-muc/' . $level);
        }

        return view('folder.list')->with(['list' => $list, 'level' => $level]);
    }

    public function registerForm($level)
    {
        $list = $this->folderRepository->getAllByLevel($level - 1);
        return view('folder.add')->with(['level' => $level, 'listFolder' => $list]);
    }

    public function register(Request $request)
    {
        $validator = $this->registerValidate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
//            for ($i = 0; $i < 10000; $i++) {
//                $folder = new Folder($request->all());
//                $folder->name .= $i;
//                $folder->save();
//            }
            $folder = new Folder($request->all());
            $folder->save();

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

        $list = $this->folderRepository->getAllByLevel($folder->level - 1);

        return view('folder.update')->with(['folder' => $folder, 'listFolder' => $list]);
    }

    public function update($id, Request $request)
    {
        $folder = Folder::find($id);

        if (is_null($folder)) {
            abort(404);
        }

        $validator = $this->updateValidate($request->all(), $id);

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

    private function registerValidate($request)
    {
        $folderFatherId = 'nullable|exists:folder,id';

        if ($request['level'] != 1) {
            $folderFatherId = 'required|exists:folder,id';
        }

        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:folder,name,NULL,id,deleted_at,NULL",
            'folder_father_id' => $folderFatherId,
            'level' => 'required|numeric|min:1|max:3',
            'text_domain' => 'required|max:50',
            'description' => 'max:500',
        ]);
    }


    private function updateValidate($request, $id)
    {
        $folderFatherId = 'nullable|exists:folder,id';

        if ($request['level'] != 1) {
            $folderFatherId = 'required|exists:folder,id';
        }

        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:folder,name,$id,id,deleted_at,NULL",
            'folder_father_id' => "$folderFatherId|not_in:$id",
            'level' => 'required|numeric|min:1|max:3',
            'text_domain' => 'required|max:50',
            'description' => 'max:500',
        ]);
    }
}
