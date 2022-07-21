@extends('Admin.Layouts.main')

@section('container')
{{-- Header --}}
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Detail Pesanan</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard/pesanan" style="color: #262D31" >Daftar Pesanan</a></li>
                <li class="breadcrumb-item active">Pesanan {{ $pesanan->kode }}</li>
                </ol>
            </div>

        </div>
    </div>
</section>

{{-- Alert --}}
@if (session()->has('failed'))
<div class="card-body">
    <div class="alert alert-danger" role="alert">
        {{ session('failed') }}
    </div>
</div>
@elseif (session()->has('success'))
<div class="card-body">
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
</div>
@endif

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Pesanan atas nama, {{ $pesanan->pelanggan->nama }}</h3>
                    </div>
        
                    @foreach ($detpes as $detail)
                    <div class="card-body">
                        <div class="card-header">
                            <b>Pesanan Ke-{{ $loop->iteration }}</b>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $detail->menu->nama }}</b></h5>
                            <p class="card-text">
                                Jumlah : {{ $detail->jumlah }} <br>
                                <b>Total : @currency($detail->harga)</b>
                        </div>
                    </div>
                    @endforeach

                    <div class="card-body">
                        <div class="card-header">
                            @if ($pesanan->status == 'Telah Dibayar')
                            <h5 class="text-success"><b>{{ $pesanan->status }}</b></h5>
                            <h5 class="fw-light">Total : @currency($pesanan->total)</h5>
                            <h5 class="fw-light">Uang Pembayaran : @currency($pesanan->cash_in)</h5>
                            <h5 class="fw-light"><b>Kembalian : @currency($pesanan->cash_out)</b></h5>
                            @elseif ($pesanan->status == 'Menunggu Pembayaran')
                            <h5 class="text-warning fw-bold"> <b>{{ $pesanan->status }}</b> </h5>
                            <h5 class="fw-light">Total Yang Harus Dibayar : </h5>
                            <h3 class="fw-light"> <b>@currency($pesanan->total)</b></h3>
                            @else
                            <h5 class="text-danger fw-bold"> <b>{{ $pesanan->status }}</b> </h5>
                            @endif
                        </div>
                        <div class="card-body">
                            @if ($pesanan->status == 'Telah Dibayar')
                            <h5 class="fw-light">Diterima Oleh : {{ $pesanan->pegawai->name }}</h5>
                            <h5 class="fw-light">Pada Tanggal: {{ date('d-m-Y', strtotime($pesanan->tanggal)) }}</h5><hr>
                            <h6 class="mt-2 text-muted fw-light fst-italic">Bukti Pembayaran Siap Dicetak</h6> 
                            @endif
                            
                            {{-- button --}}
                            @if ($pesanan->status == 'Telah Dibayar')
                                <!-- Button Cetak Bukti Pembayaran -->
                                {{-- <a href="/dashboard/pesanan/invoice/{{ $pesanan->id }}" onClick="window.print();return false" class="btn btn-primary" style="float: right;">Cetak</a> --}}
                                <input type="submit" value="Cetak" onClick=printExternal("/dashboard/pesanan/invoice/{{ $pesanan->id }}") class="btn btn-primary" style="float: right;">
                            @elseif ($pesanan->status == 'Menunggu Pembayaran')
                                <!-- Button trigger modal -->
                                <input type="button" value="Konfirmasi" class="btn btn-primary" data-bs-toggle="modal" style="float: right;" data-bs-target="#staticBackdrop">
                                {{-- Batalkan Pemesanan --}}
                                <form action="/dashboard/pesanan/batal/{{ $pesanan->id }}" method="POST" class="form-control-sm">
                                @csrf
                                    <button type="submit" class="btn btn-danger" style="float: right; margin-right: 10px; margin-top: -4px" onclick="return confirm('Are You Sure?')">
                                        Batalkan 
                                    </button>
                                </form>
                            @endif
                                
                        </div>
                    </div>
                    

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pembayaran</h5>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="far fa-circle nav-icon" data-feather="x"></i></button>
                                </div>
                                {{-- FORM Konfirmasi --}}
                                <form action="/dashboard/pesanan/konfirmasi/{{ $pesanan->id }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <main class="form-signin">
                                            
                                            <label for="title" class="form-label">Uang Yang Dibayarkan</label>
                                                <input type="number" min=0 class="form-control" id="cashIn" name="cashIn" required>
                                        </main>
                                    </div>
                                    {{-- button --}}
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');

    printWindow.addEventListener('load', function() {
        if (Boolean(printWindow.chrome)) {
            printWindow.print();
            setTimeout(function(){
                printWindow.close();
            }, 500);
        } else {
            printWindow.print();
            printWindow.close();
        }
    }, true);
}
</script>
@endsection