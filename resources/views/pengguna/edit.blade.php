@extends('layouts.index')
@section('title', 'Edit Pengguna')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form method="POST" action="{{ '/pengguna/' . $data->id }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Nama</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{ $data->name }}"
                            autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ $data->email }}"
                            placeholder="Masukan Email Anda" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="new_password" class="form-label">New Password</label>
                        <input class="form-control" type="password" id="new_password" name="new_password" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input class="form-control" type="password" id="new_password_confirmation"
                            name="new_password_confirmation" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="role_id" class="form-label">Role</label>
                        <select id="role_id" class="select2 form-select" name="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $data->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <a href="{{ url('pengguna') }}" type="reset" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
