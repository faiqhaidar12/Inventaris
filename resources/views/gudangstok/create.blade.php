@extends('layouts.index')
@section('title', 'Tambah Gudang Stok')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Gudang Stok</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form method="POST" action="/gudangstok">
                @csrf
                <div class="row">
                    <label for="gudang_id" class="form-label">Nama Gudang</label>
                    <select name="gudang_id" id="gudang_id" class="form-select">
                        <option>---Pilih Gudang---</option>
                        @foreach ($gudang as $item)
                            <option value="{{ $item->id }}" @if (Session::get('gudang_id') == $item->id) selected @endif>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <label for="barang_id" class="form-label">Nama Barang</label>
                    <select name="barang_id" id="barang_id" class="form-select">
                        <option>---Pilih Barang---</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->id }}" @if (Session::get('barang_id') == $item->id) selected @endif>
                                {{ $item->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <label for="stok" class="form-label">Jumlah Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok">
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <a href="{{ url('gudangstok') }}" type="reset" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
