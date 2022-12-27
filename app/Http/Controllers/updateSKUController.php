<?php

namespace App\Http\Controllers;


use Excel;
use Illuminate\Http\Request;
use App\Models\SkuDepartment;
use App\Imports\skuDepartmentImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class updateSKUController extends Controller
{	
	
	public function index(){
		return view('pages.updateSku');
	}

	public function importData(Request $request){

		$data = $request->validate([
			'sku_file' => 'required|max:90000|mimes:xlsx,csv',
		]);
		
		

		$file_model = new SkuDepartment;
		
		if(($request->method() == 'POST')){
			$file_name = $request->sku_file->getClientOriginalName();
			
			
			$temp_path = $request->file('sku_file')->path();
			$dt = Carbon::now();
			$new_file_name = $dt->toDateString().'_'.$file_name;

			$file_path = $request->file('sku_file')->storeAs('uploads', $new_file_name, 'public');

			$i = 0;
			$read_file = fopen($temp_path, 'r');

			// read file inline --> array
			while(($line = fgetcsv($read_file))!= False){
				
				$num = count($line);
				
				// skip header
				if($i==0){
					$i++;
					continue;
				}

				for ($c = 0; $c<$num; $c++){
					$import_data_arr[$i][] = $line[$c];
				}
				$i++;
			}
			fclose($read_file);

			
			// insert to mysql
			foreach($import_data_arr as $import_data){
				$insert_data = array(
					"sku_code" => $import_data[0],
					"m_department" => $import_data[1],
					"norm_price" => $import_data[2],
					"m_desc" => $import_data[3],
					"created_at" => \Carbon\Carbon::now(),
					"updated_at" => \Carbon\Carbon::now(),

				);
				SkuDepartment::insertData($insert_data);
			}
			Session::flash('message','Import Successful.');




			// Excel::import(new SkuDepartment, $file_name);
		}
		
		return back()->with('sucess', 'Import successfully!');
	}
}
