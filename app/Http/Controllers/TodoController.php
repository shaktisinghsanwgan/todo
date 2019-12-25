<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Sub_task;
class TodoController extends Controller
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
        $collegues_details=User::where('user_type','colleagues')->get();
        $userAr=array();
        foreach($users as $user){
            $userAr[$user->id]=$user->name;
        }
        return view('todo.index')->with('tasks',$tasks)->with('userAr',$userAr)->with('collegues_details',$collegues_details);
    }

    public function __construct() {
		$this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $collegues=User::where('user_type','colleagues')->get();
        $assignees=User::where('user_type','assignee')->get();
        return view('todo.add')
               ->with('assignees',$assignees)
               ->with('collegues',$collegues);
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
        $task_id=$request->input('task_id');
        $task_name = $request->input('task_name');
        $task_description = $request->input('task_description');
        $task_assignee = $request->input('task_assignee');
        $task_creator = '1';
        if($task_assignee==""){
            $task_assignee=1;
        }
        $time_line = $request->input('time_line');
        $collegue_id = $request->input('collegue_id');
        if(trim($task_id)!="no"){
            $task = Task::find($task_id);
        }else{
            $task = new Task;
        }
        $task->task_name = $task_name;
        $task->task_description = $task_description;
        $task->task_creator = $task_creator;
        $task->user_id = $collegue_id;
        $task->time_line = $time_line;
        $task->task_assignee = $task_assignee;
        $task->save();
        echo $task->id;
    }
    function saveSubTask(Request $request){
        $subtask_id=$request->input('subtask_id');
        if(trim($subtask_id)!='no'){
            $sub_task =Sub_task::find($subtask_id);
        }else{
            $sub_task = new Sub_task;
        }
        $sub_task->task_id = $request->input('task_id');
        $sub_task->sub_task_name = $request->input('sub_task_name');
        $sub_task->sub_task_description = $request->input('sub_task_description');
        $sub_task->sub_task_timeline = $request->input('sub_task_timeline');
        $sub_task->save();
        echo $sub_task->id;
    }
    function fetchSubTask(Request $request){
        $subtask_id=$request->input('subtask_id');
        $sub_task =Sub_task::find($subtask_id);
        $sub_task->sub_task_timeline=date('Y-m-d\TH:i:s', strtotime($sub_task->sub_task_timeline));
        echo json_encode($sub_task);
    }
    function fetchAllSubTask(Request $request){
        $task_id=$request->input('task_id');
        $sub_tasks=Task::find($task_id)->sub_tasks()->get();
        $sub_task_ar=array();
        foreach($sub_tasks as $sub_task){
            $sub_task_list=array();
            $sub_task_list['sub_task_name']=ucwords($sub_task->sub_task_name);
            $sub_task_list['id']=$sub_task->id;
            $sub_task_list['sub_task_time_line']=date('d/m/Y H:i:s', strtotime($sub_task->sub_task_timeline));
            if($sub_task->sub_task_completed_date==''){
                $sub_task_list['sub_task_completed_date']='';
            }else{
                $sub_task_list['sub_task_completed_date']=date('Y-m-d\TH:i:s', strtotime($sub_task->sub_task_completed_date));
            }
            array_push($sub_task_ar,$sub_task_list);
        }
        echo json_encode($sub_task_ar);
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
        $collegues=User::where('user_type','colleagues')->get();
        $assignees=User::where('user_type','assignee')->get();
        $task=Task::find($id);
        $subtasks=Task::find($id)->sub_tasks()->get();
        return view('todo.edit')->with('task',$task)
                                ->with('assignees',$assignees)
                                ->with('collegues',$collegues)
                                ->with('subtasks',$subtasks);
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
    public function deleteSubTask(Request $request){
        $subtask_id=$request->input('subtask_id');
        $subtask=Sub_task::find($subtask_id);
        $subtask->delete();
        echo 'success';
    }
    public function deleteTask(Request $request){
        $task_id=$request->input('task_id');
        Task::find($task_id)->sub_tasks()->delete();
        $task=Task::find($task_id);
        $task->delete();
        echo 'success';
    }
    public function saveSubTaskTimeLine(Request $request){
        $ids=$request->input('ids');
        $subTaskTimeLines=$request->input('subTaskTimeLines');
        foreach($ids as $key=>$sub_task_id){
            $sub_task=Sub_task::find($sub_task_id);
            $sub_task->sub_task_completed_date=$subTaskTimeLines[$key];
            $sub_task->save();
        }
        echo 'success';
    }
    public function saveTaskTimeLine(Request $request){
        $task_id=$request->input('task_main_id');
        $task_time_line=$request->input('task_time_line');
        $task=Task::find($task_id);
        $task->task_completed_at=$task_time_line;
        $task->task_status='complete';
        $task->save();
        echo 'success';
    }
    public function assignTask(Request $request){
        $task_id=$request->input('task_id');
        $task_assignee_id=$request->input('task_assignee_id');
        $assign_to_user=$request->input('assign_to_user');
        $task=Task::find($task_id);
        $task->task_assignee=$task_assignee_id;
        $task->user_id=$assign_to_user;
        $task->save();
        echo 'success';
    }
}
