<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = TransactionDetails::where(function ($query) use ($keyword) {
            $query->where('quantity', 'LIKE', '%' . $keyword . '%')
                ->orwhere('price', 'LIKE', '%' . $keyword . '%')
                ->orwhere('subtotal', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('transaction', function ($query) use ($keyword) {
                    $query->where('transaction_type', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhereHas('barang', function ($query) use ($keyword) {
                    $query->where('nama_barang', 'LIKE', '%' . $keyword . '%');
                });
        })
            ->latest()
            ->orderBy('quantity', 'asc')
            ->paginate(15);
        return view('transactionsdetail.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transactions = Transactions::all();
        $barang = Barang::all();
        return view('transactionsdetail.create')->with('transactions', $transactions)->with('barang', $barang);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
