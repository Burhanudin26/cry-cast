@extends('layouts.main')
@section('title', 'DogeCoin')
@section('content')
<link rel="stylesheet" href="{{ url('css/menu-cry.css') }}">
  <!-- content -->
  @include('layouts.tips') {{-- ini --}}
  <section class="container mt-5 pt-5 d-flex flex-column justify-content-center align-items-center" style="height: 80vh;">
    <div class="card" style="min-width: 700px;">
      <div class="card-header">
        <h1 class="text-center">Dogecoin</h1>
      </div>
      <div class="card-body p-4" style="background-color: rgba(255, 255, 255, 0);">
        <form method="POST" action="/import3" enctype="multipart/form-data">
          <!-- pilih tanggal -->
          <div class="mb-3">
            <label for="dateInput" class="form-label">Masukkan Tanggal</label>
            <input type="date" class="form-control" id="dateInput">
          </div>
          <!-- file input -->
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
                      <input type="file" name="csv_input_dogecoin" class="form-control" id="fileInput" accept=".csv,.xlsx">
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
@endsection