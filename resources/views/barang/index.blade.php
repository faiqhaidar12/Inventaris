@extends('layouts.index')
@section('title', 'Barang')
@section('content')
    <a href="{{ url('barang/create') }}" class="btn btn-sm btn-primary mb-2">Tambah Barang</a>
    <form action="{{ url('/barang') }}" method="GET">
        <div class="input-group input-group-merge mb-2">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input name="keyword" value="{{ request('keyword') }}" type="text" class="form-control" placeholder="Search..."
                aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>
    </form>
    <div class="card">
        <h5 class="card-header">Barang</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($data as $item)
                            <tr>
                                <td style="width: 20px">
                                    <strong>{{ $no++ }}</strong>
                                </td>
                                <td>{{ $item->kategori->name }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->stok }}</td>
                                <td><img style="max-height: 128px; max-width: 128px;"
                                        src="{{ $item->image ? url('image') . '/' . $item->image : asset('template') . '/assets/img/avatars/1.png' }}"
                                        alt="user-avatar" class="img-circle img-fluid"></td>
                                <td style="width: 150px">
                                    <a class="btn btn-sm" href="{{ url('/barang/' . $item->id . '/edit') }}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a> |
                                    <form onsubmit="return confirm('Apakah Anda Yakin Ingin Hapus Data?')"
                                        action="{{ '/barang/' . $item->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm" type="submit"><i class="bx bx-trash me-1"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $data->links() }}
    </div>
@endsection
