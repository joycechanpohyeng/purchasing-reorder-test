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
			$header = [];
			// read file inline --> array
			while(($line = fgetcsv($read_file))!= False){
				// dd($line);
				// number of column
				$num = count($line);

				//header
				if($i==0){
					$header = $line;
					$i++;
					continue;
				}

				//skip header
				else{
					if(in_array('M_PLUCODE', $header)){
						$found = array_search('M_PLUCODE', $header);		// found key
						$import_data_arr[$i]['sku_code'] = $line[$found];
					}
					if(in_array('M_DEPARTMENT', $header)){
						$found = array_search('M_DEPARTMENT', $header);
						$import_data_arr[$i]['m_department'] = $line[$found];
					}
					if(in_array('M_PRICE', $header)){
						$found = array_search('M_PRICE', $header);
						$import_data_arr[$i]['norm_price'] = $line[$found];
					}
					if(in_array('M_DESC', $header)){
						$found = array_search('M_DESC', $header);
						$insert_desc = preg_replace('/[^A-Za-z0-9\-]/', ' ',$line[$found]);
						$import_data_arr[$i]['m_desc'] = $insert_desc;
					}
					$import_data_arr[$i]["created_at"] = \Carbon\Carbon::now()->format('Y-m-d');
					$import_data_arr[$i]["updated_at"] = \Carbon\Carbon::now()->format('Y-m-d');
				}
				
				// plucode, department, norm price
				// for ($c = 0; $c<$num; $c++){
					// array[1=>[0=>plucode, 1=>department, 2=>norm_price, 3=>desc, 4=>m_status], 2=>[...]]
					// $import_data_arr[$i][] = $line[$c];
				// }
				$i++;
			}
			fclose($read_file);

			
			// insert to mysql
			// foreach($import_data_arr as $import_data){
			// 	$insert_data = array(
			// 		"sku_code" => $import_data[0],
			// 		"m_department" => $import_data[1],
			// 		"norm_price" => $import_data[2],
			// 		"m_desc" => $import_data[3],
			// 		"created_at" => \Carbon\Carbon::now(),
			// 		"updated_at" => \Carbon\Carbon::now(),

			// 	);
			// 	SkuDepartment::insertData($insert_data);
			// }
			// Session::flash('message','Import Successful.');
			

			
			$insert_data = collect($import_data_arr); //make collection to user chunk method
			$chunks = $insert_data->chunk(300);

			foreach($chunks as $chunk){

				foreach($chunk as $sub_array){
					SkuDepartment::insertData($sub_array);
				}
				
			}
			Session::flash('message','Import Successful.');

			// Excel::import(new SkuDepartment, $file_name);
		}
		
		return back()->with('sucess', 'Import successfully!');
	}
}
