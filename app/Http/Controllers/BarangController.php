<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = Barang::where(function ($query) use ($keyword) {
            $query->where('nama_barang', 'LIKE', '%' . $keyword . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $keyword . '%')
                ->orWhere('harga', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('kategori', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhere('stok', 'LIKE', '%' . $keyword . '%');
        })
            ->latest()
            ->orderBy('nama_barang', 'asc')
            ->paginate(15);
        return view('barang.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('barang.create')->with('kategori', $kategori);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Session::flash('nama_barang', $request->nama_barang);
        Session::flash('deskripsi', $request->deskripsi);
        Session::flash('harga', $request->harga);
        Session::flash('stok', $request->stok);
        Session::flash('kategori_id', $request->kategori_id);

        $request->validate([
            'nama_barang' => 'required|string|max:255|unique:' . Barang::class,
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric|max:11',
            'kategori_id' => 'required|exists:kategori,id',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:5240',
        ], [
            'nama_barang.required' => 'Nama Barang Harus diisi!!',
            'nama_barang.string' => 'Nama Barang Harus Berupa Text!!',
            'nama_barang.max' => 'Nama Barang Melebihi Maximal!!',
            'nama_barang.unique' => 'Nama Barang Sudah Ada!!',

            'deskripsi.required' => 'Deskripsi Harus diisi!!',
            'deskripsi.string' => 'Deskripsi Harus Berupa Text!!',
            'deskripsi.max' => 'Deskripsi Melebihi Maximal!!',

            'harga.required' => 'Harga Harus diisi!!',
            'harga.numeric' => 'Harga Harus Berupa Angka!!',

            'stok.required' => 'Stok Harus diisi!!',
            'stok.numeric' => 'Stok Harus Berupa Angka!!',
            'stok.required' => 'Stok Melebihi Maximal!!',

            'kategori_id.required' => 'Kategori Harus dipilih!!',
            'kategori_id.exists' => 'Kategori Tidak Sesuai!!',

            'image.mimes' => "Jenis Image Yang Anda Masukan Bukan Png,Jpg,Jpeg,Gif!!",
            'image.required' => "Image Wajib diinput!!",
            'image.max' => "Ukuran File Yang Anda Masukan Terlalu Besar!!",

        ]);

        $foto_file = $request->file('image');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
        $foto_file->move(public_path('image'), $foto_nama);

        $data = [
            'nama_barang' => $request->input('nama_barang'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'kategori_id' => $request->input('kategori_id'),
            'image' => $foto_nama,
        ];

        Barang::create($data);
        return redirect('barang')->with('success', 'Dara Berhasil ditambahkan!!');
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
        $kategori = Kategori::all();
        $data = Barang::where('id', $id)->first();
        return view('barang.edit')->with('data', $data)->with('kategori', $kategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'nama_barang' => [
                'required',
                'string',
                'max:255',
                Rule::unique('barang', 'nama_barang')->ignore($id),
            ],
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id',
        ], [
            'nama_barang.required' => 'Nama Barang Harus diisi!!',
            'nama_barang.string' => 'Nama Barang Harus Berupa Text!!',
            'nama_barang.max' => 'Nama Barang Melebihi Maximal!!',
            'nama_barang.unique' => 'Nama Barang Sudah Ada!!',

            'deskripsi.required' => 'Deskripsi Harus diisi!!',
            'deskripsi.string' => 'Deskripsi Harus Berupa Text!!',
            'deskripsi.max' => 'Deskripsi Melebihi Maximal!!',

            'harga.required' => 'Harga Harus diisi!!',
            'harga.numeric' => 'Harga Harus Berupa Angka!!',

            'stok.required' => 'Stok Harus diisi!!',
            'stok.numeric' => 'Stok Harus Berupa Angka!!',

            'kategori_id.required' => 'Kategori Harus dipilih!!',
            'kategori_id.exists' => 'Kategori Tidak Sesuai!!',
        ]);

        $data = [
            'nama_barang' => $request->input('nama_barang'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'kategori_id' => $request->input('kategori_id'),
        ];

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:png,jpg,jpeg|max:10240',
            ], [
                'image.mimes' => "Jenis Image Yang Anda Masukan Bukan Png,Jpg,Jpeg!!",
            ]);

            $foto_file = $request->file('image');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('image'), $foto_nama);
            //sudah tersimpan di direktori

            $data_foto = Barang::where('id', $id)->first();
            File::delete(public_path('image') . '/' . $data_foto->foto);

            $data['image'] = $foto_nama;
        }


        Barang::where('id', $id)->update($data);
        return redirect('/barang')->with('warning', 'Berhasil Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Barang::where('id', $id)->first();
        File::delete(public_path('image') . '/' . $data->image);

        Barang::where('id', $id)->delete();
        return redirect('/barang')->with('success', 'Berhasil Hapus Data!');
    }
}
