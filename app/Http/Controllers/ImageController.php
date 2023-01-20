<?php

namespace App\Http\Controllers;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\SkuDepartment;

// may need to add one page for after submit reorder form, list of view
class ImageController extends Controller
{
    public function index()
	{
		return view('pages.imageUpload');
	}
	  
	
	public function store(Request $request)
	{   

		
		$storeData = $request->validate([
			
			'store_code' => 'required|string',
			'sku_code' => 'required|string',
			'order_qty' => 'required|numeric',
			'remaining_qty' => 'required|numeric',
			// 'image' => 'required|mimes:jpeg,png,jpg,gif,svg,jfif,heic',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif,heic|max:2048',
			
		]);
		
		$file_model = new File;
		if($request->method() == 'POST'){
			$file_name = time().'_'.$request->image->getClientOriginalName();
			// $filePath = $request->file('image')->storeAs('uploads', $file_name, 'public');
			$request->image->move(public_path('sku_images'), $file_name);
			$filePath = 'sku_images/'.$file_name;
			
			// from User models
			$file_model->employee_id = Auth::user()->employee_id;
			$file_model->email = Auth::user()->email;
			
			$file_model->store_code = $request->input('store_code');
			$file_model->sku_code = $request->input('sku_code');
			$file_model->order_qty = $request->input('order_qty');
			$file_model->remaining_qty = $request->input('remaining_qty');
			$file_model->file_name = time().'_'.$request->image->getClientOriginalName();
			$file_model->file_path = $filePath;

			
			$file_model->save();
		}

		return back()
				->with('success','You have successfully upload image.')
				->with('image', $file_name);
	}

	public function reorderForm(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'store' => 'bail|required',
			'sku_code' => 'required',
			'order_qty' => 'required',
			'remaining_qty' => 'required'
		]);
		
		if ($validator->fails()){
			return redirect('/image-upload')
					->withErrors($validator)
					->withInput();
		}

		//or return to store 
		return $validator;
		
	}


	public function searchSKU(Request $request){
		$query = $request->get('query');
		$filter_result = SkuDepartment::select("sku_code")
						->where('sku_code', 'LIKE', '%'.$query.'%')
						->get();

		// dd(response()->json($filter_result));
		return response()->json($filter_result);

	}
}
