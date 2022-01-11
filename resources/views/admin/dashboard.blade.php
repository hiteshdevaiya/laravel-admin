@extends('admin.layouts.master')

@section('title') Dashboard @endsection

@section('content')
@if(session()->has('message'))
{!! session('message') !!}
@endif

@php
    $dashboard = getDashboard();
@endphp

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to {{ config('app.name') }} Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-soft-primary">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p>{{ config('app.name') }} Dashboard</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ url('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ @Auth::user()->name }}</h5>
                        <p class="text-muted mb-0 text-truncate">{{ @Auth::user()->hasOneRole->role }}</p>
                    </div>

                    <div class="col-sm-5">
                        <div class="pt-4">
                            <div class="mt-4">
                                <a href="{{ route('admin.profile',['id'=>base64UrlEncode(@Auth::user()->id)]) }}" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted font-weight-medium">Total Roles</p>
                                <h4 class="mb-0">{{ isset($dashboard['totalRoles']) ? $dashboard['totalRoles'] : 0}}</h4>
                            </div>

                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bxs-user-detail font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted font-weight-medium">Total Modules</p>
                                <h4 class="mb-0">{{ isset($dashboard['totalModules']) ? $dashboard['totalModules'] : 0}}</h4>
                            </div>

                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="fas fa-list font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted font-weight-medium">Total Users</p>
                                <h4 class="mb-0">{{ isset($dashboard['totalUsers']) ? $dashboard['totalUsers'] : 0}}</h4>
                            </div>

                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                <span class="avatar-title">
                                    <i class="fas fa-users font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@section('script')
<!-- plugin js -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- Calendar init -->
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js')}}"></script>
@endsection