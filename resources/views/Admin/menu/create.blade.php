@extends('Admin.Layouts.main')

@section('container')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Menu Baru</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/menu" style="color: #262D31" >Daftar Menu</a></li>
                    <li class="breadcrumb-item active">Tambah Menu Baru</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        {{-- jika method post digabung dengan route /dashboard/posts akan otomatis mengarah ke method store di DashboardPostController, jika controller menggunakan resource --}}
                        <form method="POST" action="/dashboard/menu" class="mb-5" enctype="multipart/form-data">
                            {{-- kalau ada form, wajib ada csrf, untuk menangani cross side resource forgery --}}
                            @csrf
                            {{-- nama --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Menu</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Harga --}}
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga </label>
                                <input type="number" min=0 class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required value="{{ old('harga') }}">
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Jumlah --}}
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah </label>
                                <input type="number" min=0 class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" required value="{{ old('jumlah') }}">
                                @error('jumlah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- File Input (Gambar) --}}
                            <div class="mb-3">
                                {{-- untuk menangani file, form harus ditambahkan atribut enctype --}}
                                <label for="image" class="form-label">Post Image</label>
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Tambah Menu</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection