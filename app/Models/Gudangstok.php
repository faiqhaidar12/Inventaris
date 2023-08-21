<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudangstok extends Model
{
    use HasFactory;
    protected $table = 'gudangstok';
    protected $fillable = ['gudang_id', 'barang_id', 'stok'];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
