@extends('layouts.master')

@section('title') Edit User @endsection

@section('content')


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Edit User</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                 @if(session()->has('message'))
                {!! session('message') !!}
            @endif
                <div class="card">
                    <div class="card-body">
                        <form name="edit-user" id="edit-user-admin" action="{{ route('users.update',$userDetails['id']) }}" method="POST" onreset="myFunction()">
                            @csrf
                            @method('PUT')
                            @php($userRoleId = get_user_role(Auth::user()->id))
                            <input type="hidden" name="get_user_role" id="get_user_role" value="{{ $userRoleId['user_assigned_role']['user_role_id'] }}">
                            <input type="hidden" name="UserProfile" value="UserProfile">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label user-role-id">User Role</label>
                                <div class="col-md-4">
                                    <select class="custom-select @error('user_role_id') is-invalid @enderror user-role-id" name="user_role_id" id="user_role_id">
                                            <option selected value="{{ $userDetails['user_roles']['0']['id'] }}">{{ $userDetails['user_roles'][0]['role'] }}</option>
                                    </select>
                                    @if ($errors->has('user_role_id'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('user_role_id') }}</strong></span>
                                    @endif
                                </div>
                                <div class="container" style="margin-right:-50%; margin-top: 5% " >
                                <div class="row">
                                <label for="example-text-input" class="col-md-2 col-form-label address">Address</label>
                                <div class="col-md-4 address">
                                    <input class="form-control @error('address') is-invalid @enderror" type="text" value="{{ $userDetails['userdetails']['address'] }}" name="address" id="address">
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            </div>
                            </div>
                        

                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label" style="margin-top: -5%">Name</label>
                                <div class="col-md-4" style="margin-top:-5%">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ $userDetails['name'] }}" name="name" id="name">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                                <label for="example-text-input" class="col-md-2 col-form-label address2">Address2</label>
                                <div class="col-md-4 address2">
                                    <input class="form-control @error('address2') is-invalid @enderror " type="text" value="{{ $userDetails['userdetails']['address2'] }}" name="address2" id="address2">
                                    @if ($errors->has('address2'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address2') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{ $userDetails['email'] }}" name="email" id="email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                                <label for="example-text-input" class="col-md-2 col-form-label city">City</label>
                                <div class="col-md-4 city">
                                    <input class="form-control @error('city') is-invalid @enderror " type="text" value="{{ $userDetails['userdetails']['city'] }}" name="city" id="city">
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('city') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-tel-input" class="col-md-2 col-form-label phone">Telephone</label>
                                <div class="col-md-4 phone">
                                    <input class="form-control @error('phone') is-invalid @enderror allow_integer" type="tel" value="{{ $userDetails['userdetails']['phone'] }}" name="phone" id="phone" maxlength="11">
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                                    @endif
                                </div>
                                <label for="example-text-input" class="col-md-2 col-form-label state">State</label>
                                <div class="col-md-4 state">
                                    <input class="form-control @error('state') is-invalid @enderror " type="text" value="{{ $userDetails['userdetails']['state'] }}" name="state" id="state">
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('state') }}</strong></span>
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
                                    <input class="form-control @error('country') is-invalid @enderror " type="text" value="{{ $userDetails['userdetails']['country'] }}" name="country" id="country">
                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('country') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Company Name</label>
                                <div class="col-md-4">
                                    <input class="form-control @error('company') is-invalid @enderror" type="text" value="{{ $userDetails['userdetails']['company'] }}" name="company" id="company">
                                    @if ($errors->has('company'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('company') }}</strong></span>
                                    @endif
                                </div>
                                <label for="example-number-input" class="col-md-2 col-form-label zipcode">Zipcode</label>
                                <div class="col-md-4 zipcode">
                                    <input class="form-control @error('zipcode') is-invalid @enderror allow_integer" type="" value="{{ $userDetails['userdetails']['zipcode'] }}" name="zipcode" id="zipcode" maxlength="6">
                                    @if ($errors->has('zipcode'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('zipcode') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="button-items mt-3">
                            <input class="btn btn-info" type="submit" value="Submit">
                            <a class="btn btn-danger waves-effect waves-light" href="{{ route('users.index') }}" role="button">Cancel</a>
                            <input class="btn btn-warning" type="reset" value="Reset">
                        </div>

                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

@endsection
@section('script')
    
<script>

    $(document).ready(function(){
        $("select").change(function(){
            check3();
        }).change();
        check3();
    });
 
</script>
@endsection