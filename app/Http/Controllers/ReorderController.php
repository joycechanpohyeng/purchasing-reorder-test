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
				->select('IMG.id', 'IMG.check', 'IMG.store_code', 'IMG.sku_code', 'IMG.file_name', 'IMG.file_path', 'MAS.m_group', 'IMG.order_qty', 'IMG.remaining_qty', 'IMG.created_at', 'IMG.generate_msg_at')
				->orderBy('IMG.created_at', 'DESC')
				->paginate(25);
		
		return view('reorder.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 25);

	}

	public function store(Request $request)
	{	
		
		$query = $request->all();
		$j = 0;
		foreach($query as $key=> $value){

			if(Str::contains($key, 'message-check-box')){
				
				$name = strval($key);
				$split_name = explode('_', $name);
				$split_id = end($split_name);
				
				
				if($value == "1"){
					$message_date = Carbon::now(); //datetime
					$input = array('generate_msg_at' => $message_date, 'check'=>true);
					$find_reorder = File::find($split_id);
					$find_reorder->update($input);
				}
			}
		}

		return redirect()->route('reorder.index');
	}


	public function show($id){

		$order = File::find($id);
		return view('reorder.show', compact('order'));
	}


	public function update(Request $request, $data)
	{	
		dd($data);
		return redirect()->route('reorder.index');
	}
}
