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
</style>
  <section class="container d-flex flex-column justify-content-center align-items-center vh-md-100">
    <canvas id="data"></canvas>
    <div class="button">
      <!-- Show latest 30 data button -->
      <button onclick="location.href='{{ route('output', ['showAll' => 0]) }}'">Show latest 30 data</button>

      <!-- Show all data button -->
      <button onclick="location.href='{{ route('output', ['showAll' => 1]) }}'">Show all data</button>

      {{-- back button float --}}
      <div class="tombol">
        <a href="{{ url('/menu') }}" class="tombol-terbang" role="button" type="button">
        <i class="fa-solid fa-reply"></i></a>
      </div>
      {{-- back button biasa --}}

      <div class="tombol2 mt-3 text-center">
        <a href="{{ url('/menu') }}" class="btn btn-primary" role="button" type="button"> Kembali</a>
      </div>

    </div>
  </section>
  {{-- Chart.js --}}
  <script src="{{ url('js/chart.js/dist/chart.umd.js') }}"></script>
  <script>
    const ctx = document.getElementById('data');
    const data = {!! json_encode($data) !!};
    const highValues = data.map(datum => datum.high);
    const ids = {!! json_encode($id) !!};
    const idv = ids.map(id => id.id);

    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: idv,
        datasets: [{
          label: 'high',
          data: highValues,
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
  </script>


  </script>
@endsection
