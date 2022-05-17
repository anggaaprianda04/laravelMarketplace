<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::with('store', 'category')->get();
        try {
            if ($products) {
                foreach ($products as $item) {
                    $item->image = url(Storage::url($item->image));
                }
                return ResponseFormatter::success($products, 'Data semua produk berhasil diambil');
            } else {
                return ResponseFormatter::error('null', 'Tidak ada produk', 404);
            }
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th);
        }
    }

    public function product($id){
        $product = Product::with('store')->find($id);
        if($product){
            $product->image = url(Storage::url($product->image));
            return ResponseFormatter::success($product,'Data produk berhasil diambil');
        } else if(empty($product)) {
            return ResponseFormatter::error([
                'message' => 'Produk tidak ditemukan',
            ],'Not Found');
        }
    }

    public function limits()
    {
        $products = Product::take(6)->with('store', 'category')->get();
        try {
            if ($products) {
                foreach($products as $item){
                    $item->image = url(Storage::url($item->image));
                }
                return ResponseFormatter::success(
                    $products,
                    'Data list produk berhasil diambil'
                );
            }
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th);
        }
    }
}
