@extends('layouts.main')
@section('title', 'Menu')
@section('content')

<style>
  /* overlay styles */
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.7);
  color: #fff;
  opacity: 0;
  transition: opacity 0.5s;
}

/* hover styles */
.col:hover .overlay {
  opacity: 1;
}

</style>
  <!-- content -->
  <div
    class="container pt-5 d-flex flex-column vh-100 justify-content-center align-items-center pt-5 pt-md-0 p-5 p-md-0 px-md-5 "
    style="margin: 0 auto;">
    <div class="row row-cols-2 row-cols-md-4 justify-content-center align-items-center gy-2 p-md-5">

      {{-- binance --}}
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/binance" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/binance.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px; ">
              <div class="overlay rounded-circle">BINANCE</div>
          </div>
        </a>
      </div>

      {{-- Bitcoin --}}
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/bitcoin" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/bitcoin.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
            <div class="overlay rounded-circle">BITCOIN</div>
          </div>
        </a>
      </div>
      

      {{-- Dogecoin --}}
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/dogecoin" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/dogecoin.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
              <div class="overlay rounded-circle">DOGECOIN</div>
          </div>
        </a>
      </div>

      {{-- Ethreum --}}
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/eth" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/ethereum.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
              <div class="overlay rounded-circle">ETHEREUM</div>
          </div>
        </a>
      </div>

      {{-- Iota --}}
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/iota" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/iota.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
              <div class="overlay rounded-circle">IOTA</div>
          </div>
        </a>
      </div>

      {{-- Solana --}}
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/solana" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/solana.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
              <div class="overlay rounded-circle">SOLANA</div>
          </div>
        </a>
      </div>

      {{-- Stellar --}}
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/stellar" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/stellar.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
              <div class="overlay rounded-circle">STELLAR</div>
          </div>
        </a>
      </div>

      {{-- Tron --}}
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/tron" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon3/tron.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none; min-height: 150px; min-width: 150px;">
              <div class="overlay rounded-circle">TRON</div>
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
