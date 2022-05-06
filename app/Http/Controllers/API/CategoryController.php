<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(){
        $category = CategoryProduct::with('products')->get();
        return ResponseFormatter::success($category, 'Data semua kategori berhasil diambil');
    }
}
