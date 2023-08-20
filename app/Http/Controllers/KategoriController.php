<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = Kategori::where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        })
            ->latest()
            ->orderBy('name', 'asc')
            ->paginate(15);
        return view('kategori.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);

        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ], [
            'name.required' => 'Nama Kategori Harus diisi!!',
            'name.string' => 'Nama Kategori Harus berupa text!!',
            'name.max' => 'Nama Kategori Melibihi Maximal!!',
        ]);

        $data = [
            'name' => $request->input('name')
        ];

        Kategori::create($data);
        return redirect('kategori')->with('success', 'Data Berhasil ditambahkan!');
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
        $data = Kategori::where('id', $id)->first();
        return view('kategori.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ], [
            'name.required' => 'Nama Kategori Harus diisi!!',
            'name.string' => 'Nama Kategori Harus berupa text!!',
            'name.max' => 'Nama Kategori Melibihi Maximal!!',
        ]);

        $data = [
            'name' => $request->input('name')
        ];

        Kategori::where('id', $id)->update($data);
        return redirect('kategori')->with('warning', 'Anda Berhasil Update Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kategori::where('id', $id)->delete();
        return redirect('kategori')->with('error', 'Berhasil Hapus Data!');
    }
}
