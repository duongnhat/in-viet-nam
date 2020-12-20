<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\ProductService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function listPage()
    {
        return $this->productService->listPage();
    }

    public function registerForm()
    {
        return $this->productService->registerForm();
    }

    public function register(Request $request)
    {
        return $this->productService->register($request);
    }

    public function updateForm($id)
    {
        return $this->productService->updateForm($id);
    }

    public function update($id, Request $request)
    {
        return $this->productService->update($id, $request);
    }

    public function delete($id)
    {
        return $this->productService->delete($id);
    }
}
