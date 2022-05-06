<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::with('store','category')->get();
        try {
            if ($products) {
                return ResponseFormatter::success($products, 'Data Semua Produk berhasil diambil');
            } else {
                return ResponseFormatter::error('null', 'Tidak ada Produk', 404);
            }
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th);
        }
    }

    public function limits(Request $request)
    {
        $limit = $request->input('limit',6);

        $products = Product::with('store','category');
        return ResponseFormatter::success(
            $products->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }
}
