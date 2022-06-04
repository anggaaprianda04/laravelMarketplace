<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        if ($market->image) {
            $market->image = url(Storage::url($market->image));
        }
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

    public function createMarket(Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id|unique:store,users_id',
            'name_store' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'required|string',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required',
            'verification_store' => 'nullable',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        $market = Store::create([
            'users_id' => $request->users_id,
            'name_store' => $request->name_store,
            'village' => $request->village,
            'address' => $request->address,
            'description' => $request->description,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'image' => $request->hasFile('image') ?  $request->file('image')->store('assets/market','public') : null,
        ]);
        return ResponseFormatter::success($market, 'Toko Berhasil dibuat');
    }

    // public function uploadPhotoMarket(Request $request,$id){
    //     $validator = Validator::make($request->all(),[
    //         'file' => 'nullable|image|mimes:png,jpg'
    //     ]);

    //     if($validator->fails()){
    //         return ResponseFormatter::error([
    //             'error' => $validator->errors(),],'Update photo fails', 401);
    //     }

    //     if($request->file('file')){
    //         $file = $request->file->store('assets/market','public');
    //         $market = Store::find($id);
    //         $market->image = $file;
    //         $market->update();
    //         return ResponseFormatter::success([$file],'File successfully uploaders');
    //     }
    // }

    public function limitsMarket(Request $request)
    {
        $limit = $request->input('limit', 6);

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

            return ResponseFormatter::success($market, 'Toko Berhasil diubah');
        } catch (\Throwable $th) {
            return ResponseFormatter::error([
                'message' => $th,
            ], 'Data gagal diubah');
        }
    }
}
