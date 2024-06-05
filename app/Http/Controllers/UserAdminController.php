<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserAdminController extends Controller
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
        return view('halaman.admin.tUser.table', compact('users'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('halaman.admin.tUser.create');
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
            'name'         => 'required',
            'email'       => 'required',
            'password'  => 'required'
        ]);
        
        //create user
        User::create([
            'name'         => $request->name,
            'email'       => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        //redirect to index
        return redirect()->route('userAdmin.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        return view('halaman.admin.tUser.show', compact('user'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get user by ID
        $user = User::findOrFail($id);

        //render view with user
        return view('halaman.admin.tUser.edit', compact('user'));
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
        $validator = Validator::make($request->all(),[
            'name'         => 'required',
            'email'       => 'required',
            'password'  => 'nullable'
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        //update user
        $user['name']       = $request->name;
        $user['email']      = $request->email;

        if($request->password){
            $user['password']   = Hash::make($request->password);
        }

        User::whereid($id)->update($user);

        //redirect to index
        return redirect()->route('userAdmin.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $user = User::findOrFail($id);

        //delete user
        $user->delete();

        //redirect to index
        return redirect()->route('userAdmin.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
