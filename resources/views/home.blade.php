@extends('layouts.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endpush

@section('content')
    @can('pengelola')
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Rp.{{ $income }}</h3>

                            <p>Income</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $jumlah_siswa }}</h3>

                            <p>Jumlah Siswa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $hitung_lunas }}</h3>

                            <p>Lunas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $hitung_belum_lunas }}</h3>

                            <p>Belum Lunas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartPie"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="col-md-12 mb-3">
                <div class="card                                                    ">
                    <div class="card-header">
                        <h3>Table Data Transaksi</h3>
                        <form action="{{ route('home') }}" method="get">
                            <div class="row mt-3">
                                <div class="col-auto">
                                    <select name="status_pembayaran" class="form-select w-auto">
                                        <option value="1">lunas</option>
                                        <option value="0">belum lunas</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <input name="search" type="text" class="form-control w-auto" placeholder="Seacrh">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body overflow-scroll">
                        <table class="table table-striped table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Nama Pengelola</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Tanggal Bayar</th>
                                    <th scope="col">Bulan Bayar</th>
                                    <th scope="col">Tahun Bayar</th>
                                    <th scope="col">Jumah Bayar</th>
                                    <th scope="col">Data SPP</th>
                                    <th scope="col">Tunggakan Perbulan</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Updated</th>
                                    <th scope="col">Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($transaksi as $key => $dataTransaksi)
                                    <tr>
                                        <th scope="row">{{ $key += $transaksi->firstItem() }}</th>
                                        <td>{{ $dataTransaksi->nisn }}</td>
                                        <td>{{ $dataTransaksi->nama_pengelola }}</td>
                                        <td>{{ $dataTransaksi->nama_siswa }}</td>
                                        <td>{{ $dataTransaksi->tgl_dibayar }}</td>
                                        <td>{{ $dataTransaksi->bln_dibayar }}</td>
                                        <td>{{ $dataTransaksi->thn_dibayar }}</td>
                                        <td>{{ $dataTransaksi->jumlah_bayar }}</td>
                                        <td>{{ $dataTransaksi->tahun . " - Rp." . $dataTransaksi->nominal }}</td>
                                        <td>{{ "Rp." . $dataTransaksi->nominal - $dataTransaksi->jumlah_bayar }}</td>
                                        <td>{{ $dataTransaksi->created_at }}</td>
                                        <td>{{ $dataTransaksi->updated_at }}</td>
                                        @if ($dataTransaksi->status_pembayaran == 1)
                                            <td>
                                                <button disabled class="btn-sm btn-primary"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Lunas</button>
                                            </td>
                                        @elseif ($dataTransaksi->status_pembayaran == 0)
                                            <td>
                                                <button disabled class="btn-sm btn-warning"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Belum Lunas</button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $transaksi->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcan

    @can('siswa')
    @livewire('siswa.home-siswa')
    @endcan

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var options = {
            series: [{
                name: 'Inflation',
                data: [
                    parseInt({{ $january }}),
                    parseInt({{ $february }}),
                    parseInt({{ $maret }}),
                    parseInt({{ $april }}),
                    parseInt({{ $mei }}),
                    parseInt({{ $juni }}),
                    parseInt({{ $juli }}),
                    parseInt({{ $agustus }}),
                    parseInt({{ $september }}),
                    parseInt({{ $oktober }}),
                    parseInt({{ $november }}),
                    parseInt({{ $desember }}),
                ]
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + " income";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val + "%";
                    }
                }

            },
            title: {
                text: 'Pendapatan di tahun {{ date('Y') }}',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var options = {
            series: [
                    parseInt({{ $jumlah_siswa }}),
                    parseInt({{ $hitung_lunas }}),
                    parseInt({{ $hitung_belum_lunas }}),
                ],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Jumlah Siswa', 'Lunas', 'Belum Lunas'],
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

        var chart = new ApexCharts(document.querySelector("#chartPie"), options);
        chart.render();
    </script>
@endpush
