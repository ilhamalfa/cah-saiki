@extends('Dashboard.Layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome Back, {{ auth()->user()->name }}</h1>
    {{ $mytime = Carbon\Carbon::now()->format('l, j F Y'); }}
</div>

@foreach ($menus as $menu)
        @if ($menu->status == 'Empty')
        <div class="alert alert-danger" role="alert">
            {{ $menu->nama }} <strong>Stok Kosong!</strong> cek <a href="/dashboard/menu?search=Empty" style="color: inherit;">disini</a> untuk melihat menu yang kosong
        </div>
        @endif
@endforeach

<div class="container">
    <div class="row text-white overflow-auto">
        {{-- card pesanan yang telah diterima --}}
        <div class="col-sm-3 mb-3">
            <div class="card bg-success" style="width: 18rem;">
                <div class="card-body">
                    <div class="card-body-icon position-absolute" style="z-index: 0; top: 25px; right: 4px; opacity: 0.4; font-size: 90px;">
                        <i class="feather" data-feather="check-circle" style="width: 90px; height: 90px;"></i>
                    </div>
                    <h6 class="card-title">Pesanan Telah Dibayar</h6>
                    <div class="display-4 fw-semibold">{{ count($dibayar) }}</div>
                    <a href="/dashboard/pesanan?status=Telah+Dibayar" style="text-decoration:none;"><p class="card-text text-white">
                        Lihat Detail <span data-feather="arrow-right" class="align-text-bottom ml-3"></span>
                    </p></a>
                </div>
            </div>
        </div>

    {{-- card pesanan yang Dibatalkan --}}
        <div class="col-sm-3 mb-3">
            <div class="card bg-danger" style="width: 18rem;">
                <div class="card-body">
                    <div class="card-body-icon position-absolute" style="z-index: 0; top: 25px; right: 4px; opacity: 0.4; font-size: 90px;">
                        <i class="feather" data-feather="x-circle" style="width: 90px; height: 90px;"></i>
                    </div>
                    <h6 class="card-title">Pesanan Dibatalkan</h6>
                    <div class="display-4 fw-semibold">{{ count($batal) }}</div>
                    <a href="/dashboard/pesanan?status=Pesanan+Dibatalkan" style="text-decoration:none;"><p class="card-text text-white">
                        Lihat Detail <span data-feather="arrow-right" class="align-text-bottom ml-3"></span>
                    </p></a>
                </div>
            </div>
        </div>

        {{-- card pesanan Menunggu Pembayaran --}}
        <div class="col-sm-3 mb-3">
            <div class="card bg-warning" style="width: 18rem;">
                <div class="card-body">
                    <div class="card-body-icon position-absolute" style="z-index: 0; top: 25px; right: 4px; opacity: 0.4; font-size: 90px;">
                        <i class="feather" data-feather="tag" style="width: 90px; height: 90px;"></i>
                    </div>
                    <h6 class="card-title">Menunggu Pembayaran</h6>
                    <div class="display-4 fw-semibold">{{ count($tunggu) }}</div>
                    <a href="/dashboard/pesanan?status=Menunggu+Pembayaran" style="text-decoration:none;"><p class="card-text text-white">
                        Lihat Detail <span data-feather="arrow-right" class="align-text-bottom ml-3"></span>
                    </p></a>
                </div>
            </div>
        </div>

        {{-- card makanan --}}
        <div class="col-sm-3 mb-3">
            <div class="card bg-info" style="width: 18rem;">
                <div class="card-body">
                    <div class="card-body-icon position-absolute" style="z-index: 0; top: 25px; right: 4px; opacity: 0.4; font-size: 90px;">
                        <i class="feather" data-feather="package" style="width: 90px; height: 90px;"></i>
                    </div>
                    <h6 class="card-title">Jumlah Pesanan</h6>
                    <div class="display-4 fw-semibold">{{ count($pesanan) }}</div>
                    <a href="/dashboard/pesanan" style="text-decoration:none;"><p class="card-text text-white">
                        Lihat Detail <span data-feather="arrow-right" class="align-text-bottom ml-3"></span>
                    </p></a>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h3"><i class="feather" data-feather="bar-chart-2" style="width: 20px; height: 20px;"></i> Grafik Pendapatan</h2>
    </div>

    {{-- Chartbox --}}
    {{-- Tanggal --}}
    <div class="row text-white overflow-auto mb-3">
        <div class="accordion" id="accordionExample">
            {{-- Grafik pe-tanggal --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Grafik Pendapatan Bulan Ini
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div id="grafik-tanggal"></div>
                    </div>
                </div>
            </div>
                {{-- Grafik Pendapatan Per-Bulan --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Grafik Pendapatan Per-Bulan
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div id="grafik-bulan"></div>
                    </div>
                </div>
            </div>
                {{-- Grafik Pendapatan Per-Tahun --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Grafik Pendapatan Per-Tahun
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div id="grafik-tahun"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const d = new Date();

    // Variabel dari controller
    var pendapatanBulan = {{ json_encode($total_harga) }};
    var bulan = JSON.parse("{{ json_encode($bulan) }}".replace(/&quot;/g,'"'));

    var pendapatanTahun = {{ json_encode($total_harga_tahunan) }};
    var tahun = JSON.parse("{{ json_encode($tahun) }}".replace(/&quot;/g,'"'));

    var pendapatanTanggal = {{ json_encode($total_harga_tanggal) }};
    var tanggal = JSON.parse("{{ json_encode($tanggal) }}".replace(/&quot;/g,'"'));

    Highcharts.chart('grafik-tanggal', {
        title : {
            text: "Grafik Pendapatan Bulan " + monthNames[d.getMonth()]
        },
        xAxis : {
            categories : tanggal
        },
        yAxis : {
            title : {
                text : 'Nominal Pendapatan Bulanan'
            }
        },
        plotOption : {
            series : {
                allowPointSelect: true
            }
        },
        series : [
            {
                name : 'Nominal Pendapatan',
                data : pendapatanTanggal
            }
        ]
    });

    Highcharts.chart('grafik-bulan', {
        title : {
            text: "Grafik Pendapatan Tahun " + new Date().getFullYear()
        },
        xAxis : {
            categories : bulan
        },
        yAxis : {
            title : {
                text : 'Nominal Pendapatan Bulanan'
            }
        },
        plotOption : {
            series : {
                allowPointSelect: true
            }
        },
        series : [
            {
                name : 'Nominal Pendapatan',
                data : pendapatanBulan
            }
        ]
    });

    Highcharts.chart('grafik-tahun', {
        title : {
            text: "Grafik Pendapatan Per-Tahun"
        },
        xAxis : {
            categories : tahun
        },
        yAxis : {
            title : {
                text : 'Nominal Pendapatan Per-Tahun'
            }
        },
        plotOption : {
            series : {
                allowPointSelect: true
            }
        },
        series : [
            {
                name : 'Nominal Pendapatan',
                data : pendapatanTahun
            }
        ]
    });
</script>
@endsection