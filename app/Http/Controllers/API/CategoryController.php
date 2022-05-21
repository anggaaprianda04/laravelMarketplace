<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;

class CategoryController extends Controller
{
    public function categories(){
        $categories = CategoryProduct::all();
        return ResponseFormatter::success($categories, 'Data semua kategori berhasil diambil');
    }

    public function category($id){
        $category = CategoryProduct::with('products')->find($id);
        return ResponseFormatter::success($category,'Data kategori berhasil diambil');
    }
}
