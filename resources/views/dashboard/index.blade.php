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
                <h5 class="mb-1">245</h5>
                <small>Transaksi Hari ini</small>
              </div>
              <span class="badge bg-label-primary rounded-circle p-2">
                <i class="mdi mdi-cart-outline mdi-24px"></i>
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
                <h5 class="mb-1">Rp12.583.472</h5>
                <small>Amount Transaksi Hari Ini</small>
              </div>
              <span class="badge bg-label-success rounded-circle p-2">
                <i class="mdi mdi-currency-usd mdi-24px"></i>
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
                <h5 class="mb-1">13</h5>
                <small>Transaksi Doku Reversal</small>
              </div>
              <span class="badge bg-label-danger rounded-circle p-2">
                <i class="mdi mdi-refresh mdi-24px"></i>
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
                <h5 class="mb-1">Rp12.583.472</h5>
                <small>Amount Transaksi Sebulan</small>
              </div>
              <span class="badge bg-label-info rounded-circle p-2">
                <i class="mdi mdi-currency-usd mdi-24px"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-12 col-md-6">
        <div class="card h-100">
          <div class="card-header pb-1">
            <div class="d-flex justify-content-between">
              <h5 class="mb-1">Transaksi Bulanan</h5>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="weeklySalesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-dots-vertical mdi-24px"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklySalesDropdown">
                  <a class="dropdown-item waves-effect" href="javascript:void(0);">Last 28 Days</a>
                  <a class="dropdown-item waves-effect" href="javascript:void(0);">Last Month</a>
                  <a class="dropdown-item waves-effect" href="javascript:void(0);">Last Year</a>
                </div>
              </div>
            </div>
            <p class="text-body mb-0">Total 245 Sales</p>
          </div>
          <div class="card-body" style="position: relative;">
            <div id="weeklySalesChart" style="min-height: 250px;">
              <div id="chart"></div>
            </div>
            <div class="d-flex align-items-center justify-content-around mt-3">
              <div class="d-flex align-items-center">
                <div class="avatar">
                  <div class="avatar-initial bg-label-primary rounded">
                    <i class="mdi mdi-trending-up mdi-24px"></i>
                  </div>
                </div>
                <div class="ms-3 d-flex flex-column">
                  <h6 class="mb-1">1.000</h6>
                  <small>Transaksi</small>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="avatar">
                  <div class="avatar-initial bg-label-success rounded">
                    <i class="mdi mdi-currency-usd mdi-24px"></i>
                  </div>
                </div>
                <div class="ms-3 d-flex flex-column">
                  <h6 class="mb-1">$482k</h6>
                  <small>Total Profit</small>
                </div>
              </div>
            </div>
          <div class="resize-triggers"><div class="expand-trigger"><div style="width: 449px; height: 350px;"></div></div><div class="contract-trigger"></div></div></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var options = {
        series: [{
          data: [21, 22, 10, 38, 16, 21, 13, 21, 22, 10, 38, 16, 21, 13, 21, 22, 10, 38, 16, 21, 13, 21, 22, 10, 38, 16, 21, 13]
        }],
        chart: {
          height: 400,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        // colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '15%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: [
            'S',
            'M',
            'T',
            'W',
            'T',
            'F',
            'S',
            'S',
            'M',
            'T',
            'W',
            'T',
            'F',
            'S',
            'S',
            'M',
            'T',
            'W',
            'T',
            'F',
            'S',
            'S',
            'M',
            'T',
            'W',
            'T',
            'F',
            'S', 
          ],
          labels: {
            style: {
              // colors: colors,
              fontSize: '12px'
            }
          }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endsection