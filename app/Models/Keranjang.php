<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Keranjang extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'id_categories', 'id_products'];
}