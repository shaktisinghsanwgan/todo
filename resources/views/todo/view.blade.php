@extends('layouts.app')

@section('content')
<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    @if(Session::get('user_type'))
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
    @endif
    <!-- Demo content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                                <h2>View TODO</h2>&nbsp;
                                @if(Session::get('user_type')==null)
                                    <a href="{{route('welcome')}}" class="btn btn-outline-primary">Back To All Todos</a>
                                @endif
                                @if(Session::get('user_type')=='colleagues' && Session::get('id')==$task->user_id)
                                @php
                                  {{
                                      $task_completed_at='';
                                      if($task->task_completed_at!=''){
                                        $task_completed_at=date('Y-m-d\TH:i:s', strtotime($task->task_completed_at));
                                      }
                                  }}
                                @endphp
                        <a href="javascript:void(0);" class="btn btn-outline-primary" onclick="showTask('{{$task_completed_at}}','{{$task->task_name}}','{{$task->time_line}}','{{$task->id}}','{{Session::get('id')}}')">Complete Task</a>
                                @endif
                        </div>
                    </div>
                    <div class="card-body" id="taskMainDiv">
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
                                        @if($task->task_assignee==''||$task->user_id=='0')
                                            <em>This task Is not assigned to anyone yet !!!</em>
                                        @else
                                            {{ucwords($userAr[$task->task_assignee])}}
                                        @endif
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-md-7">
                                        <strong>Assigned To:</strong>
                                        @if($task->user_id=='')
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
                            <hr>
                            <h3>Sub Tasks Details</h3>
                            <hr>
                                @foreach($sub_tasks as $sub_task)
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">{{ucwords($sub_task->sub_task_name)}}</h5>
                                    <hr>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <div class="row">
                                            <div class="col-12 col-md-7">
                                                <strong>TimeLine:</strong>
                                                {{date('d/m/Y H:i:s', strtotime($sub_task->sub_task_timeline))}}
                                            </div>
                                            @if($sub_task->sub_task_completed_date!='')
                                                <div class="col-6 col-md-5">
                                                    <strong>Completed At:</strong>
                                                    {{date('d/m/Y H:i:s', strtotime($sub_task->sub_task_completed_date))}}
                                                </div>
                                            @endif
                                          </div>
                                    </h6>
                                    <div class="card-content">
                                        <?php echo $sub_task->sub_task_description;?>
                                    </div>
                                    </div>
                                </div>
                                <br>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@include('todo.saveTask-model')
<script>
    var urlFetchAllTodos='{{route('todo.fetchAllTodo')}}';
    var urlFetchSubTask='{{route('todo.fetchAllSubTask')}}';
    var urlSaveSubTaskTimeLine='{{route('todo.saveSubTaskTimeLine')}}';
    var urlSaveTaskTimeLine='{{route('todo.saveTaskTimeLine')}}';
</script>
<script src="{{asset('js/fetch.js')}}"></script>
@endsection
