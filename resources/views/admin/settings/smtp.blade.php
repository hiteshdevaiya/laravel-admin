@php
    $getsmtp = getMailSetting();
@endphp
<form name="settings" id="settings" action="{{ route('settings.store') }}" method="POST" onreset="myFunction()">
    @csrf
    <input type="hidden" name="type" value="smtp">
    <div class="form-group row">
        <label class="col-md-2 col-form-label">Mail driver</label>
        <div class="col-md-4">
            <input class="form-control @error('mail_driver') is-invalid @enderror" type="text" value="{{isset($getsmtp['mail_driver']) ? $getsmtp['mail_driver'] : ''}}" name="mail_driver" id="mail_driver">
            @if ($errors->has('mail_driver'))
                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_driver') }}</strong></span>
            @endif
        </div>
        
        <label for="example-text-input" class="col-md-2 col-form-label">Mail host</label>
        <div class="col-md-4">
            <input class="form-control @error('mail_host') is-invalid @enderror" type="text" value="{{isset($getsmtp['mail_host']) ? $getsmtp['mail_host'] : ''}}" name="mail_host" id="mail_host">
            @if ($errors->has('mail_host'))
                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_host') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label">Mail port</label>
        <div class="col-md-4">
            <input class="form-control @error('mail_port') is-invalid @enderror" type="text" value="{{isset($getsmtp['mail_port']) ? $getsmtp['mail_port'] : ''}}" name="mail_port" id="mail_port">
            @if ($errors->has('mail_port'))
                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_port') }}</strong></span>
            @endif
        </div>
        
        <label for="example-text-input" class="col-md-2 col-form-label">Mail username</label>
        <div class="col-md-4">
            <input class="form-control @error('mail_username') is-invalid @enderror" type="text" value="{{isset($getsmtp['mail_username']) ? $getsmtp['mail_username'] : ''}}" name="mail_username" id="mail_username">
            @if ($errors->has('mail_username'))
                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_username') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label">Mail password</label>
        <div class="col-md-4">
            <input class="form-control @error('mail_password') is-invalid @enderror" type="text" value="{{isset($getsmtp['mail_password']) ? $getsmtp['mail_password'] : ''}}" name="mail_password" id="mail_password">
            @if ($errors->has('mail_password'))
                <span class="invalid-feedback" role="alert"><strong class="errors">{{ $errors->first('mail_password') }}</strong></span>
            @endif
        </div>
        
        <label for="mail_encryption" class="col-md-2 col-form-label">Mail encryption</label>
        <div class="col-md-4">
            <select class="custom-select js-delivery @error('date_format') is-invalid @enderror" name="mail_encryption" id="mail_encryption">
                <option value="">Select mail encryption</option>
                <option value="tls" @if(isset($getsmtp['mail_encryption']) && $getsmtp['mail_encryption'] == "tls" ) selected @endif>tls</option>
                <option value="ssl" @if(isset($getsmtp['mail_encryption']) && $getsmtp['mail_encryption'] == "ssl" ) selected @endif>ssl</option>
            </select>
            @if ($errors->has('mail_encryption'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('mail_encryption') }}</strong></span>
            @endif
        </div>
    </div> 
    <div class="button-items mt-3">
        <input class="btn btn-info" type="submit" value="Submit" id="submit">
        <a class="btn btn-danger waves-effect waves-light" href="{{ route('settings') }}" role="button">Cancel</a>
        <input class="btn btn-warning" type="reset" value="Reset">
    </div>
</form>