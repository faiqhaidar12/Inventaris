@extends('layouts.index')
@section('title', 'Edit Customers')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Edit Customers</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form method="POST" action="{{ '/customers/' . $data->id }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input class="form-control" type="text" id="nama" name="nama" value="{{ $data->nama }}"
                            autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ $data->email }}"
                            placeholder="Masukan Email Anda" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input class="form-control" type="text" id="alamat" name="alamat"
                            value="{{ $data->alamat }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="phone" class="form-label">No Hp</label>
                        <input class="form-control" type="number" id="phone" name="phone"
                            value="{{ $data->phone }}" />
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <a href="{{ url('customers') }}" type="reset" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
