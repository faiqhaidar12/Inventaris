@extends('layouts.index')
@section('title', 'Tambah Barang')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Barang</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form method="POST" action="/barang" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input class="form-control" type="text" id="nama_barang" name="nama_barang"
                            value="{{ Session::get('nama_barang') }}" autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="harga" class="form-label">Harga</label>
                        <input class="form-control" type="number" id="harga" name="harga"
                            value="{{ Session::get('harga') }}" autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="stok" class="form-label">Stok</label>
                        <input class="form-control" type="number" id="stok" name="stok"
                            value="{{ Session::get('stok') }}" autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select">
                            <option>---Pilih Kategori---</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @if (Session::get('kategori_id') == $item->id) selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nama_barang" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10">{{ Session::get('deskripsi') }}</textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image" />
                    </div>

                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <a href="{{ url('barang') }}" type="reset" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
