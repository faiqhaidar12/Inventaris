@extends('layouts.index')
@section('title', 'Tambah Kategori')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Kategori</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form method="POST" action="/kategori">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="{{ Session::get('name') }}" autofocus />
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <a href="{{ url('kategori') }}" type="reset" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
