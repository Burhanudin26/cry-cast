@extends('layouts.main')
@section('title', 'Menu')
@section('content')
  <!-- content -->
  <div
    class="container pt-5 d-flex flex-column vh-100 justify-content-center align-items-center pt-5 pt-md-0 p-5 p-md-0 px-md-5 "
    style="margin: 0 auto;">
    <div class="row row-cols-2 row-cols-md-4 justify-content-center align-items-center gy-2 p-md-5">
      {{-- bitcoin --}}
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/binance" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/binance.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px; ">
          </div>
        </a>
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/bitcoin" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/bitcoin.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
          </div>
        </a>
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/dogecoin" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/dogecoin.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
          </div>
        </a>
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/eth" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">

            <img src="/pictures/icon3/ethereum.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
          </div>
        </a>
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/iota" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">

            <img src="/pictures/icon3/iota.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
          </div>
        </a>
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/solana" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">

            <img src="/pictures/icon3/solana.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
          </div>
        </a>
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/stellar" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">

            <img src="/pictures/icon3/stellar.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
          </div>
        </a>
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/tron" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">

            <img src="/pictures/icon3/tron.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
          </div>
        </a>
      </div>
    </div>`
  </div>
  <style>
    /* make a media query when md or more vh 100 when less display block */
    @media (min-width: 768px) {
      .vhis-md-100 {
        min-height: 100vh;
        min-
      }
    }
  </style>
@endsection
