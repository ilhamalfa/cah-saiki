@extends('Admin.Layouts.main')

@section('container')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah User Baru</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/users" style="color: #262D31" >Daftar Users</a></li>
                    <li class="breadcrumb-item active">Tambah User Baru</li>
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
                        <form method="POST" action="/dashboard/users" class="mb-5">
                            {{-- kalau ada form, wajib ada csrf, untuk menangani cross side resource forgery --}}
                            @csrf
                            {{-- nama --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Name </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    
                            {{-- username --}}
                            <div class="mb-3">
                                <label for="username" class="form-label">Username </label>
                                <input type="text" min=0 class="form-control @error('username') is-invalid @enderror" id="username" name="username" required value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    
                            {{-- email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" min=0 class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    
                            {{-- password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">password </label>
                                <input type="password" min=0 class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    
                            {{-- password confirm--}}
                            <div class="mb-3">
                                <label for="konfirmpass" class="form-label">Masukkan Kembali Password</label>
                                <input type="password" min=0 class="form-control @error('konfirmpass') is-invalid @enderror" id="konfirmpass" name="konfirmpass" required>
                                @error('konfirmpass')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Tambah User</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection