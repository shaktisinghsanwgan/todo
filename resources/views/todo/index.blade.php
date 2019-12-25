@extends('layouts.app')

@section('content')
<div class="loading"></div>
<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row" id="todoHeader">
                        <div class="col-10">
                        <h2>TODO List
                            @if(Session::get('user_type')=='admin')
                                <center class="add-button"><a href="{{route('todo.add')}}" class="btn btn-outline-primary">Add Todo</a></center>
                            @endif
                        </h2>
                        </div>
                        <div class="col-2">
                            <a href="javascript:void(0)" id="showSearch"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="row hidden" id="searchDiv">
                    <div class="col-10">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend" id="mainSearchDiv">
                          <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="searchBy" search-val="all">ALL</button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item itemVal" href="javascript:void(0)" item-val="all">ALL</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item itemVal" href="javascript:void(0)" item-val="assigned_to ">ASSIGNED TO</a>                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item itemVal" href="javascript:void(0)" item-val="assigned_by">ASSIGNED BY</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item itemVal" href="javascript:void(0)" item-val="creator">CREATED BY</a>
                            <div role="separator" class="dropdown-divider"></div>

                            <a class="dropdown-item itemVal" href="javascript:void(0)" item-val="task_name">TASK NAME</a>
                          </div>
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with dropdown button" onkeyup="searchTodo(this.value)">
                      </div>
                    </div>
                      <div class="col-2"> <a href="javascript:void(0)" id="showTodo"><i class="fa fa-times"></i></a></div>
                </div>
                </div>
                <ul class="nav nav-tabs nav-justified">
                    <li class="nav-item" id="taskAllLi">
                      <a class="nav-link active" href="javascript:void(0);" id="taskALLAnchor">ALL Task</a>
                    </li>
                    <li class=  "nav-item disabled" id="CompletedTaskLi">
                      <a class="nav-link " id="CompletedTaskAnchor" href="javascript:void(0)">Completed Task</a>
                    </li>
                    @if(Session::get('user_type')=='colleagues')
                        <li class=  "nav-item disabled" id="myTaskLi">
                        <a class="nav-link " id="myTaskAnchor" href="javascript:void(0)">My Task</a>
                        </li>
                    @endif
                  </ul>
                <input type="hidden" id="log_user_id" value="{{Session::get('id')}}">
                <input type="hidden" id="log_user_type" value="{{Session::get('user_type')}}">
                <div class="card-body" id="searchDivMain">
                    @foreach($tasks as $task)
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">{{ucwords($task->task_name)}}</h5>
                            <hr>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <div class="row">
                                    <div class="col-12 col-md-7">
                                            <strong>Created By:</strong>
                                            {{ucwords($userAr[$task->task_creator])}}
                                    </div>
                                    <div class="col-6 col-md-5">
                                        <strong>Assigned By:</strong>
                                        @if($task->task_assignee=='')
                                            <em>This task Is not assigned to anyone yet !!!</em>
                                        @else
                                            {{ucwords($userAr[$task->task_assignee])}}
                                        @endif
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-md-7">
                                        <strong>Assigned To:</strong>
                                        @if($task->user_id==''||$task->user_id=='0')
                                            <em>This task has yet to be assigned to collegue !!!</em>
                                        @else
                                            {{ucwords($userAr[$task->user_id])}}
                                        @endif
                                    </div>
                                    <div class="col-6 col-md-5">
                                        <strong>TimeLine:</strong>
                                        {{date('d/m/Y H:i:s', strtotime($task->time_line))}}
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-md-7">
                                    <strong>Task Status:</strong>
                                    @if($task->task_status=='incomplete')
                                        <span style="color:red;">
                                        {{ucwords($task->task_status)}}
                                        </span>
                                    @else
                                    <span style="color:green;">
                                        {{ucwords($task->task_status)}}
                                        </span>
                                    @endif
                                    </div>
                                    @if($task->task_completed_at!='')
                                        <div class="col-6 col-md-5">
                                            <strong>Completed At:</strong>
                                            {{date('d/m/Y H:i:s', strtotime($task->task_completed_at))}}
                                        </div>
                                    @endif
                                  </div>
                            </h6>
                            <p class="card-text"><?php echo $task->task_description;?></p>
                            <a href="{{route('todo.view',$task->id)}}" class="card-link">View Task</a>
                            @if(Session::get('user_type')=='admin')
                                <a href="{{route('todo.edit',$task->id)}}" class="card-link">Edit Task</a>
                                <a href="javascript:void(0);" onclick='deleteTask("{{$task->id}}")' class="card-link">Delete Task</a>
                            @endif
                            @if($task->user_id=='' || $task->user_id==null)
                                @if(Session::get('user_type')=='admin'||(Session::get('user_type')=='assignee' && Session::get('id')==$task->task_assignee))
                                    <a href="javascript:void(0);" onclick="assignTask('{{$task->id}}','{{Session::get('user_type')}}')" class="card-link">Assign Task</a>
                                @endif
                            @endif
                            @if(Session::get('user_type')=='colleagues' && Session::get('id')==$task->user_id && $task->task_completed_at=='')
                                <a href="javascript:void(0);" onclick="completeTask('{{$task->id}}','{{Session::get('user_type')}}')" class="card-link">Complete Task</a>
                            @endif
                            </div>
                        </div>
                      <br>
                    @endforeach
                </div>
                <div class="card-body" id="completedTaskDiv" style="display:none;">
                    @foreach($tasks as $task)
                        @if($task->task_status=="complete")
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">{{ucwords($task->task_name)}}</h5>
                            <hr>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <div class="row">
                                    <div class="col-12 col-md-7">
                                            <strong>Created By:</strong>
                                            {{ucwords($userAr[$task->task_creator])}}
                                    </div>
                                    <div class="col-6 col-md-5">
                                        <strong>Assigned By:</strong>
                                        @if($task->task_assignee=='')
                                            <em>This task Is not assigned to anyone yet !!!</em>
                                        @else
                                            {{ucwords($userAr[$task->task_assignee])}}
                                        @endif
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-md-7">
                                        <strong>Assigned To:</strong>
                                        @if($task->user_id==''||$task->user_id=='0')
                                            <em>This task has yet to be assigned to collegue !!!</em>
                                        @else
                                            {{ucwords($userAr[$task->user_id])}}
                                        @endif
                                    </div>
                                    <div class="col-6 col-md-5">
                                        <strong>TimeLine:</strong>
                                        {{date('d/m/Y H:i:s', strtotime($task->time_line))}}
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-md-7">
                                    <strong>Task Status:</strong>
                                    @if($task->task_status=='incomplete')
                                        <span style="color:red;">
                                        {{ucwords($task->task_status)}}
                                        </span>
                                    @else
                                    <span style="color:green;">
                                        {{ucwords($task->task_status)}}
                                        </span>
                                    @endif
                                    </div>
                                    @if($task->task_completed_at!='')
                                        <div class="col-6 col-md-5">
                                            <strong>Completed At:</strong>
                                            {{date('d/m/Y H:i:s', strtotime($task->task_completed_at))}}
                                        </div>
                                    @endif
                                  </div>
                            </h6>
                            <p class="card-text"><?php echo $task->task_description;?></p>
                            <a href="{{route('todo.view',$task->id)}}" class="card-link">View Task</a>
                            @if(Session::get('user_type')=='admin')
                                <a href="{{route('todo.edit',$task->id)}}" class="card-link">Edit Task</a>
                                <a href="javascript:void(0);" onclick='deleteTask("{{$task->id}}")' class="card-link">Delete Task</a>
                            @endif
                            @if($task->user_id=='' || $task->user_id==null)
                                @if(Session::get('user_type')=='admin'||(Session::get('user_type')=='assignee' && Session::get('id')==$task->task_assignee))
                                    <a href="javascript:void(0);" onclick="assignTask('{{$task->id}}','{{Session::get('user_type')}}')" class="card-link">Assign Task</a>
                                @endif
                            @endif
                            @if(Session::get('user_type')=='colleagues' && Session::get('id')==$task->user_id && $task->task_completed_at=='')
                                <a href="javascript:void(0);" onclick="completeTask('{{$task->id}}','{{Session::get('user_type')}}')" class="card-link">Complete Task</a>
                            @endif
                            </div>
                        </div>
                      <br>
                      @endif
                    @endforeach
                </div>

    </div>
</div>
</div>
</div>
</div>
@include('layouts.assign-collegue')
<script>
    var urlFetchAllTodos='{{route('todo.fetchAllTodo')}}';
    var urlDeleteTask='{{route('todo.deleteTask')}}';
    var urlAssignTask='{{route('todo.assignTask')}}';
</script>
<script src="{{asset('js/fetch.js')}}"></script>
<script src="{{asset('js/todo.js')}}"></script>
@endsection
