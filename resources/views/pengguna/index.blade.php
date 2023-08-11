@extends('layouts.index')
@section('title', 'Pengguna')
@section('content')
    <!-- Bordered Table -->
    <a href="{{ url('pengguna/create') }}" class="btn btn-sm btn-primary mb-2">Tambah Pengguna</a>
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
                                        <a class="btn btn-sm" href="#"><i class="bx bx-edit-alt me-1"></i> Edit</a> |
                                        <form action="" class="d-inline">
                                            <button class="btn btn-sm" href="#"><i class="bx bx-trash me-1"></i>
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
    </div>
    <!--/ Bordered Table -->
@endsection
