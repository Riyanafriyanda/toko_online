<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tblCart; // <- Pastikan ini ada!

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = true;

    protected $fillable = [
        'sku',
        'nama_product',
        'slug',
        'type',
        'kategory',
        'harga',
        'discount',
        'quantity',
        'quantity_out',
        'foto',
        'is_active',
    ];

    // Relasi: satu produk dimiliki oleh banyak entri keranjang
    public function carts()
    {
        return $this->hasMany(tblCart::class, 'id_barang');
    }
}
