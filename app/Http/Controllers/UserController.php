<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


class UserController extends Controller
{	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:user-view|user-create|user-edit|user-delete', ['only'=> ['index', 'store']]);
        $this->middleware('permission:user-create', ['only'=>['create', 'store']]);
        $this->middleware('permission:user-edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only'=>['destroy']]);
        
    }

    public function index(Request $request)
    {   
        // dd(DB::select('select role_id from model_has_roles where model_id = ?', [1]));
        // dd(Auth::user()->id);

        $data = User::orderBy('id','DESC')->paginate(5);        // id, admin
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // find current user
        $current_user_id = Auth::user()->id;
        $current_id = DB::table('model_has_roles')->select('role_id')->where('model_id', '=', $current_user_id)->get()->toArray();
        $current_id = $current_id[0]->role_id;
        $role_name = DB::table('roles')->select('name')->where('id', $current_id)->get();
        $role_name = $role_name[0]->name;
 
 
        $roles = Role::pluck('name', 'name')->all();
 
        if (strtolower($role_name) != 'admin'){
            $roles = Arr::except($roles, ['Admin', 'admin']);
        }

        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

       
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            // 'employee_id' => 'required|unique',
            'employee_id' => 'required|unique:users,employee_id,',      // added
            'password' => 'required|same:confirm-password',
            'roles' => 'nullable'
        ]);
        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $current_user_role = Auth::user()->roles->pluck('name','name')->all();
		$current_user_role = array_change_key_case($current_user_role, CASE_LOWER);
		$j = 0;
		foreach($current_user_role as $ele){
			$current_user_role[$j] = strtolower($ele);
		}
		// dd($current_user_role);
        // dd(Auth::user()->roles->pluck('name','name')->all());
        
        // only admin can grant admin privilege
        if (!array_key_exists("admin", $current_user_role)){
            $roles = Arr::except($roles, ['Admin', 'admin']);
        }

        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'employee_id' => 'required|unique:users,employee_id,'.$id,      // added
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'nullable'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        
        // find current user
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        
        // return view to user index or dashborad
        if (Auth::user()->email == $user->email){
            if(in_array('Admin', $request->input('roles')) || in_array('Purchaser', $request->input('roles'))){
                return redirect()->route('users.index')->with('success','User updated successfully');
            }
            else{
                return redirect()->route('dashboard')->with('success','User updated successfully');
            }
        }
        else{
            return redirect()->route('users.index')->with('success','User updated successfully');
        }
     
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }



}
     