<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\AdvertisementService;
use App\models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertisementController extends Controller
{

    private $advertisementService;

    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function createNewsProduct($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            abort(404);
        }
        return view('advertisement.social_networking')->with('product', $product);
    }

    public function saveLogFacebook(Request $request)
    {
        \Illuminate\Support\Facades\Session::put('access_token_facebook', $request->input('access_token_facebook'));

        $product = Product::find($request->input('product_id'));

        if (is_null($product)) {
            return 'false';
        }

        try {
            $this->advertisementService->saveLogFacebook($request->all());
        } catch (\Exception $ex) {
            return 'false';
        }
        return 'true';
    }

    public function saveLogZalo(Request $request)
    {
        \Illuminate\Support\Facades\Session::put('access_token_zalo', $request->input('access_token_zalo'));

        $product = Product::find($request->input('product_id'));

        if (is_null($product)) {
            return 'false';
        }

        try {
            $this->advertisementService->saveLogZalo($request->all());
        } catch (\Exception $ex) {
            return 'false';
        }
        return 'true';
    }
}
