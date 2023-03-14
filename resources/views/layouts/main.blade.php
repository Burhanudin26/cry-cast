<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- icon --}}
  <link rel="icon" href="{{ url('pictures/logo/crycast.png') }}">
  {{-- title --}}
  <title>@yield('title', 'Cry Cast')</title>
  {{-- css --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <link rel="stylesheet" href="{{ url('css/menu.css') }}">
  <link rel="stylesheet" href="{{ url('css/transition.css') }}">
  {{-- font --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
  <style>
    body::-webkit-scrollbar {
    width: 0.2em;
}

    body::-webkit-scrollbar-track {
      background: #242424;
        -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.3);
    }

    body::-webkit-scrollbar-thumb {
      background-color: rgb(112, 190, 180);
      outline: 1px solid rgb(0, 89, 255);
    }

    /* aneh ini ku taro di css ga aktif */
  </style>

</head>
<body>
  <div id="loader"></div>
  <section id="swup">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">CryCast</a>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/">Homepage</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/menu">Forecast</a>
            </li>
          </ul>
        </div>
        <div>
            <button class="btn btn-outline-primary" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <circle cx="5" cy="12" r="1" />
                <circle cx="12" cy="12" r="1" />
                <circle cx="19" cy="12" r="1" />
              </svg>
              <span class="badge bg-primary rounded-pill">3</span>
            </button>
          </div>
      </div>
    </nav>

    <!-- home -->
    @if(Request::is('/'))
    <div class="">
      @else
    <div class="transition-fade">
    @endif
      <div class="container-fluaid">
        <!-- bg -->
        {{-- background melayang cuma di homepage --}}
        @if (Request::is('/')) 
        <ul class="background">
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
        @endif
        @yield('content')
      </div>
    </div>
  </section>

  {{-- footer --}}
  <section class="bottom">
  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #2872b8;">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: CTA -->
        <p class="d-flex justify-content-center align-items-center">
          <span class="me-3">Register for free</span>
          <a href="/register" style="position: relative; z-index: 1;">
          <button type="button" class="btn btn-outline-light btn-rounded">
            Sign up!
          </button>
          </a>
        </p>
      <!-- Section: CTA -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © {{ date('Y') }} Copyright:
      <a class="text-white" href="/"">CryCast</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</section>
<!-- End of .container -->
  {{-- js --}}
  <script src="{{ asset('js/Jquery.js') }}"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        {{-- main js --}}
    <script src="{{ url('js/main.js') }}"></script>
</body>

</html>
