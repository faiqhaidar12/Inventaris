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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 20px">
                                <strong>1</strong>
                            </td>
                            <td>Faiq</td>
                            <td>
                                Faiq@gmail.com
                            </td>
                            <td style="width: "><span class="badge bg-label-primary me-1">Admin</span></td>
                            <td style="width: 150px">
                                <a class="btn btn-sm" href="#"><i class="bx bx-edit-alt me-1"></i> Edit</a> |
                                <form action="" class="d-inline">
                                    <button class="btn btn-sm" href="#"><i class="bx bx-trash me-1"></i>
                                        Delete</button>
                                </form>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
@endsection
