<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class SkuDepartment extends Model
{
	use HasFactory;

	public static function insertData($data){

		$value=DB::table('product_store')->where('sku_code', $data->get('sku_code'))->update([
			'm_department' => $data->get('m_department'),
			'norm_price'       => $data->get('norm_price')]);
		// ->where('sku_code', $data['sku_code'])->get();
		
		if($value->count() == 0){
		   DB::table('product_store')->insert($data);
		}
	}
	// protected $fillable = [
	// 	'sku_code',
	// 	'm_department',
	// 	'norm_price',

	// ];

	protected $table = 'product_store';
}
