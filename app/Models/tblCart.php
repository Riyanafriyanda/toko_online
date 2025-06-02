<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblCart extends Model
{
    use HasFactory;

    protected $table = 'tbl_carts';

    protected $fillable = [
        'idUser',
        'id_barang',
        'qty',
        'price',
    ];

    // Relasi ke product (jika ingin)
    public function product()
    {
        return $this->hasOne(product::class, 'id_barang');
    }
}
