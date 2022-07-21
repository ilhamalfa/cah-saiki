@extends('Dashboard.Layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Makanan</h1>
</div>

{{-- kondisi setelah berhasil membuat menu baru --}}
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive col-lg-9">
    <a href="/dashboard/menu/create" class="btn btn-primary mb-3"><span data-feather="plus-circle"></span> Tambah Menu Baru</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">action</th>
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
                        <a href="/dashboard/menu/{{ $menu->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                        {{--Edit --}}
                        <a href="/dashboard/menu/{{ $menu->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                        {{-- Menghapus detail Post --}}
                        <form action="/dashboard/menu/{{ $menu->id }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure?')"><span data-feather="x-circle"></span></button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection