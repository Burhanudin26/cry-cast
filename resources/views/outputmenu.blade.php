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
        <!-- Show latest 30 data  -->
        <label for="data-points">Display</label>
        <select id="data-points">
          <option value="30">30 data points</option>
          <option value="90">90 data points</option>
          <option value="all">all data points</option>
        </select>
        {{-- show all table button --}}
        <button onclick='showAllt()'>Show all table</button>
      </div>
      {{-- output pada tanggal --}}
      <div class="row">
        <div class="col">
          {{-- sma --}}
          <div class="output text-center mt-5 mb-5">
            <h3>Trend</h3>
            <p>Trend pada tanggal
            {{-- select datei --}}
            {{ $datei }}
            </p> <br>
            <div class="card px-4">
              <p class="pt-3">Trend cenderung {{ $output }}</p>
            </div>
          </div>
        </div>
        <div class="col">
          {{-- bayes --}}
          <div class="output text-center mt-5 mb-5">
            <h3>Hasil prediksi</h3>
            <p>Hasil prediksi pada tanggal {{ $datei }}</p>
            <div class="card px-4">
              <p class="pt-3">{{ $outputb }} %</p>
              <p> Akurasi: {{ $akurasi }} %</p>
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
    {{-- swup js  --}}
    
  </section>
  {{-- Chart.js --}}
  <script src="{{ url('js/chart.js/dist/chart.umd.js') }}"></script>
  <script>
    const ctx = document.getElementById('data');
    const data = {!! json_encode($data) !!};
    const highValues = data.map(datum => datum.high);

    // trend
    const trend = {!! json_encode($trend) !!}
    const trendValues = trend.map(trend => trend ? trend.sma_high : null);
    //! ganti ini aktifkan trendnya
    // date

    const ids = {!! json_encode($date) !!};
    const idv = ids.map(id => {
      const date = new Date(id.date);
      return `${date.getFullYear()}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getDate().toString().padStart(2, '0')}`;
    });
    let pointRadius;
    let numDataPoints = 30; // default number of data points to display
    const dataPointsDropdown = document.getElementById('data-points');
    dataPointsDropdown.addEventListener('change', function() {
      const selectedOption = dataPointsDropdown.value;
      if (selectedOption === 'all') {
        numDataPoints = highValues.length; // display all data points

      } else {
        numDataPoints = parseInt(selectedOption);
      }
      chart.data.labels = idv.slice(-
        numDataPoints); // update chart labels to display the latest number of data points
      chart.data.datasets[0].data = highValues.slice(-
        numDataPoints); // update chart data to display the latest number of data points for high values
      chart.data.datasets[1].data = trendValues.slice(-
        numDataPoints); // update chart data to display the latest number of data points for trend values

      if (numDataPoints > 100) {
        pointRadius = 0;
      } else if (numDataPoints > 50) {
        pointRadius = 2;
      } else {
        pointRadius = 3;
      }

      chart.data.datasets[0].pointRadius = pointRadius; // dynamically set point radius based on number of data points
      chart.data.datasets[1].pointRadius = pointRadius; // dynamically set point radius based on number of data points
      chart.update(); // update the chart
    });
 const chart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: idv.slice(-numDataPoints),
    datasets: [{
        label: 'High',
        data: highValues.slice(-numDataPoints),
        borderWidth: 1,
        pointRadius: pointRadius,
      },
      {
        label: 'Moving Average',
        data: trendValues.slice(-numDataPoints),
        borderWidth: 1,
        pointRadius: pointRadius,
      }
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
        text: 'High Values'
      },
      tooltip: {
        mode: 'index',
        intersect: false,
        callbacks: {
          label: function(context) {
            const label = context.dataset.label || '';
            const value = context.raw;
            if (label) {
              return `${label}: ${value}`;
            }
            return `${value}`;
          }
        }
      }
    }
  }
});


    // chart 2

    const ctx2 = document.getElementById('data2');
    // value
    const data2 = {!! json_encode($low_data) !!};
    const lowValues2 = data2.map(datum => datum.low);
    // trend
    const trend2 = {!! json_encode($low_trend) !!}
    const trendValues2 = trend2.map(trend => trend.sma_low);

    // date
    const ids2 = {!! json_encode($date) !!};
    const idv2 = ids2.map(id2 => {
      const date2 = new Date(id2.date);
      return `${date2.getFullYear()}/${(date2.getMonth() + 1).toString().padStart(2, '0')}/${date2.getDate().toString().padStart(2, '0')}`;
    });

    let pointRadius2;
    let numDataPoints2 = 30; // default number of data points to display
    const dataPointsDropdown2 = document.getElementById('data-points');
    dataPointsDropdown2.addEventListener('change', function() {
      const selectedOption = dataPointsDropdown2.value;
      if (selectedOption === 'all') {
        numDataPoints2 = lowValues2.length; // display all data points
      } else if (selectedOption === '90') {
        numDataPoints2 = 90; // display 90 data points
      } else {
        numDataPoints2 = 30; // display 30 data points
      }
      chart2.data.labels = idv2.slice(-
        numDataPoints2); // update chart labels to display the latest number of data points
      chart2.data.datasets[0].data = lowValues2.slice(-
        numDataPoints2); // update chart data to display the latest number of data points for low values
      chart2.data.datasets[1].data = trendValues2.slice(-
        numDataPoints2); // update chart data to display the latest number of data points for trend values

      if (numDataPoints2 > 100) {
        pointRadius2 = 0;
      } else if (numDataPoints2 > 50) {
        pointRadius2 = 2;
      } else {
        pointRadius2 = 3;
      }

      chart2.data.datasets[0].pointRadius =
        pointRadius2; // dynamically set point radius based on number of data points
      chart2.data.datasets[1].pointRadius =
        pointRadius2; // dynamically set point radius based on number of data points
      chart2.update(); // update the chart
    });

