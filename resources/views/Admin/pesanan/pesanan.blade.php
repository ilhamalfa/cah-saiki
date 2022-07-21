@extends('Admin.Layouts.main')

@section('container')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Kasir</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dash" style="color: #262D31" >Dashboard</a></li>
            <li class="breadcrumb-item active">Daftar Pesanan</li>
            </ol>
        </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Masukkan Kode Pesanan</h3>
            </div>

            <div class="card-body">
                
                <form action="">
                    <div class="input-group mb-3">
                    {{-- Search --}}
                    <input class="form-control form-control-lg" type="text" placeholder="Kode Pesanan..." name="search">
                    <button type="submit" class="btn btn-primary btn-lg">search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid overflow-scroll">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal Scanner-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Scan QR
                        </button>
                    </div>
                    
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="far fa-circle nav-icon" data-feather="x"></i></button>
            </div>
                <div class="modal-body">
                    <div id="reader" width="100px"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Close</button>
                </div>
        </div>
    </div>
</div>
@endsection