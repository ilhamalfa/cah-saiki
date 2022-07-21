@extends('Admin.Layouts.main')

@section('container')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Menu</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/menu" style="color: #262D31" >Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Menu</li>
                </ol>
            </div>
        </div>
    </div>
</section>

{{-- kondisi setelah berhasil membuat menu baru --}}
@if (session()->has('success'))
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

                    <div class="card-body">
                        <a href="/dashboard/menu/create" class="btn btn-primary mb-3"><span data-feather="plus-circle"></span> Tambah Menu Baru</a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($menus as $menu)
                            <tr>               
                                <th> {{ $loop->iteration }} </th>
                                <td> {{ $menu->nama }} </td>
                                <td> {{ $menu->jumlah }} </td>
                                <td> @currency($menu->harga) </td>
                                <th> 
                                    {{-- View --}}
                                    <button type="button" class="btn btn-sm bg-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $menu->id }}">
                                        Detail
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="detailModal{{ $menu->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="detailModalLabel">{{ $menu->nama }}</h3>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="far fa-circle nav-icon" data-feather="x"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col mb-3">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                {{-- pengecekan gambar jika ada gambar di database --}}
                                                                @if ($menu->image)
                                                                <div style="max-height: 500px; overflow:hidden;">
                                                                    <img src="{{ asset('storage/' . $menu->image) }}" class="img-fluid mt-3">
                                                                </div>
                                                                @else
                                                                <img src="https://source.unsplash.com/1200x500?foods" class="img-fluid mt-3">
                                                                @endif
                                                            </div>
                                                            <div class="card-body">
                                                                <p class="fw-light">
                                                                    Jumlah : @currency($menu->jumlah) <br>
                                                                    Harga : @currency($menu->harga) <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Edit --}}
                                    <a href="/dashboard/menu/{{ $menu->id }}/edit" class="btn btn-sm bg-warning">Edit</a>
                                    {{-- Menghapus detail Post --}}
                                    <form action="/dashboard/menu/{{ $menu->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm bg-danger border-0" onclick="return confirm('Are You Sure?')">Hapus</button>
                                    </form>
                                </th>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection