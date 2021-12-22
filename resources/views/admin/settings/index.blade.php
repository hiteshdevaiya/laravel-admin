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
{!! getBreadcumb($module,$titleModule,'settings') !!}
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
                <form name="settings" id="settings" action="{{ route('settings.store') }}" method="POST" onreset="myFunction()">
                        @csrf
                    <div class="tab-content p-3 text-muted">
                    
                        <div class="tab-pane active " id="general">
                            <div class="form-group row">
                                <label for="system_name" class="col-md-2 col-form-label">System Name</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('system_name') is-invalid @enderror" type="text" value="{{isset($edit->system_name) ? $edit->system_name : ''}}" name="system_name" id="system_name">
                                    @if ($errors->has('system_name'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('system_name') }}</strong></span>
                                    @endif
                                </div>
                                
                                <label for="system_mail" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('system_mail') is-invalid @enderror" type="text" value="{{isset($edit->system_mail) ? $edit->system_mail : ''}}" name="system_mail" id="system_mail">
                                    @if ($errors->has('system_mail'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('system_mail') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Phone</label>
                                <div class="col-md-4">
                                    <input  for="system_phone" class="form-control @error('system_phone') is-invalid @enderror" type="text" value="{{isset($edit->system_phone) ? $edit->system_phone : ''}}" name="system_phone" id="system_phone">
                                    @if ($errors->has('system_phone'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('system_phone') }}</strong></span>
                                    @endif
                                </div>
                                
                                <label for="date_format" class="col-md-2 col-form-label">Date format</label>
                                <div class="col-md-4">
                                    <select class="custom-select js-delivery @error('date_format') is-invalid @enderror" name="date_format" id="date_format">
                                        <option value="">Select date format</option>
                                        <option value="d-m-Y" @if(isset($edit->date_format) && $edit->date_format == "d-m-Y" ) selected @endif>dd-mm-YYYY ({{date("d-m-Y")}})</option>
                                        <option value="m-d-Y" @if(isset($edit->date_format) && $edit->date_format == "m-d-Y" ) selected @endif>mm-dd-YYYY ({{date("m-d-Y")}})</option>
                                        <option value="d-M-Y" @if(isset($edit->date_format) && $edit->date_format == "d-M-Y" ) selected @endif>dd-MM-YYYY ({{date("d-M-Y")}})</option>
                                        <option value="M-d-Y" @if(isset($edit->date_format) && $edit->date_format == "M-d-Y" ) selected @endif>MM-dd-YYYY ({{date("M-d-Y")}})</option>
                                        <option value="M d, Y" @if(isset($edit->date_format) && $edit->date_format == "M d, Y" ) selected @endif>MM dd, YYYY ({{date("M d, Y")}})</option>
                                      
                                    </select>
                                    @if ($errors->has('date_format'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('date_format') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address_1" class="col-md-2 col-form-label">Address Line 1</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('address_1') is-invalid @enderror" type="text" value="{{isset($edit->address_1) ? $edit->address_1 : ''}}" name="address_1" id="address_1">
                                    @if ($errors->has('address_1'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('address_1') }}</strong></span>
                                    @endif
                                </div>
                                
                                <label for="address_2" class="col-md-2 col-form-label">Address Line 2</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('address_2') is-invalid @enderror" type="text" value="{{isset($edit->address_2) ? $edit->address_2 : ''}}" name="address_2" id="address_2">
                                    @if ($errors->has('address_2'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('address_2') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="large_logo" class="col-md-2 col-form-label">Large Logo</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="file" value="" name="large_logo" id="large_logo">
                                </div>
                                
                                <label for="mail_encryption" class="col-md-2 col-form-label">Small Logo</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="file" value="" name="small_logo" id="small_logo">
                                </div>
                            </div> 
                        </div>

                        <div class="tab-pane" id="smtp">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Mail driver</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('mail_driver') is-invalid @enderror" type="text" value="{{isset($edit->mail_driver) ? $edit->mail_driver : ''}}" name="mail_driver" id="mail_driver">
                                    @if ($errors->has('mail_driver'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_driver') }}</strong></span>
                                    @endif
                                </div>
                                
                                <label for="example-text-input" class="col-md-2 col-form-label">Mail host</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('mail_host') is-invalid @enderror" type="text" value="{{isset($edit->mail_host) ? $edit->mail_host : ''}}" name="mail_host" id="mail_host">
                                    @if ($errors->has('mail_host'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_host') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Mail port</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('mail_port') is-invalid @enderror" type="text" value="{{isset($edit->mail_port) ? $edit->mail_port : ''}}" name="mail_port" id="mail_port">
                                    @if ($errors->has('mail_port'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_port') }}</strong></span>
                                    @endif
                                </div>
                                
                                <label for="example-text-input" class="col-md-2 col-form-label">Mail username</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('mail_username') is-invalid @enderror" type="text" value="{{isset($edit->mail_username) ? $edit->mail_username : ''}}" name="mail_username" id="mail_username">
                                    @if ($errors->has('mail_username'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_username') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Mail password</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('mail_password') is-invalid @enderror" type="text" value="{{isset($edit->mail_password) ? $edit->mail_password : ''}}" name="mail_password" id="mail_password">
                                    @if ($errors->has('mail_password'))
                                        <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_password') }}</strong></span>
                                    @endif
                                </div>
                                
                                <label for="mail_encryption" class="col-md-2 col-form-label">Mail encryption</label>
                                <div class="col-md-4">
                                    <select class="custom-select js-delivery @error('date_format') is-invalid @enderror" name="mail_encryption" id="mail_encryption">
                                        <option value="">Select mail encryption</option>
                                        <option value="TLS" @if(isset($edit->mail_encryption) && $edit->mail_encryption == "TLS" ) selected @endif>TLS</option>
                                        <option value="SSl" @if(isset($edit->mail_encryption) && $edit->mail_encryption == "SSl" ) selected @endif>SSl</option>
                                    </select>
                                    @if ($errors->has('mail_encryption'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('mail_encryption') }}</strong></span>
                                    @endif
                                </div>
                            </div> 
                        </div>

                    </div>
                    <div class="button-items mt-3">
                        <input class="btn btn-info" type="submit" value="Submit" id="submit">
                        <a class="btn btn-danger waves-effect waves-light" href="{{ route('settings') }}" role="button">Cancel</a>
                        <input class="btn btn-warning" type="reset" value="Reset">
                    </div>
                </form>
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