<?php

namespace App\Http\Controllers\Laboran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Pengujian;
use App\Models\Jenis_Layanan;
use App\Models\Layanan;
use App\Models\Penugasan;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Penjadwalan';
        $jml_menunggu = Pengujian::where('status', 'Menunggu Penjadwalan')->count();
        $jml_selesai = Pengujian::where('status', 'Selesai')->count();
        $jml_proses = Pengujian::where('status', 'Proses Pengujian')->count();
        if (Auth::user()->jenis_lab == 'Tim Campuran Beraspal'){
            $data_penugasan = Penugasan::with('pengujian.pelanggan.user', 'pengujian.layanan.jenisLayanan')->where('tim_lab', 'Tim Campuran Beraspal')->get();
        }elseif (Auth::user()->jenis_lab == 'Tim Aspal'){
            $data_penugasan = Penugasan::with('pengujian.pelanggan.user', 'pengujian.layanan.jenisLayanan')->where('tim_lab', 'Tim Aspal')->get();

        }elseif (Auth::user()->jenis_lab == 'Tim Penyelidikan Lapangan'){
            $data_penugasan = Penugasan::with('pengujian.pelanggan.user', 'pengujian.layanan.jenisLayanan')->where('tim_lab', 'Tim Penyelidikan Lapangan')->get();

        }elseif (Auth::user()->jenis_lab == 'Tim Agregat, Tanah, dan Beton'){
            $data_penugasan = Penugasan::with('pengujian.pelanggan.user', 'pengujian.layanan.jenisLayanan')->where('tim_lab', 'Tim Agregat, Tanah, dan Beton')->get();

        }elseif (Auth::user()->jenis_lab == 'Tim Pengukuran'){
            $data_penugasan = Penugasan::with('pengujian.pelanggan.user', 'pengujian.layanan.jenisLayanan')->where('tim_lab', 'Tim Pengukuran')->get();

        }
        return view('laboran.penjadwalan', compact(
            'title', 
            'data_penugasan',
            'jml_menunggu',
            'jml_selesai',
            'jml_proses',
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
        $penugasan = Penugasan::with('pengujian')->findorfail($id);
        $data = [
            'jadwal_pengujian' =>$request->jadwal_pengujian,
            'keterangan' =>$request->keterangan,
            'status' => 'Menunggu Material Pengujian'
        ];
        $penugasan->pengujian->update($data);
        return back()->with('toast_success', 'Penjadwalan berhasil dilakukan');
    }

    public function status_material(Request $request, $id)
    {
        $penugasan = Penugasan::with('pengujian')->findorfail($id);
        if($request->status_material == "Material Pengujian Diterima"){
            $data = [
                'keterangan' =>null,
                'status' => 'Proses Pengujian',
            ];

            $penugasan->pengujian->update($data);
        }
        return back()->with('toast_success', 'Status berhasil diubah');
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
