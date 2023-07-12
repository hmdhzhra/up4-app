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
use Illuminate\Support\Facades\Response;

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
        $data_pembayaran = Pengujian::with(['layanan.jenisLayanan'])
            ->where(function ($query) {
                $query->whereIn('status', ['Lakukan Pembayaran', 'Dibayar'])
                    ->whereHas('layanan', function ($subquery) {
                        $subquery->whereIn('status_pembayaran', ['unpaid', 'paid']);
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
        $pembayaran = Pengujian::findorfail($id);
        $bayar = Layanan::with('pengujian.pelanggan.user', 'jenisLayanan')->where('pengujian_id', $pembayaran->id)->first();
        $snapToken = $bayar->snap_token;
        
        return view('pelanggan.pembayaran.detail', compact(
            'title', 
            'bayar', 
            'snapToken'
    ));
    }

    public function payment_post(Request $request){
        $json = json_decode($request->get('json'));
        
    }

    public function callback(Request $request)
    {
        
        $server_key = config('midtrans.server_key');
        // $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$server_key);
    
        // if ($hashed == $request->signature_key) {
        //     if ($request->transaction_status == 'settlement') {
        //         $order_id = $request->order_id;
        //         $pembayaran = Layanan::with('pengujian')->find($order_id);
        //         $pengujian = Pengujian::where('id', $pembayaran->id)->first();
        //         $pembayaran->update(['status_pembayaran' => 'paid']);
        //         $pengujian->update(['status' => 'Menunggu Penjadwalan']);
    
        //         $responseData = [
        //             'status' => 'success',
        //             'message' => "Transaction updated. Transaction id: $order_id",
        //             'snap_token' => $request->snap_token, // Tambahkan snap_token dalam respons
        //         ];
    
        //         return response()->json($responseData);
        //     }
        // }
    
        // return response()->json([
        //     'status' => 'error',
        //     'message' => 'Invalid transaction data.',
        // ], 400);
    }
}
         
    
    

    /**
     * Show the form for editing the specified resource.
     *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         //
//     }
// }
