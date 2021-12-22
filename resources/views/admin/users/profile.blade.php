@extends('admin.layouts.master')

@php
$module = "Profile";
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
{!! getBreadcumb($module,$titleModule,'users') !!}
<!-- breadcumd end -->

<!-- view start -->
<div class="row">
    <div class="col-12">
        @if(session()->has('message'))
            {!! session('message') !!}
        @endif
        <div class="card">
            <div class="card-body">
                <form name="form-user" id="form-user" action="{{ route('users.store') }}" method="POST" onreset="myFunction()">
                    @csrf
                   
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">User Role</label>
                        <div class="col-md-4">
                            <input class="form-control" type="text" value="" readonly="">
                        </div>

                        <label for="example-text-input" class="col-md-2 col-form-label address">Address</label>
                        <div class="col-md-4 address">
                            <input class="form-control @error('address') is-invalid @enderror" type="text" value="{{ old('address') }}" name="address" id="address">
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('address') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-4">
                            <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name') }}" name="name" id="name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <label for="example-text-input" class="col-md-2 col-form-label address2">Address2</label>
                        <div class="col-md-4 address2">
                            <input class="form-control @error('address2') is-invalid @enderror" type="text" value="{{ old('address2') }}" name="address2" id="address2">
                            @if ($errors->has('address2'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address2') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-4">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" name="email" id="email">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <label for="example-text-input" class="col-md-2 col-form-label city">City</label>
                        <div class="col-md-4 city">
                            <input class="form-control @error('city') is-invalid @enderror " type="text" value="{{ old('city') }}" name="city" id="city">
                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('city') }}</strong></span>
                            @endif
                        </div>
                    </div>           
                    <div class="form-group row">
                        <label for="example-tel-input"  class="col-md-2 col-form-label phone">Telephone</label>
                        <div class="col-md-4 phone">
                            <input  class="form-control @error('phone') is-invalid @enderror allow_integer" type="tel" value="{{ old('phone') }}" name="phone" id="phone" maxlength="15"> 
                            
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('phone') }}</strong></span>
                            @endif
                        </div>
                    
                        <label for="example-text-input" class="col-md-2 col-form-label state">State</label>
                        <div class="col-md-4 state">
                            <input class="form-control @error('state') is-invalid @enderror" type="text" value="{{ old('state') }}" name="state" id="state">
                            @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('state') }}</strong></span>
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
                        <label for="example-text-input" class="col-md-2 col-form-label country">Country</label>
                        <div class="col-md-4 country">
                            <input class="form-control @error('country') is-invalid @enderror" type="text" value="{{ old('country') }}" name="country" id="country">
                            @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('country') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Company Name</label>
                        <div class="col-md-4">
                            <input class="form-control @error('company') is-invalid @enderror" type="text" value="{{ old('company') }}" name="company" id="company">
                            @if ($errors->has('company'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('company') }}</strong></span>
                            @endif
                        </div>
                        <label for="example-number-input" class="col-md-2 col-form-label zipcode">Zipcode</label>
                        <div class="col-md-4 zipcode">
                            <input class="form-control @error('zipcode') is-invalid @enderror allow_integer" type="tel" value="{{ old('zipcode') }}" name="zipcode" id="zipcode" maxlength="6">
                            @if ($errors->has('zipcode'))
                                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('zipcode') }}</strong></span>
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