<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Pengujian;
use App\Models\Jenis_Layanan;
use App\Models\Layanan;
use App\Models\Penugasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Laporan';
        $data_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan', 'penugasan')->whereIn('status', ['Proses Pengujian', 'Menunggu Laporan', 'Selesai'])
        ->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('tatausaha.laporan', compact(
            'title',
            'data_pengujian',
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
        $pengujian = Pengujian::with('pelanggan.user','penugasan')->findorfail($id);
        $currentTime = now()->format('YmdHis');
        $username = $pengujian->pelanggan->user->username;

        if ($request->hasFile('laporan')) {
            $laporan = $request->file('laporan');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $laporan->getClientOriginalName();
            $laporan_save = $laporan->storeAs('public/laporan', $filename);
            $laporan_path = 'storage/laporan/'.$filename;
        }  else {
            $laporan_path = null;
        }
        $data = [
            'laporan' => $laporan_path,
            'status' => 'Selesai',
        ];
        $pengujian->update($data);
        return back()->with('toast_success', 'Upload laporan berhasil');
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
