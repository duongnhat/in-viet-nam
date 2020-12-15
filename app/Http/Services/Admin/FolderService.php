<?php

namespace App\Http\Services\Admin;

use App\Http\Services\MyService;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FolderService extends MyService
{

    public function listPage()
    {
        $list = Folder::paginate(25);

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/folder/quan-ly-thu-muc');
        }

        return view('folder.list')->with('list', $list);
    }

    public function registerForm()
    {
        $list = Folder::all();
        return view('folder.add')->with('listFolder', $list);
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

            return redirect()->intended('/admin/folder/chinh-sua-thu-muc/' . $folder->id)->with('registed', true);
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

        $list = Folder::all();

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
        return redirect()->intended('/admin/folder/chinh-sua-thu-muc/' . $folder->id)->with('updated', true);
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
        return redirect()->back()->with('deleted', true);
    }

    private function registerValidate($request)
    {
        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:folder,name,NULL,id,deleted_at,NULL",
            'folder_father_id' => 'nullable|exists:folder,id',
            'description' => 'max:500',
        ]);
    }


    private function updateValidate($request, $id)
    {
        return $validator = Validator::make($request, [
            'name' => "required|max:50|unique:folder,name,$id,id,deleted_at,NULL",
            'folder_father_id' => "nullable|exists:folder,id|not_in:$id",
            'description' => 'max:500',
        ]);
    }
}
