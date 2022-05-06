<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DataApiController extends Controller
{
    public function districtsBaktiya(){
        $response = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=1111100');

        $jsonData = $response->json();

        return ResponseFormatter::success($jsonData['kelurahan'],'Data Semua Desa Kecamatan Baktiya Berhasil Ditampilkan');
    }
}
