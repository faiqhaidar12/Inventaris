@extends('layouts.index')
@section('title', 'Transactions')
@section('content')
    <a href="{{ url('transactions/create') }}" class="btn btn-sm btn-primary mb-2">Tambah Transactions</a>
    <form action="{{ url('/transactions') }}" method="GET">
        <div class="input-group input-group-merge mb-2">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input name="keyword" value="{{ request('keyword') }}" type="text" class="form-control" placeholder="Search..."
                aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>
    </form>

    <div class="card">
        <h5 class="card-header">Transactions Table</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Customer/Supplier</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->transaction_type }}</td>
                                <td>{{ $item->transaction_date }}</td>
                                <td>
                                    @if ($item->transaction_type === 'penjualan')
                                        {{ $item->customer->nama ?? 'Pelanggan Tidak Tersedia' }}
                                    @elseif ($item->transaction_type === 'pembelian')
                                        {{ $item->supplier->nama ?? 'Pemasok Tidak Tersedia' }}
                                    @endif
                                </td>

                                <td style="width: 150px">
                                    <a class="btn btn-sm" href="{{ url('/transactions/' . $item->id . '/edit') }}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a> |
                                    <form action="{{ '/transactions/' . $item->id }}" method="POST"
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
