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
        $data_pengujian = Pengujian::with('pelanggan.user')->whereIn('status', ['Menunggu Validasi Berkas', 'Lakukan Pembayaran', 'Validasi Ditolak', 'Dibayar'])
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
            $berkas_skrd_path = $berkas_skrd->storeAs('berkas_skrd', $filename);
        }  else {
            $berkas_skrd_path = null;
        }

        if($request->validasi == 'Validasi diterima'){
            $data = [
                'no_skrd' =>$request->no_skrd,
                'no_order' =>$request->no_order,
                'status' => 'Lakukan Pembayaran',
                'berkas_skrd' => $berkas_skrd_path,
                'keterangan' => $request->keterangan,
            ];
            $pengujian->update($data);

            
            
            return back()->with('toast_success', 'Validasi data berhasil');
        } elseif ($request->validasi == 'Validasi dibatalkan'){
            $data = [
                'no_skrd' =>null,
                'no_order' =>null,
                'status' => 'Validasi ditolak',
                'berkas_skrd' => null,
                'keterangan' => $request->keterangan,
            ];
            $pengujian->update($data);
            return back()->with('toast_success', 'Validasi data berhasil');
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
