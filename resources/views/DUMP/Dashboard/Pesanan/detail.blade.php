@extends('Dashboard.Layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pesanan atas nama, {{ $pesanan->pelanggan->nama }}</h1>
</div>

@if (session()->has('failed'))
    <div class="alert alert-danger" role="alert">
        {{ session('failed') }}
    </div>
@elseif (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@foreach ($detpes as $detail)
<div class="card mb-3">
    <div class="card-header">
        Pesanan Ke-{{ $loop->iteration }}
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $detail->menu->nama }}</h5>
        <p class="card-text">
            Jumlah : {{ $detail->jumlah }} <br>
            Keterangan : <p class="text-muted">{{ $detail->keterangan }}</p> <br>
            Total : @currency($detail->harga) <br>
    </div>
</div>
@endforeach

{{-- Total Harga --}}
<div class="col mb-3">
    <div class="card">
        <div class="card-body">
            @if ($pesanan->status == 'Telah Dibayar')
            <h5 class="text-success">{{ $pesanan->status }}</h5>
            <h5 class="fw-light">Total : @currency($pesanan->total)</h5>
            <h5 class="fw-light">Uang Pembayaran : @currency($pesanan->cash_in)</h5>
            <h5 class="fw-light">Kembalian : @currency($pesanan->cash_out)</h5>
            <h5 class="fw-light">Diterima Oleh : {{ $pesanan->pegawai->name }}</h5>
            <h5 class="fw-light">Pada Tanggal: {{ date('d-m-Y', strtotime($pesanan->tanggal)) }}</h5><hr>
            <h6 class="mt-2 text-muted fw-light fst-italic">Bukti Pembayaran Siap Dicetak</h6> 
            @elseif ($pesanan->status == 'Menunggu Pembayaran')
            <h5 class="text-warning fw-bold"> {{ $pesanan->status }}</h5>
            <h5 class="card-title">Total Yang Harus Dibayar : </h5>
            <h3>@currency($pesanan->total)</h3>
            @else
            <h5 class="text-danger fw-bold"> {{ $pesanan->status }}</h5>
            @endif
        </div>
    </div>
</div>

{{-- Tombol --}}
<div class="col mb-3">
    <div class="card">
        <div class="card-body ms-auto">
            {{-- Button Kembali --}}
            <a href="/dashboard/pesanan" class="btn btn-secondary">Kembali</a>
            @if ($pesanan->status == 'Telah Dibayar')
                <!-- Button Cetak Bukti Pembayaran -->
                <a href="/dashboard/pesanan/invoice/{{ $pesanan->id }}" class="btn btn-primary">Cetak Bukti Pembayaran</a>
            @elseif ($pesanan->status == 'Menunggu Pembayaran')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Konfirmasi Pembayaran
                </button>
                {{-- Batalkan Pemesanan --}}
                <form action="/dashboard/pesanan/batal/{{ $pesanan->id }}" method="POST" class="form-control-sm">
                @csrf
                    <button type="submit" class="btn btn-danger me-2" onclick="return confirm('Are You Sure?')">
                        Batalkan Pembayaran
                    </button>
                </form>
            @else

            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

{{-- Modal untuk invoice --}}
{{-- <div class="modal"> --}}
    {{-- <div id="print">
        @include('Dashboard.Pesanan.invoice')
    </div> --}}
{{-- </div> --}}
@endsection


