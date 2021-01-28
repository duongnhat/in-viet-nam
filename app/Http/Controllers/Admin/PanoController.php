<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\PanoService;
use App\Http\Services\Common\ImageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanoController extends Controller
{
    private $panoService;
    private $imageService;

    public function __construct(PanoService $panoService, ImageService $imageService)
    {
        $this->panoService = $panoService;
        $this->imageService = $imageService;
    }

    public function listPage()
    {
        $list = $this->panoService->getPaginationForList();

        if ($list->count() == 0 && $list->currentPage() > 1) {
            return redirect()->intended('/admin/pano/quan-ly-pano');
        }

        return view('pano.list')->with('list', $list);
    }

    public function registerForm()
    {
        return view('pano.add');
    }

    public function register(Request $request)
    {
        $validator = $this->panoService->registerValidate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $this->imageService->storeImage($request, 'pano', $request->input('pano_id'));

            return redirect()->intended('/admin/pano/quan-ly-pano')->with('messCommon', 'Tạo mới thành công!');
        } catch (\Exception $ex) {
            abort(500);
        }
    }

    public function delete($id)
    {
        try {
            $this->imageService->delete($id);
        } catch (\Exception $ex) {
            abort(500);
        }
        return redirect()->back()->with('messCommon', 'Xóa thành công!');
    }
}
