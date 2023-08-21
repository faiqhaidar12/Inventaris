@extends('layouts.index')
@section('title', 'Gudang Stok')
@section('content')
    <a href="{{ url('gudangstok/create') }}" class="btn btn-sm btn-primary mb-2">Tambah Gudang Stok</a>
    <form action="{{ url('/gudangstok') }}" method="GET">
        <div class="input-group input-group-merge mb-2">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input name="keyword" value="{{ request('keyword') }}" type="text" class="form-control" placeholder="Search..."
                aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>
    </form>
    <div class="card">
        <h5 class="card-header">Gudang Stok</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Gudang</th>
                            <th>Nama Barang</th>
                            <th>stok</th>
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
                                <td>{{ $item->gudang->nama }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ $item->stok }}</td>
                                <td style="width: 150px">
                                    <a class="btn btn-sm" href="{{ url('/gudangstok/' . $item->id . '/edit') }}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a> |
                                    <form onsubmit="return confirm('Apakah Anda Yakin Ingin Hapus Data?')"
                                        action="{{ '/gudangstok/' . $item->id }}" method="POST" class="d-inline">
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
