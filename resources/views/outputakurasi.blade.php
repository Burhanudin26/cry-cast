 @extends('layouts.main')
 @section('title', 'Akurasi Prediksi')
 @section('styles')
    @parent
    <style>
       * {
          margin: 0;
          /* padding-top: 50px; */
          padding: 0;

          box-sizing: border-box;
          font-family: sans-serif;
       }

       body {
          min-height: 100vh;
          background: url(imagesAkurasi/crypto3crycast.jpg) center / cover;
          display: flex;
          justify-content: center;
          align-items: center;
       }



       .table {
          width: 82vw;
          height: 90vh;
          background-color: #fff5;

          backdrop-filter: blur(7px);
          box-shadow: 0 .4rem .8rem #0005;
          border-radius: .8rem;

          overflow: hidden;
       }

       .table__header {
          width: 100%;
          height: 10%;
          background-color: #fff4;
          padding: .8rem 1rem;

          display: flex;
          justify-content: space-between;
          align-items: center;
       }

       .table__header .input-group {
          width: 35%;
          height: 100%;
          background-color: #fff5;
          padding: 0 .8rem;
          border-radius: 2rem;

          display: flex;
          justify-content: center;
          align-items: center;

          transition: .2s;
       }

       .table__header .input-group:hover {
          width: 45%;
          background-color: #fff8;
          box-shadow: 0 .1rem .4rem #0002;
       }

       .table__header .input-group img {
          width: 1.2rem;
          height: 1.2rem;
       }

       .table__header .input-group input {
          width: 100%;
          padding: 0 .5rem 0 .3rem;
          background-color: transparent;
          border: none;
          outline: none;
       }

       .table__body {
          width: 95%;
          max-height: calc(89% - 1.6rem);
          background-color: #fffb;

          margin: .8rem auto;
          border-radius: .6rem;

          overflow: auto;
          overflow: overlay;
       }

       .table__body::-webkit-scrollbar {
          width: 0.5rem;
          height: 0.5rem;
       }

       .table__body::-webkit-scrollbar-thumb {
          border-radius: .5rem;
          background-color: #0004;
          visibility: hidden;
       }

       .table__body:hover::-webkit-scrollbar-thumb {
          visibility: visible;
       }

       table {
          width: 100%;
       }

       td img {
          width: 36px;
          height: 36px;
          margin-right: .5rem;
          border-radius: 50%;

          vertical-align: middle;
       }

       table,
       th,
       td {
          border-collapse: collapse;
          padding: 1rem;
          text-align: left;
       }

       thead th {
          position: sticky;
          top: 0;
          left: 0;
          background-color: #d5d1defe;
          cursor: pointer;
          text-transform: capitalize;
       }

       tbody tr:nth-child(even) {
          background-color: #0000000b;
       }

       tbody tr {
          --delay: .1s;
          transition: .5s ease-in-out var(--delay), background-color 0s;
       }

       tbody tr.hide {
          opacity: 0;
          transform: translateX(100%);
       }

       tbody tr:hover {
          background-color: #fff6 !important;
       }

       tbody tr td,
       tbody tr td p,
       tbody tr td img {
          transition: .2s ease-in-out;
       }

       tbody tr.hide td,
       tbody tr.hide td p {
          padding: 0;
          font: 0 / 0 sans-serif;
          transition: .2s ease-in-out .5s;
       }

       tbody tr.hide td img {
          width: 0;
          height: 0;
          transition: .2s ease-in-out .5s;
       }

       .status {
          padding: .4rem 0;
          border-radius: 2rem;
          text-align: center;
       }

       .status.recommeded {
          background-color: #86e49d;
          color: #006b21;
       }

       .status.not-recommended {
          background-color: #d893a3;
          color: #b30021;
       }

       .status.pending {
          background-color: #ebc474;
       }

       .status.better-keep {
          background-color: #6fcaea;
       }

       .status.strongly-recommeded {
          background-color: #d0ff00;
       }


       @media (max-width: 1000px) {
          td:not(:first-of-type) {
             min-width: 12.1rem;
          }
       }

       thead th span.icon-arrow {
          display: inline-block;
          width: 1.3rem;
          height: 1.3rem;
          border-radius: 50%;
          border: 1.4px solid transparent;

          text-align: center;
          font-size: 1rem;

          margin-left: .5rem;
          transition: .2s ease-in-out;
       }

       thead th:hover span.icon-arrow {
          border: 1.4px solid #6c00bd;
       }

       thead th:hover {
          color: #6c00bd;
       }

       thead th.active span.icon-arrow {
          background-color: #6c00bd;
          color: #fff;
       }

       thead th.asc span.icon-arrow {
          transform: rotate(180deg);
       }

       thead th.active,
       tbody td.active {
          color: #6c00bd;
       }

       .export__file {
          position: relative;
       }

       .export__file .export__file-btn {
          display: inline-block;
          width: 2rem;
          height: 2rem;
          background: #fff6 url(images/export.png) center / 80% no-repeat;
          border-radius: 50%;
          transition: .2s ease-in-out;
       }

       .export__file .export__file-btn:hover {
          background-color: #fff;
          transform: scale(1.15);
          cursor: pointer;
       }

       .export__file input {
          display: none;
       }

       .export__file .export__file-options {
          position: absolute;
          right: 0;

          width: 12rem;
          border-radius: .5rem;
          overflow: hidden;
          text-align: center;

          opacity: 0;
          transform: scale(.8);
          transform-origin: top right;

          box-shadow: 0 .2rem .5rem #0004;

          transition: .2s;
       }

       .export__file input:checked+.export__file-options {
          opacity: 1;
          transform: scale(1);
          z-index: 100;
       }

       .export__file .export__file-options label {
          display: block;
          width: 100%;
          padding: .6rem 0;
          background-color: #f2f2f2;

          display: flex;
          justify-content: space-around;
          align-items: center;

          transition: .2s ease-in-out;
       }

       .export__file .export__file-options label:first-of-type {
          padding: 1rem 0;
          background-color: #86e49d !important;
       }

       .export__file .export__file-options label:hover {
          transform: scale(1.05);
          background-color: #fff;
          cursor: pointer;
       }

       .export__file .export__file-options img {
          width: 2rem;
          height: auto;
       }

       .tombol-terbang {
          position: fixed;
          bottom: 50px;
          right: 20px;
          width: 50px;
          height: 50px;
          border-radius: 50%;
          background-color: #474747;
          color: #fff;
          font-size: 20px;
          text-align: center;
          line-height: 50px;
          box-shadow: 0 0 6px rgba(0, 0, 0, 0.329);
          transition: all 0.3s ease;
       }
    </style>
 @endsection
 @section('content')
    <div id="outer">
       <div id="inner">
          <div class="table">
             <section class="table__header">
                <h1>Coins Accuracy</h1>
                <div class="input-group">
                   <input class="mt-3" type="search" placeholder="Search Data...">
                   <img src="imagesAkurasi/search.png" alt="">
                </div>
                <div class="tombol">
                   <a href="{{ url('/menu') }}" class="" role="button" type="button">
                      <i class="fa-solid fa-reply"></i></a>
                </div>
             </section>
             <section class="table__body">
                <table>
                   <thead>
                      <tr>
                         {{-- <th> Id <span class="icon-arrow">&UpArrow;</span></th> --}}
                         <th> Parameter <span class="icon-arrow">&UpArrow;</span></th>
                         <th> Tujuan <span class="icon-arrow">&UpArrow;</span></th>
                         {{-- <th> Order Date <span class="icon-arrow">&UpArrow;</span></th> --}}
                         <th> Rekomendasi <span class="icon-arrow">&UpArrow;</span></th>
                         <th> Kinerja <span class="icon-arrow">&UpArrow;</span></th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr>
                         {{-- <td> 1 </td> --}}
                         <td class="fw-bold">Accuracy</td>
                         <td class="fw-bold"> Seberapa akurat model dalam memprediksi keseluruhan data </td>
                         {{-- <td> 17 Dec, 2022 </td> --}}
                         <td class="fw-bold">
                            <p class="status recommeded">Strongly Recommeded</p>
                         </td>
                         <td> {{ $akurasi }}% </td>
                      </tr>
                      <tr>
                         {{-- <td> 2 </td> --}}
                         <td class="fw-bold">Recall </td>
                         <td class="fw-bold"> Kemampuan model untuk menemukan semua contoh positif (True Positive Rate).
                         </td>
                         {{-- <td> 27 Aug, 2023 </td> --}}
                         <td class="fw-bold">
                            <p class="status not-recommended">Not Recommended</p>
                         </td>
                         <td> {{ $recall }}% </td>
                      </tr>
                      <tr>
                         {{-- <td> 3</td> --}}
                         <td class="fw-bold">Precision </td>
                         <td class="fw-bold"> Kemampuan model untuk memprediksi dengan benar contoh positif (Positive
                            Predictive Value). </td>
                         {{-- <td> 14 Mar, 2023 </td> --}}
                         <td class="fw-bold">
                            <p class="status better-keep">Better Keep Your Coins</p>
                         </td>
                         <td>{{ $precision }}% </td>
                      </tr>
                      <tr>
                         {{-- <td> 4</td> --}}
                         <td class="fw-bold">F1 Score </td>
                         <td class="fw-bold"> Ukuran yang menggabungkan precision dan recall untuk memberikan skor
                            keseluruhan kinerja model. </td>
                         {{-- <td> 25 May, 2023 </td> --}}
                         <td class="fw-bold">
                            <p class="status strongly-recommeded">Strongly Recommeded</p>
                         </td>
                         <td> {{ $f1Score }}% </td>
                      </tr>
                   </tbody>
                </table>
             </section>
          </div>
       </div>
    </div>

    <script>
       // 3. Compare percentage of model with advice
       // Get all the rows in the table body:
       let tableRows = document.querySelectorAll("tbody tr");
       // Get all the <td> elements that contain the accuracy percentage value:
       let accuracyTds = document.querySelectorAll("tbody tr td:nth-child(4)");
       console.log(accuracyTds);
       tableRows.forEach(row => {

          // Parse Percentage
          //   let akurasiPercentage = parseFloat(td.textContent);
          //   console.log("enter looping");
          //   console.log("akurasiPercentage");
          //   console.log(akurasiPercentage);
          //   let recallPercentage = parseFloat(td.textContent);
          //   console.log("recallPercentage");
          //   console.log(recallPercentage);
          //   let precisionPercentage = parseFloat(td.textContent);
          //   console.log("precisionPercentage");
          //   console.log(precisionPercentage);
          //   let f1Percentage = parseFloat(td.textContent);
          //   console.log("f1Percentage");
          //   console.log(f1Percentage);

          // Get the <td> element that contains the accuracy percentage value:
          let accuracyTd = row.querySelector("td:nth-child(4)");
          // Parse the percentage values:
          let akurasiPercentage = parseFloat(accuracyTd.textContent);
          console.log("akurasiPercentage");
          console.log(akurasiPercentage);

          // Determine the recommendation based on the accuracy percentage:
          let recommendation;
          if (akurasiPercentage >= 60) {
             recommendation = "Strongly Recommended";
          } else if (akurasiPercentage >= 50) {
             recommendation = "Recommended";
          } else {
             recommendation = "Better Keep Your Coins";
          }

          // Identifikasi dan bandingkan ini dengan kode dibawah :
          // let textStatus = document.querySelectorAll("tbody tr td:nth-child(3)");
        //   let recommendationEl = document.querySelectorAll("td:nth-child(3) p.status");
        //   console.log(recommendationEl);

        //   // Update the text content of the <p> element with the recommendation:
        //   recommendationEl.forEach((recommendationEl) => {
        //      recommendationEl.textContent = recommendation;
        //   });

		// Kode yg baru :
          // Get the <p> element with class "status" from the table:
          // let textStatus = document.querySelectorAll("tbody tr td:nth-child(3)");
          let recommendationEl = row.querySelector("td:nth-child(3) p.status");
          console.log(recommendationEl);

          // Update the text content of the <p> element with the recommendation:
          recommendationEl.textContent = recommendation;

       });
    </script>
 @endsection
