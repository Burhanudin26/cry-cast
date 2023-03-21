@extends('layouts.main')
@section('title', 'Register')
@section('content')
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card text-black mi" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0); backdrop-filter: blur(10px);">
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                <p class="text-black-50 mb-5">Buat akun terlebih dahulu untuk melanjutkan ke form login.</p>
                <!-- form -->
                <form action="reg-proses.php" method="POST" id="form">
                  <!-- nama -->
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="nama">
                    <label for="nama" class="text-dark">Nama</label>
                    <div class="invalid-feedback text-start">
                      Input tidak valid.
                    </div>
                  </div>
                  <!-- email -->
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="email">
                    <label for="email" class="text-dark">Email</label>
                    <div class="invalid-feedback text-start">
                      Input tidak valid.
                    </div>
                  </div>
                  <!-- password -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="pass">
                    <label for="password" class="text-black">Password</label>
                    <div class="invalid-feedback text-start">
                      Input tidak valid.
                    </div>
                    <div class="form-text text-start" id="pashelp">
                      <p style="margin: 0 auto;">*Password must contain number, uppercase, and lowercase.</p>
                      <p>*Ex: HesoYam12</p>
                    </div>
                  </div>
                  <!-- confirm password -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="rpass" placeholder="rpass">
                    <label for="rpass" class="text-black">Confirm Password</label>
                    <div class="invalid-feedback text-start">
                      Input tidak valid.
                    </div>
                  </div>
                  <!-- show password -->
                  <div class="">
                    <button type="button" class="btn spas" id="showpass">
                      Show Password
                    </button>
                  </div>
                  <!-- submit -->
                  <div class="mb-1">
                    <input type="submit" id="submit" class="btn btn-outline-dark btn-lg px-5 mt-3" name="submit" value="Register">
                  </div>
                </form>
              </div>
              <div>
                <p class="mb-0">Alredy have an Account? <a href="login" class="text-black-50 fw-bold">Sign In</a>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="{{ asset('js/regisValid.js') }}"></script>
  <script>
    //enable submit button if all validation is true
    console.log("nama: " + nama + ", email: " + email + ", password: " + password + ", rpass: " + rpass);
    $("#submit").addClass("disabled");
    $("input").keyup(function () {
      let nama = $("#nama").val();
      let email = $("#email").val();
      let password = $("#password").val();
      let rpass = $("#rpass").val();
      let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
      if (
        nama.length > 3 &&
        isNaN(nama) &&
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