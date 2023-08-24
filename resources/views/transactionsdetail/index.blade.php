@extends('layouts.index')
@section('title', 'Transaction Detail')
@section('content')
    <a href="{{ url('transactionsdetail/create') }}" class="btn btn-sm btn-primary mb-2">Tambah Transaction Detail</a>
    <form action="{{ url('/transactionsdetail') }}" method="GET">
        <div class="input-group input-group-merge mb-2">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input name="keyword" value="{{ request('keyword') }}" type="text" class="form-control" placeholder="Search..."
                aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>
    </form>

    <div class="card">
        <h5 class="card-header">Transaction Detail Table</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Transaksi Tipe</th>
                            <th>Produk / Barang</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->transactions->transaction_type }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->subtotal }}</td>
                                <td style="width: 150px">
                                    <a class="btn btn-sm" href="{{ url('/transactionsdetail/' . $item->id . '/edit') }}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a> |
                                    <form action="{{ '/transactionsdetail/' . $item->id }}" method="POST"
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
