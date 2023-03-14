@extends('layouts.main')
@section('content')
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card text-black" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0); backdrop-filter: blur(10px);">
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-black-50 mb-5">Please enter your login and password!</p>
                <form action="log-proses.php" method="POST" id="login-form">
                  <!-- email -->
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="email" name="email" placeholder="mail">
                    <label for="email" class="text-dark">Email</label>
                  </div>
                  <!-- password -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="pass">
                    <label for="password" class="text-black">Password</label>
                    <div class="invalid-feedback">
                      Username atau password salah.
                    </div>
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
                  <div class="alert alert-danger mt-3" role="alert" id="error-message" style="display:none;">
                    Incorrect email or password.
                  </div>
                  <button class="btn btn-outline-dark btn-lg px-5 mt-5" type="submit" name="submit">Login</button>
                </form>
              </div>
              <div>
                <p class="mb-1">Don't have an account? <a href="register" class="text-black-50 fw-bold">Sign Up</a>
                <p class="mb-0" style="opacity: 50%;">Forgot your password? <a href="forgotpass" class="text-black-50 fw-bold text-secondary">Change password</a>
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
  <script>
    // show password
    $(document).ready(function() {
      $("#showpass").click(function() {
        console.log("clicked");
        if ($("#password").attr("type") === "password") {
          $("#password").attr("type", "text");
          $("#showpass").text("Hide Password");
        } else {
          $("#password").attr("type", "password");
          $("#showpass").text("Show Password");
        }
      });
    });
  </script>
@endsection