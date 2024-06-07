<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class ProfileAdminController extends Controller
{
    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('halaman.admin.profile');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'foto'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'alamat'       => 'required',
            'tempatLahir'  => 'required',
            'tglLahir'     => 'required',
            'kelamin'      => 'required',
            'jabatan'      => 'required',
            'mulaiMasuk'   => 'required',
            'job'          => 'required'

        ]);

        //upload foto
        $foto = $request->file('foto');
        $foto->storeAs('public/pegawais', $foto->hashName());

        //create pegawai
        User::create([
            'foto'         => $foto->hashName(),
            'alamat'       => $request->alamat,
            'tempatLahir'  => $request->tempatLahir,
            'tglLahir'     => $request->tglLahir,
            'kelamin'      => $request->kelamin,
            'jabatan'      => $request->jabatan,
            'mulaiMasuk'   => $request->mulaiMasuk,
            'job'          => $request->job
        ]);

        //redirect to index
        return redirect()->route('adminDashboard')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
