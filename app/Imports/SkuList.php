<?php

namespace App\Imports;

use App\Models\SkuDepartment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SkuList implements ToCollection, WithHeadingRow
{
	/**
	* @param array $row
	*
	* @return \Illuminate\Database\Eloquent\Model|null
	*/
	// public function model(array $row)
	public function collection(Collection $rows)
	{   
		// check validation 
		Validator::make($rows->toArray(),[
			'*.sku_code' => 'required|string',
			'*.m_department' => 'required|string',
			'*.norm_price' => 'required|numeric',
			'*.m_desc' => 'nullable|string',
		], [
			'*.sku_code.required' => 'SKU code should not empty',
			'*.m_department.required' => 'Department code should not empty',
			'*.norm_price.required' => "Product Price shouldn't empty"
		])->validate();
		
		foreach($rows as $row){

			// check sku already exists
			$count = SkuDepartment::where('sku_code', $rows['sku_code'])->count();

			if ($count > 0){
				continue;
			}
			SkuDepartment::create([
				'sku_code' => $rows[0],
				'm_department' => $rows[1],
				'norm_price' => $rows[2],
				'm_desc' => $rows[3],
			]);
		}
	}

	// header row to skip
	public function headingRow():int{
		return 1;
	}


}
