@extends('Admin.Layouts.main')

@section('container')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update, {{ auth()->user()->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard" style="color: #262D31" >dashboard</a></li>
                    <li class="breadcrumb-item active">Update, {{ auth()->user()->name }}</li>
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
@elseif (session()->has('password_fail'))
<div class="card-body">
    <div class="alert alert-danger" role="alert">
        {{ session('password_fail') }}
    </div>
</div>
@endif

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="/dashboard/user/update/{{auth()->user()->id}}" class="mb-5">
                            {{-- kalau ada form, wajib ada csrf, untuk menangani cross side resource forgery --}}
                            @csrf
                            {{-- nama --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">name </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', auth()->user()->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    
                            {{-- username --}}
                            <div class="mb-3">
                                <label for="username" class="form-label">Username </label>
                                <input type="text" min=0 class="form-control @error('username') is-invalid @enderror" id="username" name="username" required value="{{ old('username', auth()->user()->username) }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    
                            {{-- email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" min=0 class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email', auth()->user()->email) }}">
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
                    
                            <button type="submit" class="btn btn-primary">Update Profil</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection