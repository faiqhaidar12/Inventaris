<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('pengguna.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('pengguna.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:' . Role::class . ',id'], // Validasi input role_id
        ], [
            'name.required' => 'Nama Harus diisi!',
            'email.required' => 'Email Harus diisi!',
            'email.unique' => "E Mail Pelanggan Sudah Dipakai!!",
            'password.required' => 'Password Harus diisi!',
            'role_id.required' => 'Role Harus dipilih!',
        ]);

        $user = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id')
        ];

        $createdUser = User::create($user);

        // Assign role using Spatie's syncRoles
        $createdUser->syncRoles([$request->input('role_id')]);

        return redirect('pengguna')->with('success', 'Berhasil Tambah User!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::all();
        $data = User::where('id', $id)->first();
        return view('pengguna.edit')->with('data', $data)->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'new_password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:' . Role::class . ',id'], // Validasi input role_id
        ], [
            'name.required' => 'Nama Harus diisi!',
            'email.required' => 'Email Harus diisi!',
            'email.unique' => "E Mail Sudah Dipakai!!",
            'new_password.confirmed' => 'Konfirmasi Password Baru Tidak Cocok!',
            'role_id.required' => 'Role Harus dipilih!',
        ]);

        $user = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id')
        ];
        if ($request->filled('new_password')) {
            $user['password'] = Hash::make($request->input('new_password'));
        }

        $updatedUser = User::find($id);
        $updatedUser->update($user);

        // Update role menggunakan Spatie's syncRoles
        $updatedUser->syncRoles([$request->input('role_id')]);
        return redirect('/pengguna')->with('update', 'Berhasil Update User!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect('pengguna')->with('success', 'Berhasil Hapus User!');
    }
}
