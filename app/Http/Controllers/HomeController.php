<?php
namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;
use App\Task;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        Session::put('name', $user->name);
        Session::put('id', $user->id);
        Session::put('user_type', $user->user_type);
        $tasks=Task::all();
        $users=User::all();
        $collegues_details=User::where('user_type','colleagues')->get();
        $userAr=array();
        foreach($users as $user){
            $userAr[$user->id]=$user->name;
        }
        return view('todo.index')->with('tasks',$tasks)->with('userAr',$userAr)->with('collegues_details',$collegues_details);
    }
}
