@extends('Dashboard.Layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $menu->nama }}</h1>
</div>

<div class="col-lg-8">
    {{-- jika method post digabung dengan route /dashboard/posts akan otomatis mengarah ke method store di DashboardPostController, jika controller menggunakan resource --}}
    <form method="POST" action="/dashboard/menu/{{ $menu->id }}" class="mb-5" enctype="multipart/form-data">
        {{-- Method untuk proses edit --}}
        @method('put')
        {{-- kalau ada form, wajib ada csrf, untuk menangani cross side resource forgery --}}
        @csrf
        {{-- nama --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama </label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama', $menu->nama) }}">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label for="harga" class="form-label">Harga </label>
            <input type="number" min=0 class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required value="{{ old('harga', $menu->harga) }}">
            @error('harga')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Jumlah --}}
        <div class="mb-3">
            <label for="jumlah" class="form-label">jumlah </label>
            <input type="number" min=0 class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" required value="{{ old('jumlah', $menu->jumlah) }}">
            @error('jumlah')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        {{-- File Input (Gambar) --}}
        {{-- <div class="mb-3">
            untuk menangani file, form harus ditambahkan atribut enctype
            <label for="image" class="form-label">Post Image</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}

        <button type="submit" class="btn btn-primary">Update Menu</button>
    </form>
</div>

@endsection