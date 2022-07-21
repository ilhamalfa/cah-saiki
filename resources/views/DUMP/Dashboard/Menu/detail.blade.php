@extends('Dashboard.Layouts.main')

@section('container')
<div class="container">
    <div class="row mb-5">
        <div class="col-lg-8">  
                <h1 class="mb-3">{{ $menu->nama }}</h1>

                    {{-- Kembali ke post --}}
                    <a href="/dashboard/menu" class="btn btn-success"><span data-feather="arrow-left"></span>Kembali</a>
                    {{-- Mengedit Post --}}
                    <a href="/dashboard/menu/{{ $menu->id }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
                    {{-- Delete Post --}}
                    <form action="/dashboard/menu/{{ $menu->id }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are You Sure?')">
                            <span data-feather="x-circle"></span> Delete 
                        </button>
                    </form>

                    {{-- pengecekan gambar jika ada gambar di database --}}
                    @if ($menu->image)
                        <div style="max-height: 400px; overflow:hidden;">
                            <img src="{{ asset('storage/' . $menu->image) }}" class="img-fluid mt-3">
                        </div>
                    @else
                    <img src="https://source.unsplash.com/1200x400?foods" class="img-fluid mt-3">
                    @endif

                    <article class="my-3 fs-5">
                        <h5>@currency($menu->harga)</h5>
                        <h5>Jumlah : {{ $menu->jumlah }}</h5>
                        {!! $menu->detail !!} <!-- Digunakan untuk menjalankan tag HTML jika isi body terdapat tag HTML -->
                    </article>
        </div>
    </div>
</div>
@endsection