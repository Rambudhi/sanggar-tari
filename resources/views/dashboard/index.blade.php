@extends('layouts.admin')

@section('title')
Dahsboard
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
      Dahsboards
    </h4>

    <div class="row mb-4 g-3">
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="content-left">
                <h5 class="mb-1">{{ $data['dipesan'] }}</h5>
                <small>Jumlah Kostum yang di Pesan</small>
              </div>
              <span class="badge bg-label-primary rounded-circle p-2">
                <i class="mdi mdi-package-up mdi-24px"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="content-left">
                <h5 class="mb-1">{{ $data['dibatalkan'] }}</h5>
                <small>Jumlah Kostum yang di Batalkan</small>
              </div>
              <span class="badge bg-label-success rounded-circle p-2">
                <i class="mdi mdi-bookmark-remove mdi-24px"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="content-left">
                <h5 class="mb-1">{{ $data['diambil'] }}</h5>
                <small>Jumlah Kostum yang di Sewa</small>
              </div>
              <span class="badge bg-label-danger rounded-circle p-2">
                <i class="mdi mdi-tshirt-v mdi-24px"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="content-left">
                <h5 class="mb-1">{{ $data['disetujui'] }}</h5>
                <small>Jumlah Kostum yang di Kembalikan</small>
              </div>
              <span class="badge bg-label-info rounded-circle p-2">
                <i class="mdi mdi-refresh mdi-24px"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header pb-1">
            <div class="d-flex justify-content-between">
              <h5 class="mb-1">Total yang daftar Kursus</h5>
            </div>
            <p class="text-body mb-0"></p>
          </div>
          <div class="card-body" style="position: relative;">
            <div id="weeklySalesChart" style="min-height: 250px;">
              <div id="chart"></div>
            </div>
          <div class="resize-triggers"><div class="expand-trigger"><div style="width: 449px; height: 350px;"></div></div><div class="contract-trigger"></div></div></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var register_course = @json($data['register_course']);
    var courseObject = register_course[0];
    var keys = Object.keys(courseObject);

    var options = {
          series: [parseInt(courseObject.Basic), parseInt(courseObject.Junior), parseInt(courseObject.Remaja), parseInt(courseObject.Lansia)],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: keys,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endsection