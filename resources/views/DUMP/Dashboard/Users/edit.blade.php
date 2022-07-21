@extends('Dashboard.Layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit User {{$user->name}}</h1>
</div>

@if (session()->has('password_fail'))
    <div class="alert alert-danger" role="alert">
        {{ session('password_fail') }}
    </div>
@endif

<div class="col-lg-8">
    
    <form method="POST" action="/dashboard/users/{{ $user->id }}" class="mb-5">
        {{-- Method untuk proses edit --}}
        @method('put')
        {{-- kalau ada form, wajib ada csrf, untuk menangani cross side resource forgery --}}
        @csrf
        {{-- nama --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', $user->name) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- username --}}
        <div class="mb-3">
            <label for="username" class="form-label">Username </label>
            <input type="text" min=0 class="form-control @error('username') is-invalid @enderror" id="username" name="username" required value="{{ old('username', $user->username) }}">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email </label>
            <input type="email" min=0 class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email', $user->email) }}">
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

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection