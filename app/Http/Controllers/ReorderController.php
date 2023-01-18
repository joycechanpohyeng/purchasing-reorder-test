<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\SkuDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
		$this->middleware('permission:reorder-message', ['only'=>['index', 'show', 'update']]);
		
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
				->select('IMG.store_code', 'IMG.sku_code', 'IMG.file_name', 'IMG.file_path', 'MAS.m_group', 'IMG.order_qty', 'IMG.remaining_qty', 'IMG.generate_msg_at')
				->paginate(25);

		return view('reorder.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 25);

	}

	public function show()
	{
		return view('');
	}

	public function update(Request $request)
	{
		
	}
}
