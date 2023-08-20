@extends('layouts.index')
@section('title', 'Tambah Pengguna')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Tambah Pengguna</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form method="POST" action="/pengguna">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Nama</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="{{ Session::get('name') }}" autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="email" id="email" name="email"
                            value="{{ Session::get('email') }}" placeholder="Masukan Email Anda" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" id="password" name="password"
                            value="{{ Session::get('password') }}" autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="password_confirmation" class="form-label">Password Konfirmasi</label>
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation"
                            autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="role_id" class="form-label">Role</label>
                        <select id="role_id" class="select2 form-select" name="role_id">
                            <option>--Pilih Role--</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <a href="{{ url('pengguna') }}" type="reset" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
