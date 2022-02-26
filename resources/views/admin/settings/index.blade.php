@extends('admin.layouts.master')

@php
$module = "settings";
$titleModule = "Add ".$module;

$id = 0;
if(isset($edit) && !empty($edit)){
    $titleModule = "Edit ".$module;
    $id = $edit->id;
}
@endphp

@section('title',$titleModule)

@section('content')

<!-- breadcumd start -->
{!! getBreadcumb($module,['settings'=>$module]) !!}
<!-- breadcumd end -->

<!-- view start -->
<div class="row">
    <div class="col-12">
        @if(session()->has('message'))
            {!! session('message') !!}
        @endif
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-custom">               
                    <li class="nav-item"><a href="#general" class="nav-link active" data-toggle="tab">General</a></li>
                    <li class="nav-item"> <a href="#smtp" class="nav-link" data-toggle="tab">Smtp</a></li>
                </ul>
     
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active " id="general">
                        @include('admin.settings.general')
                    </div>

                    <div class="tab-pane" id="smtp">
                        @include('admin.settings.smtp')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- view end -->

@endsection

@section('script')
    
<script>


</script>

@endsection