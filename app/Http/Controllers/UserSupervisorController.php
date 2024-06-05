<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserSupervisorController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(): View
    {
        //get all user
        $users = User::where('role', 'user')->get();

        //render view with user
        return view('halaman.supervisor.tUser.table', compact('users'));
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get user by ID
        $user = User::findOrFail($id);

        //render view with user
        return view('halaman.supervisor.tUser.show', compact('user'));
    }
}
