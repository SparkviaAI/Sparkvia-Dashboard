@extends('layouts.users.app')
@section('content')

    <div class="container-fluid">
      <ul>
        <a class="navbar-brand" href="{{ route('getHomePage') }}"><img src="{{ asset('f_admin/'.$logoSetting?->value ?? 'landing-images/logo-landing.png') }}" alt=""></a>
      </ul>
    </div>

    <section class="login-form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center" id="tabClr">
              <div class="login-secton">
                <div class="row d-flex justify-content-center">
                    <!-- Login Form -->
                    <div id="login-form">
                    <h5 class="mb-3 text-center login-hed">Reset Password</h5>
                     <form method="POST" action="{{ route('userForgotPasswordPost') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label form-div12">Email address</label>
                            <input type="email" class="form-control form-div13" name="email" placeholder="Enter your email" required>
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <p class="forgot-pas">Provide the email associated with your account</p>
                        <div class="d-grid login-div">
                            <button type="submit" class="btn btn-primary">Send Request</button>
                        </div>
                    </form>
                    <p class="mt-3 text-center form-div14">
                       Remember Your password?
                        <a href="{{ route('handleLoggin') }}" class="toggle-link">Login</a>
                    </p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>




  <style>
    .tabClr {
      background-color: #f3f4f6 !important;
    }

    .auth-wrapper {
      min-height: 100vh !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      padding: 2rem !important;
    }

    .auth-box {
      background: #fff !important;
      padding: 2.5rem !important;
      border-radius: 1rem !important;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
      width: 100% !important;
      max-width: 400px !important;
    }

    .auth-logo {
      width: 60px !important;
      height: 60px !important;
      object-fit: contain !important;
    }

    .auth-header {
      text-align: center !important;
      margin-bottom: 1.5rem !important;
    }

    .auth-header h2 {
      margin-top: 0.5rem !important;
      font-weight: 700 !important;
      color: #111827 !important;
    }

    .btn-primary {
      background-color: #22c55e !important;
      border: none !important;
    }

    .btn-primary:hover {
      background-color: #16a34a !important;
    }

    .toggle-link {
      color: #22c55e !important;
      text-decoration: none !important;
      font-weight: 500 !important;
    }

    .toggle-link:hover {
      text-decoration: underline !important;
    }

    .login-secton {
          background: #fff;
          padding: 49px 40px;
          width: 100%;
          max-width: 462px;
      } 
      h5.mb-3.text-center.login-hed {
    font-weight: 600;
    font-style: Semibold;
    font-size: 28px;
    leading-trim: NONE;
    line-height: 120%;
    letter-spacing: 0%;
    text-transform: capitalize;
    color: #111111;
    padding: 0 0 15px 0;
}
label.form-label.form-div12 {
    font-family: Gilroy;
    font-weight: 400;
    font-style: Regular;
    font-size: 16px;
    leading-trim: NONE;
    line-height: 110.00000000000001%;
    letter-spacing: 0%;
    color: #11111199;
    margin-bottom: 16px;
}
input.form-control.form-div13 {
    border: 1px solid #F2F2F2;
    background: transparent;
    border-radius: 8px;
    height: 50px;
}
button.form-div-btn {
    background: #00A234;
    font-family: Gilroy;
    font-weight: 600;
    font-style: Semibold;
    font-size: 16px;
    leading-trim: NONE;
    line-height: 130%;
    letter-spacing: 0%;
    text-align: center;
    text-transform: capitalize;
    color: #fff;
    height: 51px;
    border-radius: 5px;
    border: none;
}
.form-div14 {
    font-family: Gilroy;
    font-weight: 400;
    font-style: Regular;
    font-size: 16px;
    leading-trim: NONE;
    line-height: 120%;
    letter-spacing: 0%;
    text-transform: capitalize;
    color: #111111;
}
a.toggle-link {
    font-family: 'Gilroy';
    font-weight: 600;
    font-style: Semibold;
    font-size: 16px;
    leading-trim: NONE;
    line-height: 120%;
    letter-spacing: 0%;
    text-transform: capitalize;
    color: #00A234;
}
p.forgot-pas {
    font-family: Gilroy;
    font-weight: 600;
    font-style: Semibold;
    font-size: 16px;
    leading-trim: NONE;
    line-height: 120%;
    letter-spacing: 0%;
    text-transform: capitalize;
    color: #111111;
    margin: 24px 0 24px 0;
}
.login-div {
    margin: 40px 0 25px 0;
}
img {
  width: 100%;
  height: 100%;
  max-width: 90px;
}
  </style>

@endsection('content')