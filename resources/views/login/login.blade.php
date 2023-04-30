@extends('layouts.main')
@section('title', 'Login')
@section('content')
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card text-black"
            style="border-radius: 1rem; background-color: rgba(255, 255, 255, 0); backdrop-filter: blur(10px);">
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-black-50 mb-5">Please enter your login and password!</p>
                <form action="{{ route('loginPost') }}" method="POST" id="login-form">
                  @csrf
                  {{-- error message --}}
                  @if ($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                  @elseif ($errors->has('notVerified'))
                    <div class="alert alert-danger">{{ $errors->first('notVerified') }}</div>
                  @elseif ($errors->has('expire'))
                    <div class="alert alert-danger">{{ $errors->first('expire') }}</div>
                  @endif
                  <!-- email -->
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name_or_email" name="email" placeholder="mail">
                    <label for="name_or_email" class="text-dark">Email</label>
                  </div>
                  <!-- password -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="pass">
                    <label for="password" class="text-black">Password</label>
                  </div>
                  <!-- cookies remember me checkbox -->
                  <div class="mb-2 d-flex">
                    <label for="remember" class="align-self-start">
                      <input class=" form-check-input" type="checkbox" value="" id="remember" name="remember">
                      Remember me </label>
                  </div>
                  <!-- show password -->
                  <div class="mb-5">
                    <button type="button" class="btn spas" id="showpass">
                      Show Password
                    </button>
                  </div>
                  <button id="submitLogin" class="btn btn-outline-dark btn-lg px-5 mt-5" type="submit"
                    name="submit">Login</button>
                </form>
              </div>
              <div>
                <p class="mb-1">Don't have an account? <a href="/registerPage" class="text-black-50 fw-bold">Sign
                    Up</a>
                <p class="mb-0" style="opacity: 50%;">Forgot your password? <a href="forgotpass"
                    class="text-black-50 fw-bold text-secondary">Change password</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/loginvalid.js') }}"></script>

  {{-- enable submit button if all validation is true --}}
  <script>
    console.log("name: " + name + ", email: " + email + ", password: " + password + ", rpass: " + rpass);
    $("#submit").addClass("disabled");
    $("input").keyup(function() {
      let email = $("#name_or_email").val();
      let password = $("#password").val();
      let rpass = $("#rpass").val();
      let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
      if (
        name.length > 3 &&
        isNaN(name) &&
        (email.length > 6 &&
          email.includes("@") &&
          email.includes(".")) &&
        password.length > 6 &&
        regex.test(password) &&
        rpass == password
      ) {
        $("#submit").removeClass("disabled");
      } else {
        $("#submit").addClass("disabled");
      }
    });
  </script>
@endsection
