<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class OrderApiController extends Controller
{
    public function orderMarket($id)
    {
        $pesanan = Order::with('user', 'orderItem.product')->where('store_id', $id)->get();
        if (count($pesanan) <= 0)  return response()->json([
            'message' =>  'Belum ada pesanan'
        ]);

        return ResponseFormatter::success($pesanan, 'List order berhasil ditampil');
    }

    public function orderUser($id)
    {
        $pesanan = Order::with('orderItem.product', 'market')
            ->where('users_id', $id)->get();
        foreach ($pesanan as $item) {
            $item->image = url(Storage::url($item->image));
        }

        if (count($pesanan) <= 0)  return response()->json([
            'message' =>  'Belum ada pesanan'
        ]);

        return ResponseFormatter::success($pesanan, 'List order berhasil ditampil');
    }

    public function detailTransaction()
    {
        $item = Cart::where('users_id', Auth::user()->id)->get();
        return response()->json($item, 200);
    }

    public function statusOrder(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|string'
        ]);
        $order = Order::findOrFail($id);
        $data = $request->all();
        $order->update($data);
        return ResponseFormatter::success($order, 'Order berhasil diubah');
    }

    public function allOrder()
    {
        $order = Order::with('orderItem')->get();
        return response()->json($order, 200);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'store_id' => 'required:exists:store,id',
            'status' => 'required',
            'total_price' => 'required'
        ]);

        $order = Order::create([
            'users_id' => Auth::user()->id,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' =>  $request->hasFile('image') ?  $request->file('image')->store('assets/order', 'public') : null,
            'status' => $request->status,
            'total_price' => $request->total_price,
            'store_id' => $request->store_id,
            'product_id' => 72
        ]);

        foreach ($request->items as $product) {
            $item = Product::findOrFail($product['id']);
            if ($item) {
                OrderItem::create([
                    'quantity' => $product['quantity'],
                    'price' => $item->price,
                    'weight' => 0.0,
                    'product_id' => $item->id,
                    'order_id' => $order->id,
                ]);
            }
        }
        return ResponseFormatter::success($order, 'Transaksi berhasil');
    }
}
