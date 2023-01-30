<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\SkuDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Concatenate;

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
				->orderBy('MAS.m_group', 'DESC')
				->orderBy('IMG.created_at', 'DESC')
				->paginate(50);
		return view('reorder.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 50);

	}

	public function store(Request $request)
	{	
		
		$date = date('Y-m-d h:i:s');
		$query = $request->all();

		$m_group_arr = [];
		$store_arr = [];
		$sku_arr = [];

		foreach($query as $key=> $value){
			
			if(Str::contains($key, 'message-check-box')){
				
				$name = strval($key);
				$split_name = explode('_', $name);
				$split_id = end($split_name);
				
				if($value == "1"){

					$find_reorder = File::find($split_id);
					$sku_code = $find_reorder->sku_code;
					
					// id => sku
					if(!array_key_exists($split_id, $sku_arr)){
						$sku_arr[$split_id] = $sku_code;
					}
					// id => store
					if(!array_key_exists($split_id, $store_arr)){
						$store_arr[$split_id] = $find_reorder->store_code;
					}
					// sku => m_group
					$m_group = DB::table('sku_list')->select('m_group')->where('sku_code', $sku_code)->get();
					$m_group = $m_group[0]->m_group;

					if (!array_key_exists($sku_code, $m_group_arr)){
						$m_group_arr[$sku_code] = $m_group;
					}

				}
			}
		}
		
		$supplier_store = [];
		// sku => m_group
		if(!empty($m_group_arr)){

			foreach($m_group_arr as $sku => $m_group){

				$concate_store = [];
				// idx => sku (with same supplier)
				$supplier_sku = array_keys($m_group_arr, $m_group);

				foreach($supplier_sku as $idx => $sku_code){
					// idx => order id
					$sku_id = array_keys($sku_arr, $sku_code);

					foreach($sku_id as $idx2 => $order_id){

						// get store from order id
						$get_store = $store_arr[$order_id];

						if(!array_key_exists($get_store, $concate_store)){
							$concate_store[$order_id] = $get_store;
						}
					}
				}
				$supplier_store[$m_group] = $concate_store;
			}		
		}

		$message_date = Carbon::now(); //datetime
		$message = '';
		if(!empty($supplier_store)){

			foreach($supplier_store as $supplier => $value){
				$message = '<br>'.$message.'<br><b>MessageTime</b>: '.$message_date.'<br><b>Supplier</b>: '.$supplier;
				
				foreach($value as $order_id => $store){
					$get_sku = $sku_arr[$order_id];
					$find_reorder = File::find($order_id);
					$balance = $find_reorder->remaining_qty;
					$order_qty = $find_reorder->order_qty;
					$message = $message.'<br><b>Store</b>: '.$store.'<br><b>SKU</b>: '.$get_sku.'<br><b>Order Quantity</b>: '.$order_qty.'<br><b>Balance</b>: '.$balance.'<br>';
				}
				$message = $message.'<br>';
			}
		}

		if(!empty($sku_arr) && $message != ''){
			foreach($sku_arr as $order_id => $sku){
				$find_reorder = File::find($order_id);
				$input = array('generate_msg_at' => $message_date, 'check'=>true, 'view_msg' => $message);
				$find_reorder->update($input);
			}
		}
		
		return redirect()->route('reorder.index');
	}


	public function show($id){

		$reorder = File::find($id);
		return view('reorder.show', compact('reorder'));
	}


	public function update(Request $request, $data)
	{	
		dd($request);
		return redirect()->route('reorder.index');
	}
}
