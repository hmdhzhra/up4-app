<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Data Pelanggan';
        $pelanggan = Pelanggan::with('user')->get();


        return view('admin.pelanggan.index', compact(
            'title', 'pelanggan'
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
        $pelanggan = Pelanggan::findorfail($id);
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'telp' => $request->telp,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'nama_pr' => $request->nama_pr,
            'email_pr' => $request->email_pr,
            'alamat_pr' => $request->alamat_pr,

        ];
        $pelanggan->update($data);
        return back()->with('toast_success', 'Data user berhasil diedit');
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
        $pelanggan = Pelanggan::findorfail($id);
        try {
            $pelanggan->delete();
            return back()->with('toast_success', 'Data user berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('toast_error', 'Data user tidak dapat dihapus');
        }
    }
}
