@extends('admin.layouts.master')

@php
$module = "User";
$titleModule = "Add ".$module;
$moduleList = $module." List ";

$id = 0;
if(isset($edit) && !empty($edit)){
    $titleModule = "Edit ".$module;
    $id = $edit->id;
}
@endphp

@section('title',$titleModule)

@section('content')

<!-- breadcumd start -->
{!! getBreadcumb($module,['users'=>$moduleList,'same'=>$titleModule]) !!}
<!-- breadcumd end -->

<!-- view start -->
<div class="row">
    <div class="col-12">
        @if(session()->has('message'))
            {!! session('message') !!}
        @endif
        <div class="card">
            <div class="card-body">
                <form name="form-user" id="form-user" action="{{ route('users.store',['id'=>$id]) }}" method="POST" onreset="myFunction()" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" id="userId" value="{{$id}}">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">User Role</label>
                        <div class="col-md-4">
                            <select class="custom-select js-delivery @error('role_id') is-invalid @enderror" name="role_id" id="role_id">
                                <option value="">Select user role</option>
                                @forelse($role as $onerole)
                                    <option value="{{ $onerole->id }}" @if((isset($edit) && !empty($edit)) && ($edit->role_id == $onerole->id)) selected @endif)>{{ $onerole->role }}</option>
                                @empty
                                    <option value="">No Role Found</option>
                                @endforelse
                            </select>
                            @if ($errors->has('role_id'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('role_id') }}</strong></span>
                            @endif
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
                            <input class="form-control @error('confirm_password') is-invalid @enderror" type="password" value="{{ old('confirm_password') }}" name="confirm_password" id="confirm_password">
                            @if ($errors->has('confirm_password'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('confirm_password') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        @php $selected = (isset($edit) && !empty($edit)) ? $edit->status : ''; @endphp    
                        <label class="col-md-2 col-form-label">Status</label>
                        <div class="col-md-4">
                            <select class="custom-select js-delivery @error('status') is-invalid @enderror" name="status" id="status">
                                {!! getStatusDropdown($selected) !!}
                            </select>
                            @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('status') }}</strong></span>
                            @endif
                        </div>
                        <label class="col-md-2 col-form-label">Email verified</label>
                        <div class="col-md-4">
                            <select class="custom-select js-delivery @error('email_verified') is-invalid @enderror" name="email_verified" id="email_verified">
                                @php
                                    $verify = ((isset($edit) && !empty($edit)) && ($edit->email_verified_at != "")) ? 1 : 0;
                                @endphp
                                <option value="0" @if($verify == 0) selected @endif>No</option>
                                <option value="1"  @if($verify == 1) selected @endif>Yes</option>
                            </select>
                            @if ($errors->has('email_verified'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email_verified') }}</strong></span>
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