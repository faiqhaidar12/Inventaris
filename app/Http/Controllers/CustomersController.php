<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = Customers::where(function ($query) use ($keyword) {
            $query->where('nama', 'LIKE', '%' . $keyword . '%')
                ->orWhere('alamat', 'LIKE', '%' . $keyword . '%')
                ->orWhere('phone', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $keyword . '%');
        })
            ->latest()
            ->orderBy('nama', 'asc')
            ->paginate(15);
        return view('customers.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('alamat', $request->alamat);
        Session::flash('email', $request->email);
        Session::flash('phone', $request->phone);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Customers::class],
            'phone' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama Harus diisi!!',
            'nama.string' => 'Nama Harus Berupa Text!!',
            'nama.max' => 'Nama Melebihi Maximal!!',

            'alamat.required' => 'Alamat Harus diisi!!',
            'alamat.string' => 'Alamat Harus Berupa Text!!',
            'alamat.max' => 'Alamat Melebihi Maximal!!',

            'email.required' => 'Email Harus diisi!!',
            'email.string' => 'Email Harus Berupa Text!!',
            'email.email' => 'Format Harus Emaill!!',
            'email.max' => 'Email Melebihi Maximal!!',
            'email.unique' => 'Email Sudah dipakai!!',

            'phone.required' => 'No Hp Harus diisi!!',
            'phone.string' => 'No Hp Harus Berupa Text!!',
            'Pphone.max' => 'No Hp Melebihi Maximal!!',
        ]);

        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'phone' => $request->input('phone'),
        ];

        Customers::create($data);
        return redirect('customers')->with('success', 'Berhasil Tambah Data!!');
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
        $data = Customers::where('id', $id)->first();
        return view('customers.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('customers')->ignore($id),
            ],
            'phone' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama Harus diisi!!',
            'nama.string' => 'Nama Harus Berupa Text!!',
            'nama.max' => 'Nama Melebihi Maximal!!',

            'alamat.required' => 'Alamat Harus diisi!!',
            'alamat.string' => 'Alamat Harus Berupa Text!!',
            'alamat.max' => 'Alamat Melebihi Maximal!!',

            'email.required' => 'Email Harus diisi!!',
            'email.string' => 'Email Harus Berupa Text!!',
            'email.email' => 'Format Harus Emaill!!',
            'email.max' => 'Email Melebihi Maximal!!',
            'email.unique' => 'Email Sudah dipakai!!',

            'phone.required' => 'No Hp Harus diisi!!',
            'phone.string' => 'No Hp Harus Berupa Text!!',
            'Pphone.max' => 'No Hp Melebihi Maximal!!',
        ]);

        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'phone' => $request->input('phone'),
        ];

        Customers::where('id', $id)->update($data);
        return redirect('customers')->with('warning', 'Berhasil Update Data!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customers::where('id', $id)->delete();
        return redirect('customers')->with('error', 'Berhasil Hapus Data!!');
    }
}
