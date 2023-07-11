<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Pengujian;
use App\Models\Jenis_Layanan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index2()
    {
        $title = 'Dashboard';

        if (Auth::user()->role == 'admin'){
            $jml_pengujian = Pengujian::all()->count();
            $jml_tervalidasi = Pengujian::whereNotNull('no_skrd')->count();
            $jml_terjadwal = Pengujian::whereNotNull('jadwal_pengujian')->count();
            $jml_selesai = Pengujian::whereNotNull('laporan')->count();
            $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')
            ->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
            return view('dashboard2.admin', compact(
                'title', 
                'jml_pengujian',
                'jml_tervalidasi',
                'jml_terjadwal',
                'jml_selesai',
                'full_pengujian'
            ));

        } elseif (Auth::user()->role == 'pelanggan') {
            $username = Auth::user()->username;
            $data_pelanggan = Pelanggan::where('user_id', Auth::user()->id)->first();
            $user = Auth::user();
            $pelanggan =$user->pelanggan;

            if ($data_pelanggan) {
                $jenis_layanan = Jenis_Layanan::All();
                $data_pengujian = Pengujian::with('layanan.jenisLayanan')->where('pelanggan_id', $data_pelanggan->id)->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
                $validasi = Pengujian::where('pelanggan_id', $data_pelanggan->id)->whereIn('status', ['Menunggu Validasi Berkas'])->count();
                $validasi_ditolak = Pengujian::where('pelanggan_id', $data_pelanggan->id)->whereIn('status', ['Validasi ditolak'])->count();
                $stats_pembayaran = Pengujian::where('pelanggan_id', $data_pelanggan->id)->whereIn('status', ['Lakukan Pembayaran'])->count();
                $selesai = Pengujian::where('pelanggan_id', $data_pelanggan->id)->whereIn('status', ['Selesai'])->count();
                
                return view('dashboard2.pelanggan2', compact(
                    'title',
                    'username', 
                    'validasi',
                    'validasi_ditolak',
                    'stats_pembayaran',
                    'selesai'
    
                ));

            }return view('pelanggan.profile', compact(
                'title', 'user', 'pelanggan'
            ));

            
        } elseif (Auth::user()->role == 'bendahara'){
            $jml_pengujian = Pengujian::all()->count();
            $jml_tervalidasi = Pengujian::whereNotNull('no_skrd')->count();
            $jml_terjadwal = Pengujian::whereNotNull('jadwal_pengujian')->count();
            $jml_selesai = Pengujian::whereNotNull('laporan')->count();
            $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')
            ->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
            return view('dashboard2.bendahara', compact(
                'title', 
                'jml_pengujian',
                'jml_tervalidasi',
                'jml_terjadwal',
                'jml_selesai',
                'full_pengujian'
            ));
        } elseif (Auth::user()->role == 'tatausaha'){
            $jml_pengujian = Pengujian::all()->count();
            $jml_tervalidasi = Pengujian::whereNotNull('no_skrd')->count();
            $jml_terjadwal = Pengujian::whereNotNull('jadwal_pengujian')->count();
            $jml_selesai = Pengujian::whereNotNull('laporan')->count();
            $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')
            ->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();

            return view('dashboard2.tatausaha', compact(
                'title', 
                'jml_pengujian',
                'jml_tervalidasi',
                'jml_terjadwal',
                'jml_selesai',
                'full_pengujian'
            ));
        } elseif (Auth::user()->role == 'laboran'){
            $jml_pengujian = Pengujian::all()->count();
            $jml_tervalidasi = Pengujian::whereNotNull('no_skrd')->count();
            $jml_terjadwal = Pengujian::whereNotNull('jadwal_pengujian')->count();
            $jml_selesai = Pengujian::whereNotNull('laporan')->count();
            $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')
            ->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();

            return view('dashboard2.laboran', compact(
                'title', 
                'jml_pengujian',
                'jml_tervalidasi',
                'jml_terjadwal',
                'jml_selesai',
                'full_pengujian'
            ));
        } elseif (Auth::user()->role == 'bidang'){
            $title_bidang = 'Monitoring Pengujian';
            if (Auth::user()->jenis_bidang == 'Jalan dan Jembatan'){
                $bidang = 'Jalan dan Jembatan';
                $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->where('bidang', ['Jalan dan Jembatan'])->get();
                $jml_pengujian = Pengujian::where('bidang',  ['Jalan dan Jembatan'])->count();
                $jml_penjadwalan = Pengujian::where('bidang',  ['Jalan dan Jembatan'])->whereIn('status', ['Menunggu Penjadwalan'])->count();
                $jml_proses = Pengujian::where('bidang',  ['Jalan dan Jembatan'])->whereIn('status', ['Proses Pengujian'])->count();
                $jml_selesai = Pengujian::where('bidang',  ['Jalan dan Jembatan'])->whereIn('status', ['Selesai'])->count();

            }elseif (Auth::user()->jenis_bidang == 'Prasarana Sarana Utilitas Kota'){
                $bidang = 'Prasarana Sarana Utilitas Kota';
                $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->where('bidang', ['Prasarana Sarana Utilitas Kota'])->get();
                $jml_pengujian = Pengujian::where('bidang',  ['Prasarana Sarana Utilitas Kota'])->count();
                $jml_penjadwalan = Pengujian::where('bidang',  ['Prasarana Sarana Utilitas Kota'])->whereIn('status', ['Menunggu Penjadwalan'])->count();
                $jml_proses = Pengujian::where('bidang', ['Prasarana Sarana Utilitas Kota'])->whereIn('status', ['Proses Pengujian'])->count();
                $jml_selesai = Pengujian::where('bidang',  ['Prasarana Sarana Utilitas Kota'])->whereIn('status', ['Selesai'])->count();
    
            }elseif (Auth::user()->jenis_bidang == 'Penerangan Jalan Sarana Umum'){
                $bidang = 'Penerangan Jalan Sarana Umum';
                $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->where('bidang', ['Penerangan Jalan Sarana Umum'])->get();
                $jml_pengujian = Pengujian::where('bidang',  ['Penerangan Jalan Sarana Umum'])->count();
                $jml_penjadwalan = Pengujian::where('bidang',  ['Penerangan Jalan Sarana Umum'])->whereIn('status', ['Menunggu Penjadwalan'])->count();
                $jml_proses = Pengujian::where('bidang', ['Penerangan Jalan Sarana Umum'])->whereIn('status', ['Proses Pengujian'])->count();
                $jml_selesai = Pengujian::where('bidang',  ['Penerangan Jalan Sarana Umum'])->whereIn('status', ['Selesai'])->count();
    
            }elseif (Auth::user()->jenis_bidang == 'Kelengkapan Jalan'){
                $bidang = 'Kelengkapan Jalan';
                $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->where('bidang', ['Kelengkapan Jalan'])->get();
                $jml_pengujian = Pengujian::where('bidang',  ['Kelengkapan Jalan'])->count();
                $jml_penjadwalan = Pengujian::where('bidang',  ['Kelengkapan Jalan'])->whereIn('status', ['Menunggu Penjadwalan'])->count();
                $jml_proses = Pengujian::where('bidang', ['Kelengkapan Jalan'])->whereIn('status', ['Proses Pengujian'])->count();
                $jml_selesai = Pengujian::where('bidang',  ['Kelengkapan Jalan'])->whereIn('status', ['Selesai'])->count();
    
            }elseif (Auth::user()->jenis_bidang == 'SDBM Jakarta Timur'){
                $bidang = 'SDBM Jakarta Timur';
                $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->where('bidang', ['SDBM Jakarta Timur'])->get();
                $jml_pengujian = Pengujian::where('bidang',  ['SDBM Jakarta Timur'])->count();
                $jml_penjadwalan = Pengujian::where('bidang',  ['SDBM Jakarta Timur'])->whereIn('status', ['Menunggu Penjadwalan'])->count();
                $jml_proses = Pengujian::where('bidang', ['SDBM Jakarta Timur'])->whereIn('status', ['Proses Pengujian'])->count();
                $jml_selesai = Pengujian::where('bidang',  ['SDBM Jakarta Timur'])->whereIn('status', ['Selesai'])->count();
    
            }elseif (Auth::user()->jenis_bidang == 'SDBM Jakarta Barat'){
                $bidang = 'SDBM Jakarta Barat';
                $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->where('bidang', ['SDBM Jakarta Barat'])->get();
                $jml_pengujian = Pengujian::where('bidang',  ['SDBM Jakarta Barat'])->count();
                $jml_penjadwalan = Pengujian::where('bidang',  ['SDBM Jakarta Barat'])->whereIn('status', ['Menunggu Penjadwalan'])->count();
                $jml_proses = Pengujian::where('bidang', ['SDBM Jakarta Barat'])->whereIn('status', ['Proses Pengujian'])->count();
                $jml_selesai = Pengujian::where('bidang',  ['SDBM Jakarta Barat'])->whereIn('status', ['Selesai'])->count();
    
            }elseif (Auth::user()->jenis_bidang == 'SDBM Jakarta Selatan'){
                $bidang = 'SDBM Jakarta Selatan';
                $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->where('bidang', ['SDBM Jakarta Selatan'])->get();
                $jml_pengujian = Pengujian::where('bidang',  ['SDBM Jakarta Selatan'])->count();
                $jml_penjadwalan = Pengujian::where('bidang',  ['SDBM Jakarta Selatan'])->whereIn('status', ['Menunggu Penjadwalan'])->count();
                $jml_proses = Pengujian::where('bidang', ['SDBM Jakarta Selatan'])->whereIn('status', ['Proses Pengujian'])->count();
                $jml_selesai = Pengujian::where('bidang',  ['SDBM Jakarta Selatan'])->whereIn('status', ['Selesai'])->count();
    
            }elseif (Auth::user()->jenis_bidang == 'SDBM Jakarta Pusat'){
                $bidang = 'SDBM Jakarta Pusat';
                $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->where('bidang', ['SDBM Jakarta Pusat'])->get();
                $jml_pengujian = Pengujian::where('bidang',  ['SDBM Jakarta Pusat'])->count();
                $jml_penjadwalan = Pengujian::where('bidang',  ['SDBM Jakarta Pusat'])->whereIn('status', ['Menunggu Penjadwalan'])->count();
                $jml_proses = Pengujian::where('bidang', ['SDBM Jakarta Pusat'])->whereIn('status', ['Proses Pengujian'])->count();
                $jml_selesai = Pengujian::where('bidang',  ['SDBM Jakarta Pusat'])->whereIn('status', ['Selesai'])->count();
    
            }elseif (Auth::user()->jenis_bidang == 'SDBM Jakarta Utara'){
                $bidang = 'SDBM Jakarta Utara';
                $full_pengujian = Pengujian::with('pelanggan.user', 'layanan.jenisLayanan')->where('bidang', ['SDBM Jakarta Utara'])->get();
                $jml_pengujian = Pengujian::where('bidang',  ['SDBM Jakarta Utara'])->count();
                $jml_penjadwalan = Pengujian::where('bidang',  ['SDBM Jakarta Utara'])->whereIn('status', ['Menunggu Penjadwalan'])->count();
                $jml_proses = Pengujian::where('bidang', ['SDBM Jakarta Utara'])->whereIn('status', ['Proses Pengujian'])->count();
                $jml_selesai = Pengujian::where('bidang',  ['SDBM Jakarta Utara'])->whereIn('status', ['Selesai'])->count();
    
            }
            

            return view('dashboard2.bidang', compact(
                'title',
                'title_bidang', 
                'bidang',
                'full_pengujian',
                'jml_pengujian',
                'jml_penjadwalan',
                'jml_proses',
                'jml_selesai'
            ));
        }
        
    }

}
