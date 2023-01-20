<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\SkuDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


use function PHPUnit\Framework\isEmpty;

class ReorderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	function __construct()
	{
		$this->middleware('permission:reorder-message|reorder-edit|reorder-update', ['only'=>['index', 'store']]);
		$this->middleware('permission:reorder-update', ['only'=>['edit', 'update']]);

	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function index(Request $request)
	{	
	
		
		
		$data = DB::table('image_upload as IMG')
				->join('sku_list as MAS', 'IMG.sku_code', '=', 'MAS.sku_code')
				->select('IMG.id', 'IMG.check', 'IMG.store_code', 'IMG.sku_code', 'MAS.m_desc', 'IMG.file_name', 'IMG.file_path', 'MAS.m_group', 'IMG.order_qty', 'IMG.remaining_qty', 'IMG.created_at', 'IMG.generate_msg_at')
				->orderBy('IMG.created_at', 'DESC')
				->paginate(25);
		
		return view('reorder.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 25);

	}

	public function store(Request $request)
	{	
		
		$date = date('Y-m-d h:i:s');
		$query = $request->all();
		$updated_supplier = [];
		foreach($query as $key=> $value){

			if(Str::contains($key, 'message-check-box')){
				
				$name = strval($key);
				$split_name = explode('_', $name);
				$split_id = end($split_name);
				
				$input_set = [];
				if($value == "1"){
					$message_date = Carbon::now(); //datetime

					
					$input = array('generate_msg_at' => $message_date, 'check'=>true);
					$find_reorder = File::find($split_id);
					
					$sku_code = $find_reorder->sku_code;
					$m_group = DB::table('sku_list')->select('m_group')->where('sku_code', $sku_code)->get();
					$m_group = $m_group[0]->m_group;
					$store = $find_reorder->store_code;
					$remaining_qty = $find_reorder->remaining_qty;
					$order_qty = $find_reorder->order_qty;

					$generate_message = "<b>MessageTime: ".$message_date."<br>"."<b>Supplier: ".$m_group."<br>"."Store: ".$store."<br>"."Order Quantity: ".$order_qty
										."<br>"."Balance Qauntity: ".$remaining_qty;
					
					array_push($updated_supplier, [
						'generate_msg_at' =>$message_date,
						'check' =>true,
						'view_msg'=>$generate_message
					]);

					

				}
			}
		}

		// need to split by id and update to (File, table(image_upload))
		// $find_reorder->update($input);


		// if (isset($updated_supplier) && count($updated_supplier)>0){
		// 	dd($updated_supplier);
		// }
		// else{
		// 	dd('no message');
		// }
		return redirect()->route('reorder.index', compact('updated_supplier'));
	}

	public function groupingSupplierInfor($updated_supplier)
	{
		// array_push($display_list, [
		// 	'generate_msg_at' =>$message_date,
		// 	'm_group' =>SkuDepartment::find($find_reorder->sku_code)->m_group,
		// 	'store' => $find_reorder->store_code,
			

		// ]);
	}

	public function show($id){

		$order = File::find($id);
		return view('reorder.show', compact('order'));
	}


	public function update(Request $request, $data)
	{	
		dd($request);
		return redirect()->route('reorder.index');
	}
}
