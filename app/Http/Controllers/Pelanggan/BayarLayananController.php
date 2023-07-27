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
                $query->whereIn('status', ['Lakukan Pembayaran', 'Penerbitan SSRD'])
                    ->whereHas('layanan', function ($subquery) {
                        $subquery->whereIn('status_pembayaran', ['unpaid', 'paid']);
                    });
            })->where('pelanggan_id', $data_pelanggan->id)->get();

            $user = Auth::user();
            $pelanggan =$user->pelanggan;
        return view('pelanggan.pembayaran.index', compact(
                'title', 
                'data_pembayaran',
                'pelanggan'
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
        $pelanggan = Pelanggan::where('user_id', Auth::user()->id)->first();
        
        return view('pelanggan.pembayaran.detail', compact(
            'title', 
            'bayar', 
            'snapToken',
            'pelanggan'
    ));
    }

    public function payment_post(Request $request){
        $json = json_decode($request->get('json'));
        
    }
}
         