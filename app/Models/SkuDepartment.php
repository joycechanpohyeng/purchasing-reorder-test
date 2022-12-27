<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class SkuDepartment extends Model
{
	use HasFactory;

	public static function insertData($data){

		// dd($data);
		$value=DB::table('sku_list')->where('sku_code', $data['sku_code'])->get();
		if ($value->count() == 0) {
			DB::table('sku_list')->insert($data);
		}
	}
	protected $fillable = [
		'sku_code',
		'm_department',
		'norm_price',
		'm_desc',

	];

	protected $table = 'sku_list';
}
