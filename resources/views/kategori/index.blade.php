@extends('layouts.index')
@section('title', 'Kategori')
@section('content')
    <a href="{{ url('kategori/create') }}" class="btn btn-sm btn-primary mb-2">Tambah Kategori</a>
    <div class="card">
        <h5 class="card-header">Kategori</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
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
                                <td>{{ $item->name }}</td>
                                <td style="width: 150px">
                                    <a class="btn btn-sm" href="{{ url('/kategori/' . $item->id . '/edit') }}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a> |
                                    <form onsubmit="return confirm('Apakah Anda Yakin Ingin Hapus Data?')"
                                        action="{{ '/kategori/' . $item->id }}" method="POST" class="d-inline">
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
    </div>
@endsection
