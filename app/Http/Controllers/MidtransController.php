<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jenis_Layanan;
use App\Models\User;
use App\Models\Pengujian;
use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class MidtransController extends Controller
{

    public function payment_handler(Request $request){
        $json = json_decode($request->getContent());
        $server_key = config('midtrans.server_key');

        $signature_key = hash('sha512', $json->order_id.$json->status_code.$json->gross_amount.$server_key);
        
        if($signature_key != $json->signature_key){
            return abort(404);
        }
        //status berhasil
        $order_id = $json->order_id;
        $pembayaran = Layanan::with('pengujian.pelanggan.user')->where('pengujian_id', $order_id)->first();
        $pembayaran->update(['status_pembayaran' => 'paid']);
        $pembayaran->pengujian->update(['status' => 'Penerbitan SSRD']);

        return redirect()->route('bayar.index');
    }
}
