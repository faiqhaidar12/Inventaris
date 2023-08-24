@extends('layouts.index')
@section('title', 'Customers')
@section('content')
    <!-- Bordered Table -->
    <a href="{{ url('customers/create') }}" class="btn btn-sm btn-primary mb-2">Tambah Customers</a>
    <form action="{{ url('/customers') }}" method="GET">
        <div class="input-group input-group-merge mb-2">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input name="keyword" value="{{ request('keyword') }}" type="text" class="form-control" placeholder="Search..."
                aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>
    </form>
    <div class="card">
        <h5 class="card-header">Customers Table</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Alamat</th>
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
                                <td>{{ $item->nama }}</td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>
                                    {{ $item->phone }}
                                </td>
                                <td>
                                    {{ $item->alamat }}
                                </td>

                                <td style="width: 150px">
                                    <a class="btn btn-sm" href="{{ url('/customers/' . $item->id . '/edit') }}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a> |
                                    <form action="{{ '/customers/' . $item->id }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda Yakin Ingin Hapus User?')" class="d-inline">
                                        @csrf
                                        @method('DELETe')
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
    <!--/ Bordered Table -->
@endsection