const chart2 = new Chart(ctx2, {
  type: 'line',
  data: {
    labels: idv2.slice(-numDataPoints2),
    datasets: [{
        label: 'Low',
        data: lowValues2.slice(-numDataPoints2),
        borderWidth: 1,
        pointRadius: pointRadius2,
      },
      {
        label: 'Moving Average',
        data: trendValues2.slice(-numDataPoints2),
        borderWidth: 1,
        pointRadius: pointRadius2,
      }
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
        text: 'Low Values'
      },
      tooltip: {
        mode: 'index',
        intersect: false,
        callbacks: {
          label: function(context) {
            const label = context.dataset.label || '';
            const value = context.raw;
            if (label) {
              return `${label}: ${value}`;
            }
            return `${value}`;
          }
        }
      }
    }
  }
});


    // chart 3
    const ctx3 = document.getElementById('data3');

    const data3 = {!! json_encode($volume_data) !!};
    const volumeValues3 = data3.map(datum => datum.volume);

    // trend
    const trend3 = {!! json_encode($volume_trend) !!}
    const trendValues3 = trend3.map(trend => trend.sma_volume);

    const ids3 = {!! json_encode($date) !!};
    const idv3 = ids3.map(id3 => {
      const date3 = new Date(id3.date);
      return `${date3.getFullYear()}/${(date3.getMonth() + 1).toString().padStart(2, '0')}/${date3.getDate().toString().padStart(2, '0')}`;
    });

    let pointRadius3;
    let numDataPoints3 = 30; // default number of data points to display
    const dataPointsDropdown3 = document.getElementById('data-points');
    dataPointsDropdown3.addEventListener('change', function() {
      const selectedOption = dataPointsDropdown3.value;
      if (selectedOption === 'all') {
        numDataPoints3 = volumeValues3.length; // display all data points
      } else {
        numDataPoints3 = parseInt(selectedOption);
      }
      chart3.data.labels = idv3.slice(-
        numDataPoints3); // update chart labels to display the latest number of data points
      chart3.data.datasets[0].data = volumeValues3.slice(-
        numDataPoints3); // update chart data to display the latest number of data points for high values
      chart3.data.datasets[1].data = trendValues3.slice(-
        numDataPoints3); // update chart data to display the latest number of data points for trend values


      if (numDataPoints3 > 100) {
        pointRadius3 = 0;
      } else if (numDataPoints3 > 50) {
        pointRadius3 = 2;
      } else {
        pointRadius3 = 3;
      }

      chart3.data.datasets[0].pointRadius =
        pointRadius3; // dynamically set point radius based on number of data points
      chart3.data.datasets[1].pointRadius =
        pointRadius3; // dynamically set point radius based on number of data points
      chart3.update(); // update the chart
    });

    const chart3 = new Chart(ctx3, {
      type: 'line',
      data: {
        labels: idv3.slice(-numDataPoints3), // display the latest number of data points by default
        datasets: [{
            label: 'Volume',
            data: volumeValues3.slice(-numDataPoints3), // display the latest number of data points by default
            borderWidth: 1,
            pointRadius: pointRadius3, // dynamically set point radius based on number of data points
          },
          {
            label: 'Moving Average',
            data: trendValues3.slice(-numDataPoints3), // display the latest number of data points by default
            borderWidth: 1,
            pointRadius: pointRadius3, // dynamically set point radius based on number of data points
          }
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
            text: 'Volume values' // change title from 'Low values' to 'High values'
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
