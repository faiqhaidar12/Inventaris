<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Gudangstok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GudangStokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = Gudangstok::where(function ($query) use ($keyword) {
            $query->where('stok', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('gudang', function ($query) use ($keyword) {
                    $query->where('nama', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhereHas('barang', function ($query) use ($keyword) {
                    $query->where('nama_barang', 'LIKE', '%' . $keyword . '%');
                });
        })
            ->latest()
            ->orderBy('stok', 'asc')
            ->paginate(15);
        return view('gudangstok.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        $gudang = Gudang::all();
        return view('gudangstok.create')->with('barang', $barang)->with('gudang', $gudang);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('gudang_id', $request->gudang_id);
        Session::flash('barang_id', $request->barang_id);
        Session::flash('stok', $request->stok);

        $request->validate([
            'gudang_id' => 'required|exists:gudang,id',
            'barang_id' => 'required|exists:barang,id',
            'stok' => 'required|numeric',
        ], [
            'gudang_id.required' => 'Gudang Harus dipilih!!',
            'gudang_id.exists' => 'Gudang Tidak Sesuai!!',

            'barang_id.required' => 'Barang Harus dipilih!!',
            'barang_id.exists' => 'Barang Tidak Sesuai!!',

            'stok.required' => 'Stok Harus diisi!!',
            'stok.numeric' => 'Stok Harus Berupa Angka!!',
        ]);

        $data = [
            'gudang_id' => $request->input('gudang_id'),
            'barang_id' => $request->input('barang_id'),
            'stok' => $request->input('stok'),
        ];

        Gudangstok::create($data);
        return redirect('gudangstok')->with('success', 'Data Berhasil ditambahkan!!');
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
        $barang = Barang::all();
        $gudang = Gudang::all();
        $data = Gudangstok::where('id', $id)->first();
        return view('gudangstok.edit')->with('data', $data)->with('barang', $barang)->with('gudang', $gudang);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'gudang_id' => 'required|exists:gudang,id',
            'barang_id' => 'required|exists:barang,id',
            'stok' => 'required|numeric',
        ], [
            'gudang_id.required' => 'Gudang Harus dipilih!!',
            'gudang_id.exists' => 'Gudang Tidak Sesuai!!',

            'barang_id.required' => 'Barang Harus dipilih!!',
            'barang_id.exists' => 'Barang Tidak Sesuai!!',

            'stok.required' => 'Stok Harus diisi!!',
            'stok.numeric' => 'Stok Harus Berupa Angka!!',
        ]);

        $data = [
            'gudang_id' => $request->input('gudang_id'),
            'barang_id' => $request->input('barang_id'),
            'stok' => $request->input('stok'),
        ];

        Gudangstok::where('id', $id)->update($data);
        return redirect('gudangstok')->with('warning', 'Berhasil Update Barang!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gudangstok::where('id', $id)->delete();
        return redirect('gudangstok')->with('error', 'Berasil Hapus Data!!');
    }
}
