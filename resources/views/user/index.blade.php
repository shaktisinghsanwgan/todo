@extends('layouts.app')

@section('content')
@include('todo.tiny')
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
                                <h2>
                                    All Users
                                    <a href="{{route('user.create')}}" class="btn btn-outline-primary" style="float:right;">Create User</a>
                                </h2>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ucwords($user->user_type)}}</td>
                                    <td>
                                        <a href="{{route('user.edit',$user->id)}}"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0);" onclick="getDelete('{{$user->id}}','{{$user->user_type}}')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  @include('layouts.delete-modal')
  <script>
      var urlDeleteSingleElement='{{route('user.destroy')}}';
      function getDelete(str,user_type){
            $('#deleteForm').attr('action',urlDeleteSingleElement);
            $('#deleteId').val(str);
            $('#user_type').val(user_type);
            $('#deleteModal').modal('show');
      }
  </script>
@endsection
