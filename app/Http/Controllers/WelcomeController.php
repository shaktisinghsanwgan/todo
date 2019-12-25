<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;
class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks=Task::all();
        $users=User::all();
        $userAr=array();
        foreach($users as $user){
            $userAr[$user->id]=$user->name;
        }
        return view('welcome')->with('tasks',$tasks)->with('userAr',$userAr);
    }
    public function fetchAllTodo(){
        $tasks=Task::all();
        $users=User::all();
        $userAr=array();
        foreach($users as $user){
            $userAr[$user->id]=$user->name;
        }
        $todoAr=array();
        foreach($tasks as $task){
            $taskAr=array();
            $taskAr['task_name']=ucwords($task->task_name);
            $taskAr['created_by']=ucwords($userAr[$task->task_creator]);
            if($task->task_assignee==''){
                $taskAr['task_assignee']='This task Is not assigned to anyone yet !!!';
            }else{
                $taskAr['task_assignee']=ucwords($userAr[$task->task_assignee]);
            }
            if($task->user_id==''){
                $taskAr['user_assigned']='This task Is not assigned to anyone yet !!!';
            }else{
                $taskAr['user_assigned']=ucwords($userAr[$task->user_id]);
            }
            $taskAr['time_line']=date('d/m/Y H:i:s', strtotime($task->time_line));
            $taskAr['task_description']=$task->task_description;
            $taskAr['task_id']=$task->id;
            $taskAr['task_assignee_id']=$task->task_assignee;
            $taskAr['task_user_id']=$task->user_id;
            $taskAr['task_status']=$task->task_status;
            $taskAr['task_completed_at']=date('d/m/Y H:i:s', strtotime($task->task_completed_at));
            array_push($todoAr,$taskAr);
        }
        echo json_encode($todoAr);
    }
    public function view(Request $request,$id){
        $task=Task::find($id);
        $users=User::all();
        $userAr=array();
        foreach($users as $user){
            $userAr[$user->id]=$user->name;
        }
        $sub_tasks=Task::find($id)->sub_tasks()->get();

        return view('todo.view')->with('userAr',$userAr)->with('task',$task)->with('sub_tasks',$sub_tasks);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
