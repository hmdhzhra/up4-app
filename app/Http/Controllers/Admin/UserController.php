<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Data User';
        $data_user = User::all();
        $jumlah_data = User::all()->count();
        $jumlah_pelanggan = User::where('role', 'pelanggan')->count();
        return view('admin.user.index', compact(
                'title', 
                'data_user',
                'jumlah_data',
                'jumlah_pelanggan',
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
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|min:7|max:50',
            'email' => 'required|email:dns|unique:users|max:150',
            'password' => 'required|required_with:password_confirmation|confirmed|min:7|max:50',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->jenis_lab = $request->input('jenis_lab');
        $user->jenis_bidang = $request->input('jenis_bidang');
        $user->save();

        return back()->with('toast_success', 'User berhasil ditambahkan');
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
        $user = User::findOrFail($id);
        
        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ];
        
        if ($request->has('jenis_bidang')) {
            $data['jenis_bidang'] = $request->jenis_bidang;
        }
    
        if ($request->has('jenis_lab')) {
            $data['jenis_lab'] = $request->jenis_lab;
        }
    
        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }
    
        $user->update($data);
    
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
        $user = User::findorfail($id);
        try {
            $user->delete();
            return back()->with('toast_success', 'Data user berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('toast_error', 'Data user tidak dapat dihapus');
        }
    }
}
