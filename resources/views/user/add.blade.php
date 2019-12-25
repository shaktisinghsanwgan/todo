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
                                <h2>Create User</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.create') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                                <div class="col-md-6">
                                    <input id="user_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror"   value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input id="password" name="password" type="password" lass="form-control @error('password') is-invalid @enderror" aria-describedby="basic-addon2" required>
                                        <div class="input-group-append">
                                          <span class="input-group-text" id="basic-addon2">
                                              <a href="javascript:void(0);" id="passHref" onclick="showPassword('show')"><i class="fas fa-eye-slash" id="eye" style="padding:3px !important;"></i></a></span>
                                        </div>
                                      </div>
                                    </div>
                                    @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                            </div>
                            <div class="form-group row">
                                <label for="assigned_to" class="col-md-4 col-form-label text-md-right">User Type</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="user_type" name="user_type" required>
                                        <option value="">Select User Type</option>
                                        <option value="assignee">Assignee</option>
                                        <option value="colleagues">Colleagues</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <script>
      var showPassword=function(str){
          if(str=="show"){
              $("#password").attr('type','text');
              $("#eye").removeClass('fa-eye-slash');
              $("#eye").addClass('fa-eye');
              $("#passHref").attr('onclick',"showPassword('hide')");
          }else{
            $("#password").attr('type','password');
            $("#eye").removeClass('fa-eye');
            $("#eye").addClass('fa-eye-slash');
            $("#passHref").attr('onclick',"showPassword('show')");
          }
      }
  </script>
@endsection
