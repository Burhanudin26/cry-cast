@extends('layouts.main')
@section('title', 'About')
@section('content')
  <style>
    .head {
      font-family: 'Righteous', cursive;
      font-size: 3rem;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #333;
      text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
      border-bottom: 1px solid #ddd;
      margin-bottom: 1rem;
      padding-bottom: 0.5rem;
    }
.desc {
    font-size: 20px;
    font-weight: 300;
    line-height: 1.5;
    color: #000000;
    margin-bottom: 1.5rem;
    text-align: justify;
}
.card {
    background-color: rgba(255, 255, 255, 0);
    border-radius: 1rem;
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);}
  </style>
  <section class="container-fluid justify-content-center align-items-center vh-100 d-flex flex-column" style="background-image: url(pictures/bg.png); background-size: cover; height:100vh; margin: auto 0;">
    <div class="container px-0 px-md-5">
      <div class="row">
        <div class="col">
          <h1 class="display-2 fw-bold head">Cry Cast</h1>
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
  <section class="vh-100 d-flex flex-column justify-content-center align-items-center">
    <div class="container">
      <div class="row">
        <div class="col">
          <h2 class="head text-center">Our Team</h2>
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
@endsection