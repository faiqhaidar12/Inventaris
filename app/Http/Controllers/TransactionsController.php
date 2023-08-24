<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Suppliers;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = Transactions::where(function ($query) use ($keyword) {
            $query->where('transaction_type', 'LIKE', '%' . $keyword . '%')
                ->orwhere('transaction_date', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('customer', function ($query) use ($keyword) {
                    $query->where('nama', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhereHas('supplier', function ($query) use ($keyword) {
                    $query->where('nama', 'LIKE', '%' . $keyword . '%');
                });
        })
            ->latest()
            ->orderBy('transaction_type', 'asc')
            ->paginate(15);
        return view('transactions.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Suppliers::all();
        $customers = Customers::all();
        return view('transactions.create')->with('suppliers', $suppliers)->with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('transaction_date', $request->transaction_date);
        $request->validate([
            'transaction_type' => 'required|in:penjualan,pembelian',
            'transaction_date' => 'required|date',
            'customer_id' => 'required_if:transaction_type,penjualan|exists:customers,id',
            'supplier_id' => 'required_if:transaction_type,pembelian|exists:suppliers,id',
        ], [
            'customer_id.required_if' => 'Kolom pelanggan harus diisi jika tipe transaksi adalah penjualan.',
            'customer_id.exists' => 'Pelanggan yang dipilih tidak valid.',
            'supplier_id.required_if' => 'Kolom pemasok harus diisi jika tipe transaksi adalah pembelian.',
            'supplier_id.exists' => 'Pemasok yang dipilih tidak valid.',
        ]);


        // Simpan data transaksi ke dalam database
        Transactions::create([
            'transaction_type' => $request->input('transaction_type'),
            'transaction_date' => $request->input('transaction_date'),
            'customer_id' => $request->input('customer_id'),
            'supplier_id' => $request->input('supplier_id'),
        ]);

        // Redirect ke halaman yang sesuai, misalnya halaman daftar transaksi
        return redirect('/transactions')->with('success', 'Transaksi berhasil dibuat.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suppliers = Suppliers::all();
        $customers = Customers::all();
        $data = Transactions::where('id', $id)->first();
        return view('transactions.edit')->with('suppliers', $suppliers)->with('customers', $customers)->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'transaction_type' => 'required|in:penjualan,pembelian',
            'transaction_date' => 'required|date',
            'customer_id' => 'required_if:transaction_type,penjualan|exists:customers,id',
            'supplier_id' => 'required_if:transaction_type,pembelian|exists:suppliers,id',
        ], [
            'customer_id.required_if' => 'Kolom pelanggan harus diisi jika tipe transaksi adalah penjualan.',
            'customer_id.exists' => 'Pelanggan yang dipilih tidak valid.',
            'supplier_id.required_if' => 'Kolom pemasok harus diisi jika tipe transaksi adalah pembelian.',
            'supplier_id.exists' => 'Pemasok yang dipilih tidak valid.',
        ]);


        // Simpan data transaksi ke dalam database
        Transactions::where('id', $id)->update([
            'transaction_type' => $request->input('transaction_type'),
            'transaction_date' => $request->input('transaction_date'),
            'customer_id' => $request->input('customer_id'),
            'supplier_id' => $request->input('supplier_id'),
        ]);

        // Redirect ke halaman yang sesuai, misalnya halaman daftar transaksi
        return redirect('transactions')->with('warning', 'Transaksi Berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transactions::where('id', $id)->delete();
        return redirect('/transactions')->with('error', 'Berhasil Hapus Transaksi!!');
    }
}
