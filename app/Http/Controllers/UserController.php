<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Task;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
		$this->middleware('auth');
    }

    public function index()
    {
        //
        $users = User::where('user_type', '!=','admin')->get();
        return view('user.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=> ['required'],
            'user_type'=> ['required']
        ])->validate();
        $user_type=$request->input('user_type');
        $password = $request->input('password');
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($password);
        $user->user_type =$user_type;
        $user->save();
        return redirect('/user')->with('success', 'User Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
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
        //
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore($id)],
            'password'=> ['nullable'],
            'user_type'=> ['required']
        ])->validate();
        $user_type=$request->input('user_type');
        $password = $request->input('password');
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($password);
        $user->user_type =$user_type;
        $user->save();
        return redirect('/user')->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id=$request->input('deleteId');
        $user_type=$request->input('user_type');
        if($user_type=='assignee'){
            Task::where('task_assignee',$id)->update(['task_assignee'=>'1']);
        }else{
            Task::where('user_id',$id)->update(['user_id'=>0]);
        }
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('error', 'User Deleted Successfully');
    }
}
