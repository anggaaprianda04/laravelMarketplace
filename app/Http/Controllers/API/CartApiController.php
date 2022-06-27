<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartApiController extends Controller
{
    public function myCart(Request $request)
    {
        $carts = Cart::with('product', 'user')->where('users_id', $request->user()->id)->get();
        if ($carts) {
            foreach ($carts as $item) {
                $imageProduct = $item->product;
                if ($imageProduct->image) {
                    $imageProduct->image = url(Storage::url($imageProduct->image));
                }
            }
            return ResponseFormatter::success($carts, 'List keranjang berhasil ditampilkan');
        }
        if ($carts == null) {
            return ResponseFormatter::success($carts, 'List keranjang kosong');
        }
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

    public function deleteCart($id)
    {
        $cart = Cart::find($id);
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
