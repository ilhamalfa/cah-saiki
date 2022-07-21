@extends('Dashboard.Layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Riwayat Seluruh Transaksi</h1>
</div>

@if ($tes == 'Hari')
    <a href="/dashboard/transaksi/" class="btn btn-primary">Semua</a>
    <button type="button" class="btn btn-primary" disabled>Hari Ini</button>
    <a href="/dashboard/transaksi/minggu_ini" class="btn btn-primary">Minggu ini</a>
    <a href="/dashboard/transaksi/bulan_ini" class="btn btn-primary">Bulan ini</a>
@elseif ($tes == 'Minggu')
    <a href="/dashboard/transaksi" class="btn btn-primary">Semua</a>
    <a href="/dashboard/transaksi/hari_ini" class="btn btn-primary">Hari Ini</a>
    <button type="button" class="btn btn-primary" disabled>Minggu Ini</button>
    <a href="/dashboard/transaksi/bulan_ini" class="btn btn-primary">Bulan ini</a>
@elseif ($tes == 'Bulan')
    <a href="/dashboard/transaksi" class="btn btn-primary">Semua</a>
    <a href="/dashboard/transaksi/hari_ini" class="btn btn-primary">Hari Ini</a>
    <a href="/dashboard/transaksi/minggu_ini" class="btn btn-primary">Minggu ini</a>
    <button type="button" class="btn btn-primary" disabled>Bulan Ini</button>
@else
    <button type="button" class="btn btn-primary" disabled>Semua</button>
    <a href="/dashboard/transaksi/hari_ini" class="btn btn-primary">Hari Ini</a>
    <a href="/dashboard/transaksi/minggu_ini" class="btn btn-primary">Minggu ini</a>
    <a href="/dashboard/transaksi/bulan_ini" class="btn btn-primary">Bulan Ini</a>
@endif

<hr>
{{-- Table --}}
<div class="table-responsive col-lg-9">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Diterima Oleh</th>
                <th scope="col">Total Harga</th>
                <th scope="col"></th>
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
                    <td> 
                        {{-- Detail --}}
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalViewData{{ $pesanan->id }}">
                            Detail
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="modalViewData{{ $pesanan->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalViewDataLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalViewDataLabel">Pesanan Atas Nama {{ $pesanan->pelanggan->nama }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="col mb-3">
                                                <div class="card">
                                                        <?php $details = App\Models\Detailpes::where('id_pesanan', $pesanan->id)->get(); ?>
                                                        
                                                        @foreach ($details as $detail)
                                                        <div class="card-body">
                                                            Pesanan Ke-{{ $loop->iteration }} <br>
                                                            {{ $detail->menu->nama }} <br>
                                                            Jumlah : {{ $detail->jumlah }} <br>
                                                            Keterangan : {{ $detail->keterangan }} <br>
                                                            Total : @currency($detail->harga) <br>
                                                        </div>
                                                        @endforeach
                                                    <div class="card-body">
                                                        <p class="fw-light">
                                                            Total : @currency($pesanan->total) <br>
                                                            Uang Pembayaran : @currency($pesanan->cash_in) <br>
                                                            Kembalian : @currency($pesanan->cash_out) <br>
                                                            Diterima Oleh : {{ $pesanan->pegawai->name }} <br>
                                                            Pada Tanggal: {{ date('d-m-Y', strtotime($pesanan->tanggal)) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
                <tr>               
                    <th>  </th>
                    <td> </td>
                    <td>  </td>
                    <td></td>
                    <td><b>@currency($total_harga)</b></td>
                    <td>  </td>
                </tr>
        </tbody>
    </table>
</div>
@endsection