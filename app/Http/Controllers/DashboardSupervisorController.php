<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import model user
use App\Models\Pegawai;

//import model user
use App\Models\User;

//import return type View
use Illuminate\View\View;

class DashboardSupervisorController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(): View
    {
        // jumlah Pegawai
        $tPegawai = Pegawai::count();
        // jumlah Pemakai
        $tUser = User::where('role', 'user')->count();
        $tSupervisor = User::where('role', 'supervisor')->count();
        // jumlah kelamin
        $jumlahLakiLaki = Pegawai::where('kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = Pegawai::where('kelamin', 'Perempuan')->count();
        // jumlah  jabatan
        $jumlahKepala = Pegawai::where('jabatan', 'kepalaSekolah')->count();
        $jumlahStaff = Pegawai::where('jabatan', 'staff')->count();
        $jumlahGuru = Pegawai::where('jabatan', 'guru')->count();
        return view('halaman.supervisor.dashboard', compact('tPegawai', 'tUser', 'tSupervisor', 'jumlahLakiLaki', 'jumlahPerempuan', 'jumlahKepala', 'jumlahStaff', 'jumlahGuru'));
    }
}
