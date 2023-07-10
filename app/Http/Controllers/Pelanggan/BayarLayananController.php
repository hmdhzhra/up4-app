<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jenis_Layanan;
use App\Models\Layanan;
use App\Models\User;
use App\Models\Pengujian;
use App\Models\Pelanggan;

class BayarLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Pembayaran Layanan';
        $data_pelanggan = Pelanggan::where('user_id', Auth::user()->id)->first();
        $data_pembayaran = Pengujian::with(['layanan.jenisLayanan'])->whereHas('layanan', function ($query) {
            $query->where(function ($subquery) {
            $subquery->where('status_pembayaran', 'unpaid')
                     ->orWhere('status_pembayaran', 'paid');
            });
            })->where('pelanggan_id', $data_pelanggan->id)->get();

        return view('pelanggan.pembayaran.index', compact(
                'title', 'data_pembayaran'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetail($id)
    {
        $title = 'Detail Pembayaran';
        //SAMPLE REQUEST START HERE
        $pembayaran = Pengujian::findorfail($id);
        $bayar = Layanan::with('pengujian.pelanggan.user', 'jenisLayanan')->where('pengujian_id', $pembayaran->id)->first();
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $bayar->pengujian_id,
                'gross_amount' => $bayar->total,
            ),
            // 'item_details' => array(
            //     array(
            //         'id' => $bayar->pengujian->id,
            //         'nama_proyek' => $bayar->pengujian->nama_proyek, 
            //         'nama_proyek' => $bayar->pengujian->lokasi_proyek, 
            //         'jenis_layanan' => $bayar->jenisLayanan->nama_layanan, 
            //     ),
            // ),
            'customer_details' => array(
                'first_name' => $bayar->pengujian->pelanggan->user->username,
                'email' => $bayar->pengujian->pelanggan->user->email,
                'phone' => $bayar->pengujian->pelanggan->telp,
                'nama_perusahaan' => $bayar->pengujian->pelanggan->nama_pr,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('pelanggan.pembayaran.detail', compact(
            'title', 'snapToken', 'bayar',
    ));
    }

    public function callback(Request $request)
    {
        $server_key = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$server_key);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'settlement'){
                $pembayaran = Layanan::with('pengujian')->find($request->order_id);
                $pengujian = Pengujian::where('id', $pembayaran->id)->first();
                $pembayaran->update(['status_pembayaran' =>'paid']);
                $pengujian->update(['status' => 'Menunggu Penjadwalan']);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
