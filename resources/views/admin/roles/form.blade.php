@extends('admin.layouts.master')

@php

$module = "Role";
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
{!! getBreadcumb($module,['roles'=>$moduleList,'same'=>$titleModule]) !!}
<!-- breadcumd end -->

<!-- view start -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" name="roles-form" id="roles-form" action="{{ route('roles.store',['id'=>$id]) }}" onreset="myFunction()">
                    @csrf
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Role</label>
                        <div class="col-md-4">
                            <input class="form-control" type="text" value="{{ (isset($edit) && !empty($edit)) ? $edit->role : '' }}" name="role" id="role">
                            @if ($errors->has('role'))
                                <span class="help-block alert-danger"><strong>{{ $errors->first('role') }}</strong></span>
                            @endif
                        </div>

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
                    </div>

                    <div class="button-items mt-3">
                        <input class="btn btn-info" type="submit" value="Submit">
                        <a class="btn btn-danger waves-effect waves-light" href="{{ route('roles') }}" role="button">Cancel</a>
                        <input class="btn btn-warning" type="reset" value="Reset">
                    </div>

                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- view end -->
@endsection