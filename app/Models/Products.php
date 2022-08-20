<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'kode', 'nama', 'harga', 'is_ready', 'gambar', 'id_categories'];

    public static function join()
    {
        $data = DB::table('products')
            ->join('categories', 'products.id_categories', '=', 'categories.id')
            ->get();
        return $data;
    }
}