@extends('layouts.main')
@section('title', 'Binance')
@section('content')

  <link rel="stylesheet" href="{{ url('css/menu-cry.css') }}">
  <!-- content -->
  @include('layouts.tips') {{-- ini --}}
  <section class="container mt-5 pt-5 d-flex flex-column justify-content-center align-items-center" style="height: 80vh;">
    <div class="card">
      <div class="card-header">
        <h1 class="text-center">Binance</h1>
      </div>
      <div class="card-body p-4" style="background-color: rgba(255, 255, 255, 0);">
        <form method="POST" action="/import1" enctype="multipart/form-data">
          @csrf
          <!-- pilih tanggal -->
      <div class="mb-3">
          <label for="dateInput" class="form-label">Masukkan Tanggal</label>
          <input type="date" class="form-control" id="dateInput" name="date" min="{{ $minDate }}" max="{{ $maxDate }}">
      </div>

          {{-- tanggal yang tersedia --}}
          <div>
            {{-- get the date boundary first and end from table binance --}}
            @php
              $first_date = DB::table('binance')->min('date');
              $last_date = DB::table('binance')->max('date');

              $first_date = date('Y-m-d', strtotime($first_date));
              $last_date = date('Y-m-d', strtotime($last_date));

              echo '<p class="text-center">Tanggal yang tersedia: ' . $first_date . ' - ' . $last_date . '</p>';
            @endphp
          </div>
          <!-- file -->
          {{-- <div class="mb-3">
            <label for="file" class="form-label">Choose file:</label> <br>
            <button type="button" class="btn btn-secondary" id="file" data-bs-toggle="modal"
              data-bs-target="#fileModal">Choose</button>
          </div> --}}
          <!-- modal for file -->
          <!-- Modal -->

          <!-- check box prediksi naik dan turun-->
          {{-- <div class="mb-3">
            <label for="checkbox">Pilih prediksi:</label> <br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
              <label class="form-check-label" for="inlineCheckbox1">Naik</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
              <label class="form-check-label" for="inlineCheckbox2">Turun</label>
            </div>
          </div> --}}
          <!-- submit button -->
          <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </form>
      </div>
    </div>
  </section>

  <script>
    // refresh page when entering the page


    // if date on change remove class disabled
    // const dateInput = document.getElementById("dateInput");
    // const submitButton = document.getElementById("submit");
    // dateInput.addEventListener("change", (event) => {
    //   submitButton.classList.remove("disabled");
    // });

  </script>
@endsection
