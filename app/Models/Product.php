<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku_code',
        'm_department',
        'dept_name',
        'product_desc',
        'norm_price'
    ];
    protected $table = 'products';
}
