<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jenis_Layanan;
use App\Models\User;
use App\Models\Pengujian;
use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class PermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Permohonan Pengujian';
        $jenis_layanan = Jenis_Layanan::all();
        $pelanggan = Pelanggan::where('user_id', Auth::user()->id)->first(); //get pelanggan
        return view('pelanggan.pengujian.permohonan', compact(
                'title', 'jenis_layanan', 'pelanggan'
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
        //Validasi input
        $validatedData = $request->validate([
            'nama_proyek' => 'required',
            'lokasi_proyek' => 'required',
            'radio1' => 'required',
            'berkas_sp' => 'required|mimes:pdf|file|max:5120',
            'berkas_spmk' => 'nullable|mimes:pdf|file|max:5120',
            'berkas_ktp' => 'required|mimes:pdf|file|max:5120',
            'berkas_gambar' => 'nullable|mimes:jpeg,jpg,png,pdf,doc,docx|file|max:5120',
            'tot' => 'required|numeric',
            'm_harga.id_barang' => 'required|array',
            'm_harga.id_barang.*' => 'required|exists:jenis_layanan,id',
            'm_harga.jumlah_barang' => 'required|array',
            'm_harga.jumlah_barang.*' => 'required|integer|min:1',
            'm_harga.harga' => 'required|array',
            'm_harga.harga.*' => 'required|numeric',
        ]);

            // Mengambil nilai jenis_id dan total dari input form
            $jenisId = $request->input('m_harga.id_barang')[0]; // Menyesuaikan indeks jika ada multiple select
            $total = $request->input('tot');
            $currentTime = now()->format('YmdHis'); // Mendapatkan tanggal dan jam saat ini dalam format YmdHis
            $username = Auth::user()->username;

        if ($request->hasFile('berkas_sp')) {
            $berkas_sp = $request->file('berkas_sp');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_sp->getClientOriginalName();
            $berkas_sp_path = $berkas_sp->storeAs('berkas_sp', $filename);
        }

        if ($request->hasFile('berkas_spmk')) {
            $berkas_spmk = $request->file('berkas_spmk');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_spmk->getClientOriginalName();
            $berkas_spmk_path = $berkas_spmk->storeAs('berkas_spmk', $filename);
        } else {
            $berkas_spmk_path = null;
        }

        if ($request->hasFile('berkas_ktp')) {
            $berkas_ktp = $request->file('berkas_ktp');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_ktp->getClientOriginalName();
            $berkas_ktp_path = $berkas_ktp->storeAs('berkas_ktp', $filename);
        }

        if ($request->hasFile('berkas_gambar')) {
            $berkas_gambar = $request->file('berkas_gambar');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_gambar->getClientOriginalName();
            $berkas_gambar_path = $berkas_gambar->storeAs('berkas_gambar', $filename);
        }  else {
            $berkas_gambar_path = null;
        }

        $pelanggan = Pelanggan::where('user_id', Auth::user()->id)->first();

        $pengujian = new Pengujian([
            'nama_proyek' => $request->nama_proyek,
            'lokasi_proyek' => $request->lokasi_proyek,
            'bidang' => $request->radio1,
            'berkas_sp' => $berkas_sp_path,
            'berkas_spmk' => $berkas_spmk_path,
            'berkas_ktp' => $berkas_ktp_path,
            'berkas_gambar' => $berkas_gambar_path,
            'status' => 'Menunggu Validasi Berkas',
            'tgl_permohonan' => now()->toDateString(),
        ]);
        $pelanggan->pengujian()->save($pengujian);

        $layanan = new Layanan([
            'pengujian_id' => $pengujian->id,
            'jenis_id' => $jenisId,
            'total' => $total,
        ]);
        $pengujian->layanan()->save($layanan);

        return redirect()->route('dashboard')->with('toast_success', 'Permohonan Pengujian berhasil dikirim.');


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
        $pengujian = Pengujian::findOrFail($id);
        $validatedData = $request->validate([
            'berkas_sp' => 'nullable|mimes:pdf|file|max:5120',
            'berkas_spmk' => 'nullable|mimes:pdf|file|max:5120',
            'berkas_ktp' => 'nullable|mimes:pdf|file|max:5120',
            'berkas_gambar' => 'nullable|mimes:jpeg,jpg,png,pdf|file|max:5120',
        ]);

        $currentTime = now()->format('YmdHis'); 
        $username = Auth::user()->username;
    
        $berkas = [];
    
        if ($request->hasFile('berkas_sp')) {
            $berkas_sp = $request->file('berkas_sp');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_sp->getClientOriginalName();
            $berkas_sp_path = $berkas_sp->storeAs('berkas_sp', $filename);
            $berkas['berkas_sp'] = $berkas_sp_path;
        }
    
        if ($request->hasFile('berkas_ktp')) {
            $berkas_ktp = $request->file('berkas_ktp');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_ktp->getClientOriginalName();
            $berkas_ktp_path = $berkas_ktp->storeAs('berkas_ktp', $filename);
            $berkas['berkas_ktp'] = $berkas_ktp_path;
        }
    
        if ($request->hasFile('berkas_spmk')) {
            $berkas_spmk = $request->file('berkas_spmk');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_spmk->getClientOriginalName();
            $berkas_spmk_path = $berkas_spmk->storeAs('berkas_spmk', $filename);
            $berkas['berkas_spmk'] = $berkas_spmk_path;
        }
    
        if ($request->hasFile('berkas_gambar')) {
            $berkas_gambar = $request->file('berkas_gambar');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_gambar->getClientOriginalName();
            $berkas_gambar_path = $berkas_gambar->storeAs('berkas_gambar', $filename);
            $berkas['berkas_gambar'] = $berkas_gambar_path;
        }
    
        $pengujian->update($berkas);

        $data = [
            'status' => 'Menunggu Validasi Berkas',
            'keterangan' => null,
        ];
        $pengujian->update($data);
        return back()->with('toast_success', 'Berkas berhasil diupdate');
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
