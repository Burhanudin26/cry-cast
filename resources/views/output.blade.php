@extends('layouts.main')
@section('title', 'Hasil')
@section('content')
  <style>
    .tombol-terbang {
      position: fixed;
      bottom: 50px;
      right: 20px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #2872b8;
      color: #fff;
      font-size: 20px;
      text-align: center;
      line-height: 50px;
      box-shadow: 0 0 6px rgba(0, 0, 0, 0.329);
      transition: all 0.3s ease;
    }

    /* add height to the canvas */
    .chart canvas {
      width: 800px;
    }

    .card {
      /* transparent white bg and shadow */
      background-color: rgba(255, 255, 255, 0.2);
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.329);
      /* also blur */
      backdrop-filter: blur(10px);
    }
  </style>
  <section class="container d-flex flex-column justify-content-center align-items-center mt-0 mt-md-5">
    <div class="chart">
      <canvas id="data"></canvas>
      <canvas id="data2" class="d-none"></canvas>
      <canvas id="data3" class="d-none"></canvas>
    </div>

    <div class="main">
      <div class="upperBtn mt-4 mb-4">
        <!-- Show latest 30 data button -->
        <button onclick="location.href='{{ route('output', ['showAll' => 0]) }}'">Show latest 30 data</button>

        <!-- Show all data button -->
        <button onclick="location.href='{{ route('output', ['showAll' => 1]) }}'">Show all data</button>

        {{-- show all table button --}}
        <button onclick='showAllt()'>Show all table</button>
      </div>
      {{-- output bayes pada tanggal --}}
      <div class="row">
        <div class="col">
          <div class="output text-center mt-5 mb-5">
            <h3>Trend</h3>
            <p>Trend pada tanggal {{ $date[0]->date }}</p> <br>
            <div class="card px-4">
              <p class="pt-3">Cenderung Naik</p>
            </div>
          </div>

        </div>
        <div class="col">
          <div class="output text-center mt-5 mb-5">
            <h3>Hasil prediksi</h3>
            <p>Hasil prediksi pada tanggal {{ $date[0]->date }}</p>
            <div class="card px-4">
              <p class="pt-3">99% Naik</p>
              <p>1% Turun</p>
            </div>
          </div>
        </div>
      </div>

      {{-- back button float --}}
      <div class="tombol">
        <a href="{{ url('/menu') }}" class="tombol-terbang" role="button" type="button">
          <i class="fa-solid fa-reply"></i></a>
      </div>
      {{-- back button biasa --}}
      <div class="tombol2 mt-3 mb-3 text-center">
        <a href="{{ url('/menu') }}" class="btn btn-primary" role="button" type="button"> Kembali</a>
      </div>

    </div>

  </section>
  {{-- Chart.js --}}
  <script src="{{ url('js/chart.js/dist/chart.umd.js') }}"></script>
  <script>
    // chart 1
    const ctx = document.getElementById('data');
    // value
    const data = {!! json_encode($data) !!};
    const highValues = data.map(datum => datum.high);
    // trend
    // const trend = ;
    // const trendValues = trend.map(trend => trend.trend);
    //! ganti ini aktifkan trendnya
    // date
    const ids = {!! json_encode($date) !!};
    const idv = ids.map(id => {
      const date = new Date(id.date);
      return `${date.getFullYear()}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getDate().toString().padStart(2, '0')}`;
    });


    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: idv,
        datasets: [{
            label: 'high',
            data: highValues,
            borderWidth: 1,
            pointRadius: {{ $showAll ? 0 : 3 }},
          },
          {
            label: 'Trend',
            data: highValues, // ganti ini jadi trendnya
            borderWidth: 1,
            pointRadius: {{ $showAll ? 0 : 3 }},
          },
        ]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          title: {
            display: true,
            text: 'High values'
          },
          tooltip: {
            mode: 'index',
            intersect: false,
            callbacks: {
              label: function(context) {
                const label = context.dataset.label || '';
                if (label) {
                  return `${label}: ${context.formattedValue}`;
                }
                return `${context.formattedValue}`;
              }
            }
          }
        }
      }
    });

    // chart 2
    const ctx2 = document.getElementById('data2');
    // value
    const data2 = {!! json_encode($data) !!};
    const highValues2 = data2.map(datum => datum.high);
    // date
    const ids2 = {!! json_encode($date) !!};
    const idv2 = ids2.map(id2 => {
      const date2 = new Date(id2.date);
      return `${date2.getFullYear()}/${(date2.getMonth() + 1).toString().padStart(2, '0')}/${date2.getDate().toString().padStart(2, '0')}`;
    });

    const chart2 = new Chart(ctx2, {
      type: 'line',
      data: {
        labels: idv2,
        datasets: [{
          label: 'high',
          data: highValues2,
          borderWidth: 1,
          pointRadius: {{ $showAll ? 0 : 3 }},
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          title: {
            display: true,
            text: 'Low values'
          },
          tooltip: {
            mode: 'index',
            intersect: false,
            callbacks: {
              label: function(context) {
                const label = context.dataset.label || '';
                if (label) {
                  return `${label}: ${context.formattedValue}`;
                }
                return `${context.formattedValue}`;
              }
            }
          }
        }
      }
    });

    // chart 3
    const ctx3 = document.getElementById('data3');
    const data3 = {!! json_encode($data) !!};
    const highValues3 = data3.map(datum => datum.high);
    const ids3 = {!! json_encode($date) !!};
    const idv3 = ids3.map(id3 => {
      const date3 = new Date(id3.date);
      return `${date3.getFullYear()}/${(date3.getMonth() + 1).toString().padStart(2, '0')}/${date3.getDate().toString().padStart(2, '0')}`;
    });

    const chart3 = new Chart(ctx3, {
      type: 'line',
      data: {
        labels: idv3,
        datasets: [{
          label: 'high',
          data: highValues3,
          borderWidth: 1,
          pointRadius: {{ $showAll ? 0 : 3 }},
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          title: {
            display: true,
            text: 'Volume values'
          },
          tooltip: {
            mode: 'index',
            intersect: false,
            callbacks: {
              label: function(context) {
                const label = context.dataset.label || '';
                if (label) {
                  return `${label}: ${context.formattedValue}`;
                }
                return `${context.formattedValue}`;
              }
            }
          }
        }
      }
    });
    // Add listener to show tooltip on hover
    ctx.on('mousemove', function(event) {
      const activePoint = chart.getElementsAtEventForMode(event, 'nearest', {
        intersect: true
      }, true)[0];
      if (activePoint) {
        const tooltip = chart.tooltip;
        tooltip.setActiveElements([activePoint]);
        tooltip.move();
        chart.draw();
      } else {
        chart.tooltip.setActiveElements([]);
        chart.tooltip.move();
        chart.draw();
      }
    });


    // show all table
    function showAllt() {
      var y = document.getElementById("data2");
      var z = document.getElementById("data3");
      if (y.className === "d-none") {
        y.className = "d-block";
        z.className = "d-block";
      } else {
        y.className = "d-none";
        z.className = "d-none";
      }
    }
  </script>
@endsection
