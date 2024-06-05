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

class PegawaiSupervisorController extends Controller
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
        return view('halaman.supervisor.tPegawai.table', compact('pegawais'));
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
        return view('halaman.supervisor.tPegawai.show', compact('pegawai'));
    }
}
