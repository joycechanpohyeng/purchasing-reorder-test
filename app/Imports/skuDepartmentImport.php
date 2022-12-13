<?php

namespace App\Imports;

use App\Models\SkuDepartment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class skuDepartmentImport implements ToCollection ,WithHeadingRow
{
	public function collection(Collection $rows){

		// Validate
		Validator::make($rows->toArray(), [
		   '*.sku_code' => 'required|string',
		   '*.m_department' => 'required|string',
		   '*.norm_price' => 'required|numeric',
		],[
			'*.sku_code.required' => 'SKU code should not empty',
			'*.m_department.required' => 'Department code should not empty',
			'*.norm_price' => "Product Price shouldn't empty"
		])->validate();
 
		foreach ($rows as $row) {
 
		   // Check email already exists
		   $count = SkuDepartment::where('sku_code',$row['sku_code'])->count();
		   if($count > 0){
			  continue;
		   }
		   SkuDepartment::create([
			'sku_code' => $rows[0],
			'm_department' => $rows[1],
			'norm_price' => $rows[2],
		  ]);
		}
	 }
 
	 // Specify header row index position to skip
	 public function headingRow(): int {
		return 1;
	 }
}
