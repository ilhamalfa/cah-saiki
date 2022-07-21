@extends('Admin.Layouts.main')

@section('container')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Penjualan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard" style="color: #262D31" >Dashboard</a></li>
                <li class="breadcrumb-item active">Laporan Penjualan</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<!-- Main content -->
<section class="content">
    {{-- TABELLLLLL --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            {{-- Search --}}
                            <div class="card-body">
                                <form action="/dashboard/riwayat">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputCity">Dari Tanggal</label>
                                            <input type="date" class="form-control" name="from" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputZip">Sampai Tanggal</label>
                                            <input type="date" class="form-control" name="to" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>
                            </div>

                            @if (app('request')->input('from') && app('request')->input('from'))
                            {{-- Cetak --}}
                            <div class="col">
                                <!-- Button Cetak PDF -->
                                <form action="/dashboard/riwayat/export-PDF">
                                            <input type="hidden" class="form-control" name="from" value="{{ app('request')->input('from') }}" required>
                                            <input type="hidden" class="form-control" name="to" value="{{ app('request')->input('to') }}" required>
                                    <button type="submit" class="btn btn-primary" style="float: right;">Cetak PDF</button>
                                </form>

                                <!-- Button Cetak Excel -->
                                <form action="/dashboard/riwayat/export-excel">
                                            <input type="hidden" class="form-control" name="from" value="{{ app('request')->input('from') }}" required>
                                            <input type="hidden" class="form-control" name="to" value="{{ app('request')->input('to') }}" required>
                                    <button type="submit" class="btn btn-primary mr-2" style="float: right;">Cetak Excel</button>
                                </form>
                            </div>
                            @endif

                                <table class="table table-bordered table-hover mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tanggal Transaksi</th>
                                            <th scope="col">Nama Pelanggan</th>
                                            <th scope="col">Diterima Oleh</th>
                                            <th scope="col">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesanans as $pesanan)
                                        <tr>               
                                            <th> {{ $loop->iteration }} </th>
                                            <td> {{ date('d-m-Y', strtotime($pesanan->tanggal)) }} </td>
                                            <td> {{ $pesanan->pelanggan->nama }} </td>
                                            <td> {{ $pesanan->pegawai->name }} </td>
                                            <td>@currency($pesanan->total)</td>
                                        </tr>
                                        @endforeach
                                            <tr>               
                                                <th>    </th>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td><b>@currency($total_harga)</b></td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{ $pesanans->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </section>
</section>
@endsection