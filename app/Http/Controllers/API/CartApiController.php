<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class CartApiController extends Controller
{
    public function myCart(Request $request)
    {
        $carts = Cart::with('product.store', 'user')->where('users_id', $request->user()->id)->get();
        if (count($carts) <= 0)  return response()->json([
            'message' =>  'Belum ada pesanan'
        ]);
        return ResponseFormatter::success($carts, 'List keranjang berhasil ditampilkan');
    }

    public function cart($id)
    {
        $cart = Cart::with('product')->where('product_id', $id)->first();
        if (empty($cart)) {
            return ResponseFormatter::success($cart, 'Item tidak ditemukan');
        }
        return ResponseFormatter::success($cart, 'List berhasil ditampilkan');
    }

    public function addCart(Request $request)
    {
        try {
            $request->validate([
                'users_id' => 'required',
                'product_id' => 'required',
                'quantity' => 'required',
            ]);

            $cart = Cart::create([
                'users_id' => $request->users_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
            return ResponseFormatter::success($cart, 'Item keranjang berhasil di tambahkan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteAllCart()
    {
        $cart = Cart::all();
        $cart->each->delete();
        return response()->json([
            'message' =>  'List semua item keranjang berhasil dihapus'
        ]);
    }

    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        if (empty($cart)) {
            return ResponseFormatter::error('Item keranjang tidak ditemukan');
        }
        $cart->delete();
        return ResponseFormatter::success($cart, 'List item keranjang berhasil dihapus');
    }

    public function updateCart(Request $request, $id)
    {
        $data = $request->validate([
            'quantity' => 'required|integer',
        ]);
        $cart = Cart::findOrFail($id);
        $data = $request->all();
        $cart->update($data);
        return ResponseFormatter::success($cart, 'List keranjang berhasil diubah');
    }
}
