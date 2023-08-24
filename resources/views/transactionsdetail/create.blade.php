@extends('layouts.index')
@section('title', 'Tambah Transaction Detail')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Tambah Transaction Detail</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form action="/transactionsdetail" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="transaction_id">Transaksi</label>
                        <select name="transaction_id" id="transaction_id" class="form-control">
                            <option value="">Pilih Transaksi</option>
                            @foreach ($transactions as $item)
                                <option value="{{ $item->id }}">{{ $item->transaction_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="barang_id">Produk</label>
                        <select name="barang_id" id="barang_id" class="form-control">
                            <option value="">Pilih Produk</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="quantity">Kuantitas</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="price">Harga</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Transaction</button>
            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const transactionTypeSelect = document.getElementById("transaction_type");
        const customerSelect = document.getElementById("customer_id");
        const supplierSelect = document.getElementById("supplier_id");

        // Function to toggle customer and supplier selects based on transaction type
        function toggleSelects() {
            if (transactionTypeSelect.value === "penjualan") {
                customerSelect.removeAttribute("disabled"); // Aktifkan customer select
                supplierSelect.setAttribute("disabled", "disabled"); // Nonaktifkan supplier select
            } else if (transactionTypeSelect.value === "pembelian") {
                customerSelect.setAttribute("disabled", "disabled"); // Nonaktifkan customer select
                supplierSelect.removeAttribute("disabled"); // Aktifkan supplier select
            } else {
                customerSelect.setAttribute("disabled", "disabled"); // Nonaktifkan customer select
                supplierSelect.setAttribute("disabled", "disabled"); // Nonaktifkan supplier select
            }
        }

        // Initial toggle based on transaction type
        toggleSelects();

        // Add event listener to transaction type select
        transactionTypeSelect.addEventListener("change", toggleSelects);
    });
</script>
