<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    use HasFactory;
    protected $table = 'transactions_details';
    protected $fillable = [
        'transaction_id',
        'barang_id',
        'quantity',
        'price',
        'subtotal',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transactions::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
