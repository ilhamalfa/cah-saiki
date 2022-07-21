@extends('Dashboard.Layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pesanan</h1>
</div>

<div class="table-responsive col-lg-9">
    {{-- Search --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="">
                <div class="input-group mb-3">
                {{-- Search --}}
                <input type="text" class="form-control" placeholder="search" name="search">
                <button type="submit" class="btn btn-primary">search</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <a href="/dashboard/pesanan?status=Belum+Dibayar" class="btn btn-primary">Belum Dibayar</a> 
    <a href="/dashboard/pesanan?status=Telah+Dibayar" class="btn btn-primary">Telah Dibayar</a>
    <hr> --}}
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesanans as $pesanan)
                <tr>               
                    <th> {{ $loop->iteration }} </th>
                    <td> {{ $pesanan->pelanggan->nama }} </td>
                    <td> @currency($pesanan->total) </td>
                    <td>
                        @if ($pesanan->status == 'Telah Dibayar')
                            <p class="text-success fw-semibold">{{ $pesanan->status }}</p>
                        @elseif ($pesanan->status == 'Menunggu Pembayaran')
                            <p class="text-warning fw-semibold">{{ $pesanan->status }}</p>
                        @else
                            <p class="text-danger fw-semibold">{{ $pesanan->status }}</p>
                        @endif
                    </td>
                    <td> 
                        {{-- Detail --}}
                        <a href="/dashboard/pesanan/detail/{{ $pesanan->id }}" class="btn btn-primary btn-sm">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $pesanans->links() }}
@endsection