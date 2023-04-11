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
          <!-- pilih tanggal -->
          <div class="mb-3">
            <label for="dateInput" class="form-label">Masukkan Tanggal</label>
            <input type="date" class="form-control" id="dateInput" name="date">
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
          <div class="mb-3">
            <label for="file" class="form-label">Choose file:</label> <br>
            <button type="button" class="btn btn-secondary" id="file" data-bs-toggle="modal"
              data-bs-target="#fileModal">Choose</button>
          </div>
          <!-- modal for file -->
          <!-- Modal -->
          <div class="modal fade " id="fileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="fileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="fileModalLabel">Choose a file</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- body -->
                  <div class="mb-3">
                    @csrf
                    <label for="fileInput" class="form-label">Select a file:</label>
                    <input type="file" name="csv_input_binance" class="form-control" id="fileInput" accept=".csv,.xlsx"
                      draggable="true"> {{-- add dragable true --}}
                  </div>
                  <hr>
                  <!-- checkbox used data yang ada -->
                  {{-- <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Use data from our database
                    </label>
                  </div> --}}
                  <div class="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </section>
  {{-- jq --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  {{-- swup --}}
  <script src="/js/swup_trans.js"></script> {{-- ini --}}

  <script>
    // ini buat drag and drop
    const fileInput = document.getElementById("fileInput");

    fileInput.addEventListener("dragstart", (event) => {
      event.dataTransfer.setData("text/plain", fileInput.id);
    });

    fileInput.addEventListener("dragover", (event) => {
      event.preventDefault();
    });

    fileInput.addEventListener("drop", (event) => {
      event.preventDefault();
      const id = event.dataTransfer.getData("text");
      const draggedElement = document.getElementById(id);
      if (draggedElement === fileInput) {
        const files = event.dataTransfer.files;
      }
    });
  </script>
@endsection
