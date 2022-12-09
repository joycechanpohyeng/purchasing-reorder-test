<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'employee_id',
        // 'email',
        'store_code',
        'sku_code',
        'order_qty',
        'remaining_qty',
        'file_name',
        'file_path'
    ];

    protected $table = 'image_upload';
}
