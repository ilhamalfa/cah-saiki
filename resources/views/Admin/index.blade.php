@extends('Admin.Layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $mytime = Carbon\Carbon::now()->format('l, j F Y'); }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard" style="color: #262D31" >Dashboard</a></li>
                <li class="breadcrumb-item active">Home</li>
                </ol>
            </div>
            </div>
        </div>
    </section>
    
        
    @foreach ($menus as $menu)
    @if ($menu->status == 'Empty')
    <div class="alert alert-danger" role="alert">
        {{ $menu->nama }} <strong>Stok Kosong!</strong> cek <a href="/dashboard/menu?search=Empty" style="color: inherit;">disini</a> untuk melihat menu yang kosong
    </div>
    @endif
    @endforeach
    <!-- Main content -->
    {{-- <section class="content">

    <!-- Default box -->
    <div class="card">
    <div class="card-header">
    <h3 class="card-title">Halo Selamat Datang!</h3>

    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
        </button>
    </div>
    </div>
    <div class="card-body">
        tengah
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    Footer
    </div>
    <!-- /.card-footer-->
    </div>

    </section> --}}

    <section class="content">
    <h5 class="mb-2 mt-4">Small Box</h5>
    <div class="row">

    {{-- card pesanan yang telah diterima --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ count($pesanan) }}</h3>
                <p>Jumlah Pesanan</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="/dashboard/pesanan" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- card pesanan yang telah dibayar --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ count($dibayar) }}</h3>
                <p>Pesanan Telah Dibayar</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/dashboard/pesanan?status=Telah+Dibayar" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- card pesanan Menunggu Pembayaran --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ count($tunggu) }}</h3>
                <p>Menunggu Pembayaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <a href="/dashboard/pesanan?status=Menunggu+Pembayaran" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- card pesanan yang Dibatalkan --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ count($batal) }}</h3>
                <p>Pesanan Dibatalkan</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <a href="/dashboard/pesanan?status=Pesanan+Dibatalkan" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    </div>
    </section>    
@endsection