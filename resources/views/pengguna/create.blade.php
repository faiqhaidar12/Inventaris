@extends('layouts.index')
@section('title', 'Edit Pengguna')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Tambah Pengguna</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form id="formAccountSettings" method="POST" onsubmit="return false">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input class="form-control" type="text" id="nama" name="nama" value="" autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="email" id="email" name="email" value=""
                            placeholder="Masukan Email Anda" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" class="select2 form-select">
                            <option value="">--Pilih Role--</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="pemasok">Pemasok</option>
                            <option value="gudang">Gudang</option>
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
