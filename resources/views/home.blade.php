@extends('layouts.main')
@section('content')
  <style>
.btn-c {
  /* bgc gradient blue and purple */
  background: linear-gradient(45deg, #3a47d5 0%, rgb(0, 162, 255) 100%);
  color: rgb(255, 255, 255);
  border: none;
  border-radius: 10px;
  padding: 10px 20px;
  font-size: 20px;
  font-weight: 600;
  transition: all ease-in-out 0.5s;
}

.animated-gradient {
  background-size: 800% 800%;
  animation: gradient 5s ease-in-out infinite;
}

.animated-gradient:hover {
  animation-play-state: paused;
}

@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }

  50% {
    background-position: 100% 50%;
  }

  100% {
    background-position: 0% 50%;
  }
}

    .up {
      text-align: center;
    }

    .bdy {
      width: 100%;
      display: flex;
      justify-content: center;
      gap: 8rem;
      flex-wrap: wrap;
    }

    .c2 {
      width: 250px;
      height: 250px;
      background: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
      border-radius: 100%;
      display: flex;
      align-items: flex-end;
      justify-content: center;
      text-align: center;
      padding-bottom: 1rem;
      position: relative;
      transition: .3s ease;
    }

    .c2 img {
      border-radius: 100rem;
      position: absolute;
      width: 100%;
      height: 100%;
      display: block;
      object-fit: cover;
      top: 0;
      transition: .3s ease;
    }

    .c2 .content h3 {
      text-transform: uppercase;
    }

    .c2 .content p {
      text-transform: capitalize;
      letter-spacing: 2px;
    }

    .c2:hover {
      transform: translate(2rem, 2rem);
    }

    .c2:hover img {
      transform: translate(-8rem, -8rem);
    }

    .feautures {
      background-color: #f5f5f5;
      padding: 4rem 0 4rem 0;
    }
  </style>
  <section class="">
    {{-- bg --}}

    <!-- content -->
    <div data-bss-parallax-bg="true" class="mx-0"
      style="background-image: url(pictures/BGGG.png); background-size: cover; height:100vh; margin: auto 0;">
      <div class="hero min-vh-100 d-flex align-items-center">
        <div class="container">
          <div class="row flex-lg-row-reverse align-items-center">
            <div class="col-lg-6">
              <img src="pictures/coin-removebg.png" class="img-fluid rounded-lg" />
            </div>
            <div class="col-lg-6">
              <h1 class="display-2 fw-bold head-cast">Cry Cast</h1>
              <p class="lead py-4">Get accurate cryptocurrency forecasts with Cry Cast. Stay ahead of the game with
                real-time data and expert analysis. Join us now for profitable investments.</p>
              <div class="button">
                <a href="{{ route('regis') }}" style="position: relative; z-index: 1;">
                  <button class="btn btn-c aminated-gradient">Get Started</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    {{-- feautures --}}
  <section class="feautures">
    <div class="up mb-5">
      <h1>Feautures</h1>
    </div>
    <div class="bdy">
      <div class="c2">
        <img src="/pictures/icon3/tren.jpg" alt="">
        <div class="content">
          <h3>Trend Chart</h3>
          <p>make decision for investment</p>
        </div>
      </div>
      <div class="c2">
        <img src="/pictures/icon3/cry.jpg" alt="">
        <div class="content">
          <h3>Crypto Currency</h3>
          <p>digital currency in the future</p>
        </div>
      </div>
      <div class="c2">
        <img src="/pictures/icon3/cast.jpg" alt="">
        <div class="content">
          <h3>Forecast</h3>
          <p>Increase Investment Efficiency</p>
        </div>
      </div>
    </div>
    {{-- desc --}}
    <div class="desc px-5 pt-4">
      <div class="container">
        <p>Tiga fitur yang diunggulkan adalah grafik tren, mata uang kripto, dan ramalan. Fitur grafik tren membantu
          pengguna membuat keputusan investasi yang terinformasi dengan menampilkan tren historis. Fitur mata uang kripto
          berfokus pada mata uang digital dan potensi dampaknya di masa depan. Terakhir, fitur ramalan bertujuan untuk
          meningkatkan efisiensi investasi dengan memberikan prediksi pasar kepada pengguna.</p>
      </div>
    </div>
  </section>
  {{-- about --}}
  <section class="about pt-3" id="about"
    style="height: 100vh; display: flex;justify-content: center; align-items: center;">
    <div class="container py-4 py-xl-5">
      <div class="row gy-4 gy-md-0">
        <div class="col-md-6" data-aos="slide-up">
          <div class="p-xl-5 m-xl-5 p-5 m-2 ">
            <img class="img-fluid" src="{{ asset('pictures/logo/Crycast.png') }}" alt="Alvalen">
          </div>
        </div>
        <div
          class="col-md-6 text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center">
          <div style="max-width: 350px;">
            <h4 class="text-uppercase fw-bold text-dark fontn">About</h4>
            <p class="my-3 text-dark" style="text-align:justify;">
              CryCast adalah platform prediksi cryptocurrency yang akurat dengan teknik machine learning canggih seperti
              Naive Bayes dan Moving Average. Kami menggabungkan data real-time dan analisis ahli untuk membantu Anda
              membuat keputusan investasi yang menguntungkan. Dengan grafik dan tren yang terupdate, CryCast memungkinkan
              pengguna untuk memantau dan menganalisis pasar cryptocurrency secara real-time.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script src="{{ url('js/parallax.js') }}"></script>
@endsection
