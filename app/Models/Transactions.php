<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'transaction_type',
        'transaction_date',
        'customer_id',
        'supplier_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetails::class);
    }
}
