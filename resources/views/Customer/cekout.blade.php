@extends('Customer.Layouts.main')

@section('menu')
<div class="card mt-4">
    <div class="card-body">
    </div>
</div>

<div class="container-sm mt-3">

    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center fw-bold">Detail Pesanan</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <h6> Atas Nama : {{ $pesanan->pelanggan->nama }}</h6>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Makanan --}}
    @foreach ($detail_pesanan as $detail)
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="fw-bold">Pesanan Ke-{{ $loop->iteration }} : {{ $detail->menu->nama }}</h6>
                    Harga per-pcs : @currency($detail->menu->harga) <br>
                    Jumlah : {{ $detail->jumlah }} <br>
                    Total :  @currency($detail->harga) <br>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="fw-bold">Total Harga : @currency($pesanan->total)  </h4>
                    Kode : 
                    <h3 class="fw-bold">{{ $pesanan->kode }}</h3>
                    <p class="mt-2 text-muted fw-light fst-italic">Tunjukkan kode diatas ke kasir untuk melanjutkan proses pembayaran</p>
                    {{-- Tombol untuk trigger modal (Menampilkan QR-Code) --}}
                    <button href="/" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tampilkan QR Code
                    </button>
                    <hr>
                    <a href="/" class="btn btn-primary float-end ml-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body text-center">
                    {{ $kode_pembayaran }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
                    </div>
            </div>
        </div>
    </div>

</div>
@endsection