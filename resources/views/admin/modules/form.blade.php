@extends('admin.layouts.master')

@php

$module = "Module";
$titleModule = "Add ".$module;

$id = 0;
if(isset($edit) && !empty($edit)){
    $titleModule = "Edit ".$module;
    $id = $edit->id;
}

@endphp

@section('title',$titleModule)

@section('content')

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Edit Modules</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('modules') }}">Modules</a></li>
                            <li class="breadcrumb-item active"> Edit Modules</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" name="edit-modules" id="edit-modules" action="{{ route('modules.store',['id'=>$id]) }}" onreset="myFunction()">
                            @csrf
                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Module</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="text" value="{{ (isset($edit) && !empty($edit)) ? $edit->module : '' }}" name="module" id="module">
                                    @if ($errors->has('module'))
                                        <span class="help-block alert-danger"><strong>{{ $errors->first('module') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="button-items mt-3">
                            <input class="btn btn-info" type="submit" value="Submit">
                            <a class="btn btn-danger waves-effect waves-light" href="{{ route('modules') }}" role="button">Cancel</a>
                            <input class="btn btn-warning" type="reset" value="Reset">
                        </div>

                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

@endsection