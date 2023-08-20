@extends('layouts.index')
@section('title', 'Pengguna')
@section('content')
    <!-- Bordered Table -->
    <a href="{{ url('pengguna/create') }}" class="btn btn-sm btn-primary mb-2">Tambah Pengguna</a>
    <form action="{{ url('/pengguna') }}" method="GET">
        <div class="input-group input-group-merge mb-2">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input name="keyword" value="{{ request('keyword') }}" type="text" class="form-control" placeholder="Search..."
                aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>
    </form>
    <div class="card">
        <h5 class="card-header">Bordered Table</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            @if (Auth::user()->hasRole('admin') ||
                                    auth()->user()->hasRole('gudang'))
                                <th>Actions</th>
                            @endif
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
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td style="width: ">
                                    @if ($item->role)
                                        <span class="badge bg-label-primary me-1">{{ $item->role->name }}</span>
                                    @else
                                        <span class="badge bg-label-secondary me-1">Tidak ada peran</span>
                                    @endif
                                </td>
                                @if (Auth::user()->hasRole('admin') ||
                                        auth()->user()->hasRole('gudang'))
                                    <td style="width: 150px">
                                        <a class="btn btn-sm" href="{{ url('/pengguna/' . $item->id . '/edit') }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a> |
                                        <form action="{{ '/pengguna/' . $item->id }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda Yakin Ingin Hapus User?')"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETe')
                                            <button class="btn btn-sm" type="submit"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                    </td>
                                @endif
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
