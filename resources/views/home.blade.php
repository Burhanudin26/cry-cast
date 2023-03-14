@extends('layouts.main')
@section('content')

<section class="pt-5 pt-md-0">
        <!-- content -->
        <div class="hero min-vh-100 d-flex align-items-center">
          <div class="container">
            <div class="row flex-lg-row-reverse align-items-center">
              <div class="col-lg-6">
                <img src="pictures/coin-removebg.png" class="img-fluid rounded-lg" />
              </div>
              <div class="col-lg-6">
                <h1 class="display-2 fw-bold head-cast">Cry Cast</h1>
                <p class="lead py-4">Get accurate cryptocurrency forecasts with Cry Cast. Stay ahead of the game with real-time data and expert analysis. Join us now for profitable investments.</p>
                <div class="button">
                  <a href="/login" style="position: relative; z-index: 1;">
                    <button class="btn btn-lg btn-primary">Get Started</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
</section>

<section class="container-fluid justify-content-center align-items-center vh-100 d-flex flex-column">
  <div class="container px-0 px-md-5">
    <div class="row">
      <div class="col">
        <h1 class="display-2 fw-bold head-team">Cry Cast</h1>
      </div>
    </div>
    <div class="row">
      <div class="card">
        <div class="desc p-4">
          Cry Cast adalah platform prediksi cryptocurrency yang akurat dengan teknik machine learning canggih seperti
          Naive Bayes. Kami menggabungkan data real-time dan analisis ahli untuk membantu Anda selangkah lebih maju dan
          membuat investasi yang menguntungkan. Dengan memanfaatkan kekuatan Naive Bayes, kami mampu mengklasifikasikan
          dan memprediksi tren pasar dengan tingkat akurasi yang tinggi, sehingga memungkinkan pengguna kami membuat
          keputusan yang terinformasi. Bergabunglah dengan kami sekarang untuk melihat bagaimana teknologi terbaru kami
          dapat membantu Anda berhasil di pasar cryptocurrency.
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Page About --}}
<section class="vh-100 d-flex flex-column justify-content-center align-items-center margin-team">
  <div class="container">
    <div class="row ">
      <div class="col">
        <h2 class="head-team text-center">Our Team</h2>
      </div>
    </div>
    <div class="row">
      {{-- p1 --}}
      <div class="col-6 col-md-3">
        <div>
          <img src="pictures/11.jpg" class="img-fluid rounded-circle shadow" alt="">
          <h3 class="text-center"> nama </h3>
        </div>
      </div>
      {{-- p2 --}}
      <div class="col-6 col-md-3">
        <div>
          <img src="pictures/11.jpg" class="img-fluid rounded-circle shadow" alt="">
          <h3 class="text-center"> nama </h3>
        </div>
      </div>
      {{-- p3 --}}
      <div class="col-6 col-md-3">
        <div>
          <img src="pictures/11.jpg" class="img-fluid rounded-circle shadow" alt="">
          <h3 class="text-center"> nama </h3>
        </div>
      </div>
      {{-- p4 --}}
      <div class="col-6 col-md-3">
        <div>
          <img src="pictures/11.jpg" class="img-fluid rounded-circle shadow" alt="">
          <h3 class="text-center"> nama </h3>
        </div>
      </div>
    </div>
  </div>
</section>

  {{-- about --}} 
  <section class="about pt-3" id="about"
    style="height: 100vh; display: flex;justify-content: center; align-items: center;" >
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
  <script src="{{ url('js/script.min.js') }}"></script>
  @endsection