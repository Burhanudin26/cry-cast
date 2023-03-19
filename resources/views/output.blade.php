@extends('layouts.main')
@section('content')
  <section class="container d-flex flex-column justify-content-center align-items-center vh-md-100">
    <canvas id="data"></canvas>
    <div class="button">
      <!-- Show latest 30 data button -->
      <button onclick="location.href='{{ route('output', ['showAll' => 0]) }}'">Show latest 30 data</button>

      <!-- Show all data button -->
      <button onclick="location.href='{{ route('output', ['showAll' => 1]) }}'">Show all data</button>

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
