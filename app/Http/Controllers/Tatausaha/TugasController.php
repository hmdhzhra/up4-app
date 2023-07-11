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

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Pengendalian Tugas';
        $data_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan', 'penugasan')->whereIn('status', ['Dibayar', 'Menunggu Penjadwalan'])
        ->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        $jml_dibayar = Pengujian::where('status', 'Dibayar')->count();
        $jml_penjadwalan = Pengujian::where('status', 'Menunggu Penjadwalan')->count();
        $jml_selesai = Pengujian::where('status', 'Selesai')->count();
        return view('tatausaha.index', compact(
            'title',
            'data_pengujian',
            'jml_dibayar',
            'jml_penjadwalan',
            'jml_selesai'
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
        $pengujian = Pengujian::with('penugasan')->findorfail($id);
        $data1 = [
            'tim_lab' => $request->tim_lab
        ];
    
        $pengujian->penugasan()->updateOrCreate(['pengujian_id' => $pengujian->id], $data1);
    
        $data2 = [
            'status' => 'Menunggu Penjadwalan'
        ];
        $pengujian->update($data2);
    
        return back()->with('toast_success', 'Bagi tugas ke laboran berhasil');
    
    }

    public function surat_tugas(Request $request, $id)
    {
        //
        $pengujian = Pengujian::with('pelanggan.user','penugasan')->findorfail($id);
        $currentTime = now()->format('YmdHis');
        $username = $pengujian->pelanggan->user->username;

        if ($request->hasFile('surat_tugas')) {
            $surat_tugas = $request->file('surat_tugas');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $surat_tugas->getClientOriginalName();
            $surat_tugas_save = $surat_tugas->storeAs('public/surat_tugas', $filename);
            $surat_tugas_path = 'storage/surat_tugas/'.$filename;
        }  else {
            $surat_tugas_path = null;
        }

        $data = [
            'surat_tugas' => $surat_tugas_path,
        ];
        $pengujian->penugasan->update($data);
    
        return back()->with('toast_success', 'Upload surat tugas berhasil');
    
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
