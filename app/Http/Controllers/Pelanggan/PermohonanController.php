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
use Illuminate\Support\Facades\Response;


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
                'title', 
                'jenis_layanan', 
                'pelanggan'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
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

            if (in_array($request->radio1, ['SDBM Jakarta Timur', 'SDBM Jakarta Barat', 'SDBM Jakarta Selatan', 'SDBM Jakarta Pusat'])) {
                // Validasi berkas_spmk menjadi required
                $validatedData = $request->validate([
                    'berkas_spmk' => 'required|mimes:pdf|file|max:5120',
                ]);
            }
            
            $jenisId = $request->input('m_harga.id_barang')[0];
            $total = $request->input('tot');
            $jumlah = $request->input('m_harga.jumlah_barang')[0];
            $harga = $request->input('m_harga.harga')[0];
            $currentTime = now()->format('YmdHis'); 
            $username = Auth::user()->username;
            $nama_layanan = Jenis_Layanan::findOrFail($jenisId)->nama_layanan;

        if ($request->hasFile('berkas_sp')) {
            $berkas_sp = $request->file('berkas_sp');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_sp->getClientOriginalName();
            $berkas_sp_save = $berkas_sp->storeAs('public/berkas_sp', $filename);
            $berkas_sp_path = 'storage/berkas_sp/'.$filename;
        }

        if ($request->hasFile('berkas_spmk')) {
            $berkas_spmk = $request->file('berkas_spmk');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_spmk->getClientOriginalName();
            $berkas_spmk_save = $berkas_spmk->storeAs('public/berkas_spmk', $filename);
            $berkas_spmk_path = 'storage/berkas_spmk/'.$filename;
        } else {
            $berkas_spmk_path = null;
        }

        if ($request->hasFile('berkas_ktp')) {
            $berkas_ktp = $request->file('berkas_ktp');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_ktp->getClientOriginalName();
            $berkas_ktp_save = $berkas_ktp->storeAs('public/berkas_ktp', $filename);
            $berkas_ktp_path = 'storage/berkas_ktp/'.$filename;
        }

        if ($request->hasFile('berkas_gambar')) {
            $berkas_gambar = $request->file('berkas_gambar');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_gambar->getClientOriginalName();
            $berkas_gambar_save = $berkas_gambar->storeAs('public/berkas_gambar', $filename);
            $berkas_gambar_path = 'storage/berkas_gambar/'.$filename;
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

        
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $pengujian->id,
                'gross_amount' => $total,
            ),
            'item_details' => array(
                array(
                    'id' => $pengujian->id,
                    'price' => $harga, 
                    'quantity' => $jumlah, 
                    'name' => $nama_layanan, 
                ),
                
            ),
            'customer_details' => array(
                'first_name' => $username,
                'email' => $pelanggan->user->email,
                'phone' => $pelanggan->telp,
                'nama_perusahaan' => $pelanggan->nama_pr,
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $layanan = new Layanan([
            'pengujian_id' => $pengujian->id,
            'jenis_id' => $jenisId,
            'jumlah' => $jumlah,
            'total' => $total,
            'snap_token' => $snapToken,
        ]);
        $pengujian->layanan()->save($layanan);

        return redirect()->route('riwayat.index')->with('toast_success', 'Permohonan Pengujian berhasil dikirim.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap exception jika validasi gagal
            return redirect()->route('permohonan.index')->with('toast_error', 'Permohonan pengujian gagal disimpan, masukkan berkas yang wajib dan file berbentuk pdf!')->withErrors($e->errors());
        }
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
            $berkas_sp_save = $berkas_sp->storeAs('berkas_sp', $filename);
            $berkas_sp_path = 'storage/berkas_sp/'.$filename;
            $berkas['berkas_sp'] = $berkas_sp_path;
        }
    
        if ($request->hasFile('berkas_ktp')) {
            $berkas_ktp = $request->file('berkas_ktp');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_ktp->getClientOriginalName();
            $berkas_ktp_save = $berkas_ktp->storeAs('berkas_ktp', $filename);
            $berkas_ktp_path = 'storage/berkas_ktp/'.$filename;
            $berkas['berkas_ktp'] = $berkas_ktp_path;
        }
    
        if ($request->hasFile('berkas_spmk')) {
            $berkas_spmk = $request->file('berkas_spmk');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_spmk->getClientOriginalName();
            $berkas_spmk_save = $berkas_spmk->storeAs('berkas_spmk', $filename);
            $berkas_spmk_path = 'storage/berkas_spmk/'.$filename;
            $berkas['berkas_spmk'] = $berkas_spmk_path;
        }
    
        if ($request->hasFile('berkas_gambar')) {
            $berkas_gambar = $request->file('berkas_gambar');
            $filename = Str::slug($username) . '_' . $currentTime . '_' . $berkas_gambar->getClientOriginalName();
            $berkas_gambar_save = $berkas_gambar->storeAs('berkas_gambar', $filename);
            $berkas_gambar_path = 'storage/berkas_gambar/'.$filename;
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
    
}
