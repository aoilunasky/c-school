@extends('layouts.auth_app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3 class="h4 text-black text-center">Student Register</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}" class="py-4 mb-0">
            @csrf
            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control @error('f_name') is-invalid @enderror" name="f_name"
                  value="{{ old('f_name') }}" required autofocus placeholder="First Name" />
                @error('f_name')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control @error('l_name') is-invalid @enderror" name="l_name"
                  value="{{ old('l_name') }}" required placeholder="Last Name" />
                @error('l_name')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                  value="{{ old('phone') }}" required placeholder="Phone" />
                @error('phone')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail Address" name="email"  value="{{ old('email') }}"/>
                @error('email')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password"  />
                @error('password')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" required/>
                @error('f_name')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="male" class="col-form-label">Male</label>
                <input type="radio" checked="checked" name="gender" id="male" value="male" />
                <label for="female" class="col-form-label ml-3">Female</label>
                <input type="radio" name="gender" id="female" value="female" />
              </div>
              <div class="form-group col-md-6">
                <label for="online" class="col-form-label">Online</label>
                <input type="radio" checked="checked" name="lesson_type" id="online" value="1" />
                <label for="school" class="col-form-label ml-3">School</label>
                <input type="radio" name="lesson_type" id="school" value="2" />
              </div>

              <div class="form-group col-md-6">
                <input type="number" class="form-control" placeholder="Age"  name="age" value="{{ old('age') }}"/>
                @error('age')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <textarea class="form-control" placeholder="Purpose" name="purpose">{{ old('purpose') }}</textarea>
                @error('purpose')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <input type="checkbox" name="tnc" id="tnc" value="1" required="required" disabled />
                <label for="tnc" class="col-form-label">
                  <a href="{{ url('tnc/student') }}" target="_blank" id="tncl">I agree on the Term and
                    Condition</a><span class="text-danger">*</span></label>
                @error('tnc')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group text-center col-md-12">
                <input type="submit" class="btn btn-primary btn-pill" value="Register" />
              </div>
              <div class="form-group text-center col-md-12 mb-0">
                Already Have Account ?
                <a href="{{ route('login') }}" class="btn btn-link">
                  Click Here To Login
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function() {
 $('#tncl').click(function(){
  $('#tnc').prop('disabled', false);
  $('#tnc').prop('checked', true);
  
 });
});
</script>
@endsection