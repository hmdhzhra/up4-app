<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Pengujian;
use App\Models\Layanan;
use App\Models\Jenis_Layanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Validasi Berkas';
        $data_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->whereIn('status', ['Menunggu Validasi Berkas', 'Lakukan Pembayaran', 'Validasi Ditolak', 'Dibayar', 'Menunggu Penjadwalan'])
            ->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        $jml_validasi = Pengujian::where('status', ['Menunggu Validasi Berkas'])->count();
        $jml_validasiDone = Pengujian::whereNotNull('no_skrd')->count();
            return view('bendahara.validasi.index', compact(
                'title', 
                'data_pengujian',
                'jml_validasi',
                'jml_validasiDone',
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
        $pengujian = Pengujian::with('pelanggan.user')->findorfail($id);
        $currentTime = now()->format('YmdHis');
        $username = $pengujian->pelanggan->user->username;

        if ($request->hasFile('berkas_skrd')) {
            $berkas_skrd = $request->file('berkas_skrd');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_skrd->getClientOriginalName();
            $berkas_skrd_save = $berkas_skrd->storeAs('public/berkas_skrd', $filename);
            $berkas_skrd_path = 'storage/berkas_skrd/'.$filename;
        }  else {
            $berkas_skrd_path = null;
        }

            $data = [
                'no_skrd' =>$request->no_skrd,
                'no_order' =>$request->no_order,
                'status' => 'Menunggu Penjadwalan',
                'berkas_skrd' => $berkas_skrd_path,
            ];
            $pengujian->update($data);
            
            return back()->with('toast_success', 'File SSRD verhasil diupload');
    }

    public function validasi_berkas(Request $request, $id)
    {
        $pengujian = Pengujian::with('pelanggan.user')->findorfail($id);

        if($request->validasi == 'Berkas Lengkap'){
            $data = [
                'status' => 'Lakukan Pembayaran',
                'keterangan' => $request->keterangan,
            ];
            $pengujian->update($data);
            return back()->with('toast_success', 'Validasi berkas berhasil');
        } elseif ($request->validasi == 'Berkas Tidak Lengkap'){
            $data = [
                'status' => 'Validasi ditolak',
                'keterangan' => $request->keterangan,
            ];
            $pengujian->update($data);
            return back()->with('toast_success', 'Validasi berkas berhasil');
        }


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
