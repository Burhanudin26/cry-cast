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
    background-color: rgba(255, 255, 255, 0.575);
    border-radius: 1rem;
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.up {
   text-align: center;
}

.bdy {
    min-height: 100vh;
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 8rem;
    flex-wrap: wrap;
}

.container2{
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


.container2 img{
  border-radius: 100rem;
  position: absolute;
  width: 100%;
  height: 100%;
  display: block;
  object-fit: cover;
  top: 0;
  transition: .3s ease;
}

.container2 .content h3{
  text-transform: uppercase;
}

.container2 .content p{
  text-transform: capitalize;
  letter-spacing: 2px;
}

.container2:hover{
  transform: translate(2rem,2rem);
}

.container2:hover img{
  transform: translate(-8rem,-8rem);
}





  </style>
  <section class="container-fluid justify-content-center align-items-center vh-100 d-flex flex-column">
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


  <section>

    <div class="up">
      <h1>Cryyy</h1>
    </div>

  <div class="bdy">

    <div class="container2">
      <img src="/pictures/icon3/trenlogo.jpg" alt="">
      <div class="content">
        <h3>Grafik tren</h3>
        <p>Determine Support and Resistance Levels</p>
      </div>
    </div>

    <div class="container2">
      <img src="/pictures/icon3/rtrnlogo.jpg" alt="">
      <div class="content">
        <h3>Forecast</h3>
        <p>Increase Investment Efficiency</p>
      </div>
    </div>
    
    <div class="container2">
      <img src="/pictures/icon3/trenlogo.jpg" alt="">
      <div class="content">
        <h3>Grafik tren</h3>
        <p>Determine Support and Resistance Levels</p>
      </div>
    </div>

    <div class="container2">
      <img src="/pictures/icon3/rtrnlogo.jpg" alt="">
      <div class="content">
        <h3>Forecast</h3>
        <p>Increase Investment Efficiency</p>
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
