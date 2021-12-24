@php
    $getgeneral = getGeneralSetting();
@endphp
<form name="settings" id="settings" action="{{ route('settings.store') }}" method="POST" onreset="myFunction()" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="general">
    <div class="form-group row">
        <label for="system_name" class="col-md-2 col-form-label">System Name</label>
        <div class="col-md-4">
            <input class="form-control @error('system_name') is-invalid @enderror" type="text" value="{{isset($getgeneral['system_name']) ? $getgeneral['system_name'] : ''}}" name="system_name" id="system_name">
            @if ($errors->has('system_name'))
                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('system_name') }}</strong></span>
            @endif
        </div>
        
        <label for="system_mail" class="col-md-2 col-form-label">Email</label>
        <div class="col-md-4">
            <input class="form-control @error('system_mail') is-invalid @enderror" type="text" value="{{isset($getgeneral['system_mail']) ? $getgeneral['system_mail'] : ''}}" name="system_mail" id="system_mail">
            @if ($errors->has('system_mail'))
                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('system_mail') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label">Phone</label>
        <div class="col-md-4">
            <input  for="system_phone" class="form-control @error('system_phone') is-invalid @enderror" type="text" value="{{isset($getgeneral['system_phone']) ? $getgeneral['system_phone'] : ''}}" name="system_phone" id="system_phone">
            @if ($errors->has('system_phone'))
                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('system_phone') }}</strong></span>
            @endif
        </div>
        
        <label for="date_format" class="col-md-2 col-form-label">Date format</label>
        <div class="col-md-4">
            <select class="custom-select js-delivery @error('date_format') is-invalid @enderror" name="date_format" id="date_format">
                <option value="">Select date format</option>
                <option value="d-m-Y" @if(isset($getgeneral['date_format']) && $getgeneral['date_format'] == "d-m-Y" ) selected @endif>dd-mm-YYYY ({{date("d-m-Y")}})</option>
                <option value="m-d-Y" @if(isset($getgeneral['date_format']) && $getgeneral['date_format'] == "m-d-Y" ) selected @endif>mm-dd-YYYY ({{date("m-d-Y")}})</option>
                <option value="d-M-Y" @if(isset($getgeneral['date_format']) && $getgeneral['date_format'] == "d-M-Y" ) selected @endif>dd-MM-YYYY ({{date("d-M-Y")}})</option>
                <option value="M-d-Y" @if(isset($getgeneral['date_format']) && $getgeneral['date_format'] == "M-d-Y" ) selected @endif>MM-dd-YYYY ({{date("M-d-Y")}})</option>
                <option value="M d, Y" @if(isset($getgeneral['date_format']) && $getgeneral['date_format'] == "M d, Y" ) selected @endif>MM dd, YYYY ({{date("M d, Y")}})</option>
              
            </select>
            @if ($errors->has('date_format'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('date_format') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="address_1" class="col-md-2 col-form-label">Address Line 1</label>
        <div class="col-md-4">
            <input class="form-control @error('address_1') is-invalid @enderror" type="text" value="{{isset($getgeneral['address_1']) ? $getgeneral['address_1'] : ''}}" name="address_1" id="address_1">
            @if ($errors->has('address_1'))
                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('address_1') }}</strong></span>
            @endif
        </div>
        
        <label for="address_2" class="col-md-2 col-form-label">Address Line 2</label>
        <div class="col-md-4">
            <input class="form-control @error('address_2') is-invalid @enderror" type="text" value="{{isset($getgeneral['address_2']) ? $getgeneral['address_2'] : ''}}" name="address_2" id="address_2">
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

        <div class="col-md-4">
            <img src="{!! getFullLogo() !!}" height="75" width="100">
        </div>
    </div> 
    <div class="form-group row">
        <label for="small_logo" class="col-md-2 col-form-label">Small Logo</label>
        <div class="col-md-4">
            <input class="form-control" type="file" value="" name="small_logo" id="small_logo">
        </div>
        <div class="col-md-4">
            <img src="{!! getTinyLogo() !!}" height="20" width="20">
        </div>
    </div> 
    <div class="button-items mt-3">
        <input class="btn btn-info" type="submit" value="Submit" id="submit">
        <a class="btn btn-danger waves-effect waves-light" href="{{ route('settings') }}" role="button">Cancel</a>
        <input class="btn btn-warning" type="reset" value="Reset">
    </div>
</form>