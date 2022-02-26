@extends('admin.layouts.master')

@php

$module = "User Permission";
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
{!! getBreadcumb($module,['users'=>$moduleList,'same'=>$titleModule]) !!}
<!-- breadcumd end -->

<!-- view start -->
<div class="row">
    <div class="col-lg-12">
        @if(session()->has('message'))
            {!! session('message') !!}
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ ucfirst(@$rolesName) }} Module List</h4>
                <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Modules</th>
                                <th>Access</th>
                                <th>Create</th>
                                <th>Edit</th>
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($data))
                            @foreach($data as $modules)
                                @php
                                    $getPermission = checkUserPermission($id,$modules->id);
                                    $access = isset($getPermission->access) ? $getPermission->access : 0; 
                                    $create = isset($getPermission->create) ? $getPermission->create : 0; 
                                    $edit   = isset($getPermission->edit) ? $getPermission->edit : 0; 
                                    $view   = isset($getPermission->view) ? $getPermission->view : 0; 
                                    $delete = isset($getPermission->delete) ? $getPermission->delete : 0; 
                                @endphp
                                <tr>
                                    <td>{{ $modules->id }}</td>
                                    <td>{{ $modules->module }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-access-{{ $modules->id }}" value="{{ $access }}"  switch="bool"  @if($access == 1) checked @endif onclick="updatePermission('access',{{ $modules->id }})"/>
                                            <label for="square-access-{{ $modules->id }}" data-on-label="Yes" data-off-label="No"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="checkbox" id="switch-create-{{ $modules->id }}" value="{{ $create }}" switch="success" @if($create == 1) checked @endif onclick="updatePermission('create',{{ $modules->id }})" />
                                            <label for="switch-create-{{ $modules->id }}" data-on-label="Yes" data-off-label="No"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="checkbox" id="switch-edit-{{ $modules->id }}" value="{{ $edit }}" switch="primary" @if($edit == 1) checked @endif onclick="updatePermission('edit',{{ $modules->id }})" />
                                            <label for="switch-edit-{{ $modules->id }}" data-on-label="Yes" data-off-label="No"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="checkbox" id="switch-view-{{ $modules->id }}" value="{{ $view }}" switch="info" @if($view == 1) checked @endif onclick="updatePermission('view',{{ $modules->id }})" />
                                            <label for="switch-view-{{ $modules->id }}" data-on-label="Yes" data-off-label="No"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="checkbox" id="switch-delete-{{ $modules->id }}" value="{{ $delete }}" switch="danger" @if($delete == 1) checked @endif onclick="updatePermission('delete',{{ $modules->id }})" />
                                            <label for="switch-delete-{{ $modules->id }}" data-on-label="Yes" data-off-label="No"></label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- view end -->
@endsection	

@section('script')
<!-- plugin js -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- Calendar init -->
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js')}}"></script>
<script>
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function updatePermission(action,moduleId) {
        $.ajax({
            type: "POST",
            url: "{{ route('users.store') }}",
            data: {
                type: "permission",
                userId : '{{$id}}',
                action: action,
                moduleId:moduleId
            },
            success: function (response) {
                console.log(response);
                return false;
            }
        });
    }
</script>
@endsection