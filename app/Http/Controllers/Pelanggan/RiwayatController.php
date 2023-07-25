<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Pengujian;
use App\Models\Jenis_Layanan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Riwayat Pengujian';
        $username = Auth::user()->username;
        $data_pelanggan = Pelanggan::where('user_id', Auth::user()->id)->first();
        $user = Auth::user();
        $pelanggan =$user->pelanggan;
        $data_pengujian = Pengujian::with('layanan.jenisLayanan')->where('pelanggan_id', $data_pelanggan->id)->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        $validasi = Pengujian::where('pelanggan_id', $data_pelanggan->id)->whereIn('status', ['Menunggu Validasi Berkas'])->count();
        $validasi_ditolak = Pengujian::where('pelanggan_id', $data_pelanggan->id)->whereIn('status', ['Validasi ditolak'])->count();
        $stats_pembayaran = Pengujian::where('pelanggan_id', $data_pelanggan->id)->whereIn('status', ['Lakukan Pembayaran'])->count();
        $selesai = Pengujian::where('pelanggan_id', $data_pelanggan->id)->whereIn('status', ['Selesai'])->count();
        $pelanggan =$user->pelanggan;

        return view('pelanggan.pelanggan', compact(
            'title', 
            'data_pelanggan', 
            'username', 
            'data_pengujian',
            'validasi',
            'validasi_ditolak',
            'stats_pembayaran',
            'selesai',
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
    public function show($id)
    {
        //
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
