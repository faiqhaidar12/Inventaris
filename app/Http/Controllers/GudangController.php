<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = Gudang::where(function ($query) use ($keyword) {
            $query->where('nama', 'LIKE', '%' . $keyword . '%')
                ->orWhere('alamat', 'LIKE', '%' . $keyword . '%');
        })
            ->latest()
            ->orderBy('nama', 'asc')
            ->paginate(15);
        return view('gudang.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('alamat', $request->alamat);

        $request->validate([
            'nama' => 'required|string|max:255|unique:' . Gudang::class,
            'alamat' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama Gudang Wajib diisi!!',
            'nama.string' => 'Nama Gudang Harus Berupa Text!!',
            'nama.max' => 'Nama Gudang Terlalu Panjang!!',
            'nama.unique' => 'Nama Gudang Sudah Ada!!!!',

            'alamat.required' => 'Alamat Gudang Wajib diisi!!',
            'alamat.max' => 'Alamat Gudang Terlalu Panjang!!',
            'alamat.string' => 'Alamat Gudang Harus Berupa Text!!',
        ]);

        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
        ];

        Gudang::create($data);
        return redirect('gudang')->with('success', 'Berhasil Tambah Data!!');
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
        $data = Gudang::where('id', $id)->first();
        return view('gudang.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('gudang', 'nama')->ignore($id),
            ],
            'alamat' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama Gudang Wajib diisi!!',
            'nama.string' => 'Nama Gudang Harus Berupa Text!!',
            'nama.max' => 'Nama Gudang Terlalu Panjang!!',
            'nama.unique' => 'Nama Gudang Sudah Ada!!!!',

            'alamat.required' => 'Alamat Gudang Wajib diisi!!',
            'alamat.max' => 'Alamat Gudang Terlalu Panjang!!',
            'alamat.string' => 'Alamat Gudang Harus Berupa Text!!',
        ]);

        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
        ];

        Gudang::where('id', $id)->update($data);
        return redirect('gudang')->with('warning', 'Berhasil Update Data!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gudang::where('id', $id)->delete();
        return redirect('gudang')->with('error', 'Berhasil Hapus Data!!');
    }
}
