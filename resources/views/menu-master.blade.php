@extends('layouts.main')
@section('title', 'Menu')
@section('content')

<style>
/* overlay styles */

.flip-card {
    background-color: transparent;
    width: 250px;
    height: 250px;
    perspective: 1000px;
  }

  .flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.7s;
    transform-style: preserve-3d;
  }

  .flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
  }

  .flip-card-front, .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 50%;
    overflow: hidden;
  }

  .flip-card-front {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  

  .flip-card-back {
    background-color: white;
    transform: rotateY(180deg);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .flip-card-back .card-text {
    color: black;
    font-weight: bold;
    font-size: 1.5rem;
    margin: 0;
    text-transform: uppercase;
  }

  

  @media screen and (max-width: 1300px) {
  .flip-card {
    width: 150px;
    height: 150px;
    perspective: 500px;
  }
}
  @media screen and (max-width: 1400px) {
  .flip-card {
    width: 225px;
    height: 225px;
    perspective: 500px;
  }
}
  @media screen and (max-width: 1200px) {
  .flip-card {
    width: 200px;
    height: 200px;
    perspective: 500px;
  }
}
}
  @media screen and (max-width: 1100px) {
  .flip-card {
    width: 150px;
    height: 150px;
    perspective: 500px;
  }
}


</style>
  <!-- content -->
  <div
    class="container pt-5 d-flex flex-column vh-100 justify-content-center align-items-center pt-5 pt-md-0 p-5 p-md-0 px-md-5 "
    style="margin: 0 auto;">
    <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4 justify-content-center align-items-center gy-2 p-md-5">

      {{--Custom input --}}

      <div class="col justify-content-center align-items-center d-flex flex-column">
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front">
              <img src="/pictures/icon3/binance.png" alt="Binance" style="min-height: 150px; min-width: 150px;">
            </div>
            <div class="flip-card-back">
              <div class="back-content">
                <a href="/menu/master" style="position: relative; z-index: 1; text-decoration:none">
                <div class="card-text">CUSTOM INPUT</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Go to Menu.blade.php --}}

      <div class="col justify-content-center align-items-center d-flex flex-column">
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front">
              <img src="/pictures/icon3/bitcoin.png" alt="Bitcoin" style="min-height: 150px; min-width: 150px;">
            </div>
            <div class="flip-card-back">
              <div class="back-content">
                <a href="/menu" style="position: relative; z-index: 1; text-decoration:none">
                <div class="card-text">MENU</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>`
  </div>
  <style>
    
  </style>
@endsection
