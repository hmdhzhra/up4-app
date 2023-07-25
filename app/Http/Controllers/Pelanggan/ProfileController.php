<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Profile';
        $username = Auth::user()->username;
        $user = Auth::user();
        $pelanggan =$user->pelanggan;
        return view('pelanggan.profile', compact(
                'title', 'username', 'user', 'pelanggan'
        ));
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
    $user = User::findOrFail($id);
    $user_id = $user->id;

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

    $pelanggan = Pelanggan::updateOrCreate(['user_id' => $user_id], $data);

    return redirect()->route('profile.index')->with('toast_success', 'Profile berhasil diperbarui.');
}

}
