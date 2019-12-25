@extends('layouts.app')

@section('content')
<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    <!-- Demo content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                                <h2>Create TODO</h2>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item">
                          <a class="nav-link active" href="javascript:void(0);" id="taskMainLi">Task</a>
                        </li>
                        <li class=  "nav-item disabled" id="SubtaskLi">
                          <a class="nav-link " id="SubtaskAnchor" href="javascript:void(0)">Sub Task</a>
                        </li>
                      </ul>
                    <div class="card-body" id="taskMainDiv">
                        <form method="POST" action="">
                            @csrf
                            <div class="form-group row">
                                <input type="hidden" id="task_id" value="no">
                                <label for="task_name" class="col-md-4 col-form-label text-md-right">Task Name</label>
                                <div class="col-md-6">
                                    <input id="task_name" name="task_name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="assigned_to" class="col-md-4 col-form-label text-md-right">Assigned To</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="assigned_to" name="assigned_to" onchange="changeAssignto(this.value)" required>
                                        <option value="">Select Assigned To</option>
                                        <option value="assignee">Assignee</option>
                                        <option value="colleagues">Colleagues</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group assignee row hidden">
                                <label for="assignee" class="col-md-4 col-form-label text-md-right">Select Assignee</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="assignee" name="assignee   " required>
                                        <option value=''>Select Assignee</option>
                                        @foreach($assignees as $assignee)
                                            <option value="{{$assignee->id}}">{{ucwords($assignee->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row collegue_id hidden">
                                <label for="collegue_id" class="col-md-4 col-form-label text-md-right">Select Collegue</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="collegue_id" name="collegue_id" required>
                                        <option value=''>Select Colleague</option>
                                        @foreach($collegues as $collegue)
                                            <option value="{{$collegue->id}}">{{ucwords($collegue->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="task_description" class="col-md-4 col-form-label text-md-right">Task Description</label>
                                <div class="col-md-6">
                                    <textarea id="task_description" name="task_description" class="form-control task-description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeline" class="col-md-4 col-form-label text-md-right">Enter Deadline</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" class="form-control datetimepicker" name="timeline" id="timeline">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="button" onclick="saveTodo('save','save')" class="btn btn-primary" id="saveTodoMain">
                                        Save Todo
                                    </button>
                                    <button type="button" onclick="saveTodo('save_and_next','save')" class="btn btn-primary" id="saveAndEditTodo">
                                        Submit and Add Sub Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body" id="subTaskDiv" Style="display:none;">
                        <button class="btn btn-outline-primary" onclick="showSubtaskModal()">Add Sub Task</button>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Subtask Name</th>
                                    <th>Timeline</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="sub_task_tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  @include('todo.subtask-model')
  <script src="{{asset('ckeditor/ckeditor.js')}}" referrerpolicy="origin"></script>
  <script>
    var urlsaveTask='{{route('todo.save')}}';
    var urlSaveSubTask='{{route('todo.saveSubTask')}}';
    var urlDeleteSubTask='{{route('todo.deleteSubTask')}}';
    var urlFetchSubTask='{{route('todo.fetchSubTask')}}';
    $(document).ready(function(){
        CKEDITOR.replace('task_description');
        CKEDITOR.replace('sub_task_description');
    });
    </script>
  <script src="{{asset('js/todo.js')}}" referrerpolicy="origin"></script>
@endsection
