@extends('layouts.index')
@section('title', 'Edit Barang')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Barang</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form method="POST" action="{{ '/barang/' . $data->id }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input class="form-control" type="text" id="nama_barang" name="nama_barang"
                            value="{{ $data->nama_barang }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="harga" class="form-label">Harga</label>
                        <input class="form-control" type="number" id="harga" name="harga"
                            value="{{ $data->harga }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="stok" class="form-label">Stok</label>
                        <input class="form-control" type="number" id="stok" name="stok"
                            value="{{ $data->stok }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select">
                            <option value="{{ $data->kategori->id }}" selected="selected">{{ $data->kategori->name }}
                            </option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nama_barang" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10">{{ $data->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="image" class="form-label">Preview Image</label>
                        @if ($data->image)
                            <img class="form-control" style="max-height: 128px; max-width: 128px;"
                                src="{{ url('image') . '/' . $data->image }}" alt="user-avatar"
                                class="img-circle img-fluid">
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image" />
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                    <a href="{{ url('barang') }}" type="reset" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
