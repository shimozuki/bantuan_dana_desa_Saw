@extends('layouts.app')
@section('title', 'SPK Penerima Bantuan')
@section('topbar', 'Dashboard')
@section('css')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@stop
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang!</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- List Warga Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('alternatif.index') }}">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Warga</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alternatif }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('kriteria.index') }}">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Jumlah Kriteria</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kriteriacount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-code fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('penilaian.index') }}">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">

                                <div class="h5 mb-0 font-weight-bold text-gray-800">Penilaian</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bell fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('perhitungan.index') }}">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">

                                <div class="h5 mb-0 font-weight-bold text-gray-800">Perhitungan SAW</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Grafik Status Kelayakan -->
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Grafik Pie: Kelayakan</div>
                <div class="card-body">
                    <canvas id="pieChart" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">Grafik Bar: Jumlah Warga</div>
                <div class="card-body">
                    <canvas id="barChart" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">Grafik Doughnut</div>
                <div class="card-body">
                    <canvas id="doughnutChart" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Polar Area Chart -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">Grafik Polar Area</div>
                <div class="card-body">
                    <canvas id="polarChart" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Radar Chart -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">Radar Chart: Total Skor Alternatif</div>
                <div class="card-body">
                    <canvas id="radarChart" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const jumlahLayak = {{ $jumlahLayak }};
    const jumlahTidakLayak = {{ $jumlahTidakLayak }};

    // Pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['Layak', 'Tidak Layak'],
            datasets: [{
                data: [jumlahLayak, jumlahTidakLayak],
                backgroundColor: ['#1cc88a', '#e74a3b']
            }]
        }
    });

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Layak', 'Tidak Layak'],
            datasets: [{
                label: 'Jumlah Warga',
                data: [jumlahLayak, jumlahTidakLayak],
                backgroundColor: ['#1cc88a', '#e74a3b']
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });

    // Doughnut Chart
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Layak', 'Tidak Layak'],
            datasets: [{
                data: [jumlahLayak, jumlahTidakLayak],
                backgroundColor: ['#36b9cc', '#f6c23e']
            }]
        }
    });

    // Polar Area Chart
    new Chart(document.getElementById('polarChart'), {
        type: 'polarArea',
        data: {
            labels: ['Layak', 'Tidak Layak'],
            datasets: [{
                data: [jumlahLayak, jumlahTidakLayak],
                backgroundColor: ['#4e73df', '#fd7e14']
            }]
        }
    });

    // Radar Chart
    new Chart(document.getElementById('radarChart'), {
        type: 'radar',
        data: {
            labels: {!! json_encode(array_keys($ranking ?? [])) !!},
            datasets: [{
                label: 'Total Skor',
                data: {!! json_encode(array_map('array_sum', $ranking ?? [])) !!},
                fill: true,
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: '#4e73df',
                pointBackgroundColor: '#4e73df'
            }]
        },
        options: {
            scales: {
                r: {
                    beginAtZero: true,
                    max: 1
                }
            }
        }
    });
</script>
@endsection
