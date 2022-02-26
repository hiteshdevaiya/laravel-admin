@extends('admin.layouts.master')

@php
$module = "Profile";
$titleModule = "Add ".$module;
$moduleList = $module." List";

$id = 0;
if(isset($edit) && !empty($edit)){
    $titleModule = "Edit ".$module;
    $id = $edit->id;
}
@endphp

@section('title',$titleModule)

@section('content')

<!-- breadcumd start -->
{!! getBreadcumb($module,['same'=>$titleModule]) !!}
<!-- breadcumd end -->

<!-- view start -->
<div class="row">
    <div class="col-12">
        @if(session()->has('message'))
            {!! session('message') !!}
        @endif
        <div class="card">
            <div class="card-body">
                <form name="form-user" id="form-user" action="{{ route('users.store') }}" method="POST" onreset="myFunction()" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$id}}">
                    <input type="hidden" name="status" id="status" value="{{isset($edit->status) ? $edit->status : 1}}">
                    <input type="hidden" name="role_id" id="role_id" value="{{isset($edit->role_id) ? $edit->role_id : 0}}">
                    <input type="hidden" name="type" id="type" value="profile">
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">User Role</label>
                        <div class="col-md-4">
                            <input class="form-control" type="text" value="{{ (isset($edit->hasOneRole->role) && !empty($edit->hasOneRole->role)) ? $edit->hasOneRole->role : '' }}" name="name" id="name">
                        </div>
                        
                        <label for="example-text-input" class="col-md-2 col-form-label">Username</label>
                        <div class="col-md-4">
                            <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ (isset($edit) && !empty($edit)) ? $edit->name : '' }}" name="name" id="name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-2 col-form-label">First Name</label>
                        <div class="col-md-4">
                            <input class="form-control @error('first_name') is-invalid @enderror" type="text" value="{{ (isset($edit) && !empty($edit)) ? $edit->first_name : '' }}" name="first_name" id="first_name">
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('first_name') }}</strong></span>
                            @endif
                        </div>
                        <label for="example-text-input" class="col-md-2 col-form-label">Last Name</label>
                        <div class="col-md-4">
                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" value="{{ (isset($edit) && !empty($edit)) ? $edit->last_name : '' }}" name="last_name" id="last_name">
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('last_name') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-4">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{ (isset($edit) && !empty($edit)) ? $edit->email : '' }}" name="email" id="email">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <label for="example-tel-input"  class="col-md-2 col-form-label phone">Telephone</label>
                        <div class="col-md-4 phone">
                            <input  class="form-control @error('phone') is-invalid @enderror allow_integer" type="tel" value="{{ (isset($edit) && !empty($edit)) ? $edit->phone : '' }}" name="phone" id="phone" maxlength="15"> 
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('phone') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-md-2 col-form-label">Password</label>
                        <div class="col-md-4">
                            <input class="form-control @error('password') is-invalid @enderror" type="password" value="" name="password" id="password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                        <label for="example-text-input" class="col-md-2 col-form-label">Confirm Password</label>
                        <div class="col-md-4">
                            <input class="form-control @error('confirm_password') is-invalid @enderror" type="password" value="" name="confirm_password" id="confirm_password">
                            @if ($errors->has('confirm_password'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('confirm_password') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">Image</label>
                        <div class="col-md-4">
                            <input class="form-control" type="file" name="image" id="image">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="button-items mt-3">
                    <input class="btn btn-info" type="submit" value="Submit" id="submit">
                    <a class="btn btn-danger waves-effect waves-light" href="{{ route('users') }}" role="button">Cancel</a>
                    <input class="btn btn-warning" type="reset" value="Reset">
                </div>

                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- view end -->

@endsection

@section('script') 
<script>
</script>
@endsection