<?php

namespace App\Http\Controllers;

//import model pegawai
use App\Models\Pegawai;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Http Request
use Illuminate\Http\Request;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class PegawaiAdminController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(): View
    {
        //get all pegawai
        $pegawais = Pegawai::latest()->paginate(10);

        //render view with pegawai
        return view('halaman.admin.tPegawai.table', compact('pegawais'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('halaman.admin.tPegawai.create');
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
            'nama'         => 'required',
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
        Pegawai::create([
            'foto'         => $foto->hashName(),
            'nama'         => $request->nama,
            'alamat'       => $request->alamat,
            'tempatLahir'  => $request->tempatLahir,
            'tglLahir'     => $request->tglLahir,
            'kelamin'      => $request->kelamin,
            'jabatan'      => $request->jabatan,
            'mulaiMasuk'   => $request->mulaiMasuk,
            'job'          => $request->job
        ]);

        //redirect to index
        return redirect()->route('pegawaiAdmin.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get pegawai by ID
        $pegawai = Pegawai::findOrFail($id);

        //render view with pegawai
        return view('halaman.admin.tPegawai.show', compact('pegawai'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get pegawai by ID
        $pegawai = Pegawai::findOrFail($id);

        //render view with pegawai
        return view('halaman.admin.tPegawai.edit', compact('pegawai'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'foto'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'         => 'required',
            'alamat'       => 'required',
            'tempatLahir'  => 'required',
            'tglLahir'     => 'required',
            'kelamin'      => 'required',
            'jabatan'      => 'required',
            'mulaiMasuk'   => 'required',
            'job'          => 'required'
        ]);

        //get pegawai by ID
        $pegawai = Pegawai::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {

            //upload new foto
            $foto = $request->file('foto');
            $foto->storeAs('public/pegawais', $foto->hashName());

            //delete old foto
            Storage::delete('public/pegawais/' . $pegawai->foto);

            //update pegawai with new foto
            $pegawai->update([
                'foto'         => $foto->hashName(),
                'nama'         => $request->nama,
                'alamat'       => $request->alamat,
                'tempatLahir'  => $request->tempatLahir,
                'tglLahir'     => $request->tglLahir,
                'kelamin'      => $request->kelamin,
                'jabatan'      => $request->jabatan,
                'mulaiMasuk'   => $request->mulaiMasuk,
                'job'          => $request->job
            ]);
        } else {

            //update product without foto
            $pegawai->update([
                'nama'         => $request->nama,
                'alamat'       => $request->alamat,
                'tempatLahir'  => $request->tempatLahir,
                'tglLahir'     => $request->tglLahir,
                'kelamin'      => $request->kelamin,
                'jabatan'      => $request->jabatan,
                'mulaiMasuk'   => $request->mulaiMasuk,
                'job'          => $request->job
            ]);
        }

        //redirect to index
        return redirect()->route('pegawaiAdmin.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $pegawai = Pegawai::findOrFail($id);

        //delete image
        Storage::delete('public/pegawais/' . $pegawai->foto);

        //delete pegawai
        $pegawai->delete();

        //redirect to index
        return redirect()->route('pegawaiAdmin.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
