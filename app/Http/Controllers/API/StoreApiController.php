<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreApiController extends Controller
{
    public function markets()
    {
        $markets = Store::all();
        return ResponseFormatter::success($markets, 'Data semua toko berhasil diambil');
    }

    public function fetch($id)
    {
        $market = Store::with('products')->find($id);
        foreach ($market->products as $product) {
            $product->image = url(Storage::url($product->image));
        }
        if (empty($market)) {
            return ResponseFormatter::error([
                'message' => 'Toko tidak ditemukan',
            ], 'Not Found');
        }
        return ResponseFormatter::success($market, 'Data Toko berhasil diambil');
    }

    public function createMarket(StoreRequest $request)
    {
        $market = Store::create($request->all());

        return ResponseFormatter::success($market, 'Toko Berhasil dibuat');
    }

    public function limitsMarket(Request $request){
        $limit = $request->input('limit',6);

        $markets = Store::with('products');
        return ResponseFormatter::success(
            $markets->paginate($limit),
            'Data list toko berhasil diambil'
        );
    }

    public function updateMarket(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'users_id' => 'required|exists:users,id',
                'name_store' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'address' => 'required|string',
                'description' => 'required|string',
                'account_name' => 'required|string|max:255',
                'account_number' => 'required',
                'verification_store' => 'nullable',
                'image' => 'nullable',
            ]);
            $market = Store::findOrFail($id);
            $data = $request->all();
            $market->update($data);

            return ResponseFormatter::success($market,'Toko Berhasil diubah');
        } catch (\Throwable $th) {
            return ResponseFormatter::error([
                'message' => $th,
            ], 'Data gagal diubah');
        }
    }
}
