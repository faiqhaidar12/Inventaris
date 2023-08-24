@extends('layouts.index')
@section('title', 'Edit Transactions')
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Edit Transactions</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form action="{{ '/transactions/' . $data->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="transaction_type">Transaction Type</label>
                        <select name="transaction_type" id="transaction_type" class="form-control">
                            <option value="penjualan" {{ $data->transaction_type === 'penjualan' ? 'selected' : '' }}>
                                Penjualan</option>
                            <option value="pembelian" {{ $data->transaction_type === 'pembelian' ? 'selected' : '' }}>
                                Pembelian</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="transaction_date">Transaction Date</label>
                        <input type="date" name="transaction_date" id="transaction_date"
                            value="{{ $data->transaction_date }}" class="form-control" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control">
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ $data->customer_id === $customer->id ? 'selected' : '' }}>{{ $customer->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control">
                            <option value="">Pilih Pemasok</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ $data->supplier_id === $supplier->id ? 'selected' : '' }}>{{ $supplier->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Transaction</button>
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
