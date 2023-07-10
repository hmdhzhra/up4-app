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
use Illuminate\Support\Str;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Monitoring Pelayanan";
        $data_pengujian = Pengujian::with('penugasan')->whereIn('status', ['Proses Pengujian', 'Menunggu Laporan', 'Selesai'])->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('laboran.monitoring.index', compact(
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

        if ($request->hasFile('laporan_lab')) {
            $laporan_lab = $request->file('laporan_lab');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $laporan_lab->getClientOriginalName();
            $laporan_lab_path = $laporan_lab->storeAs('laporan_lab', $filename);
        }  else {
            $laporan_lab_path = null;
        }

        $data = [
            'laporan_lab' => $laporan_lab_path,
        ];
        $pengujian->penugasan->update($data);

        $data2 = [
            'status' => 'Menunggu Laporan',

        ];
        $pengujian->update($data2);

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
