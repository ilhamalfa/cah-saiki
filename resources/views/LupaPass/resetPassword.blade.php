@extends('Admin.Layouts.LoginDash')

@section('container')

    <main class="form-signin" style="background-color: #fff;">
            {{-- If Session --}}
            @if (session()->has('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('fail') }}
                </div>
            @endif
            
            <form action="/lupa-password/reset-pass/" method="POST">
            @csrf
            <img class="mb-4" src="{{asset('style/img/logoc.png')}}" alt="" width="240" height="140">
            <h1 class="h3 mb-3 fw-normal">Reset Password</h1>
        
            <input type="hidden" name="token" id="token" value="{{ $token }}">
            <div class="form-floating">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $email }}" readonly>
                <label for="floatingname">email</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- Password --}}
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                <label for="floatingname">Password</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- Konfirmasi Password --}}
            <div class="form-floating">
                <input type="password" class="form-control @error('konfirm') is-invalid @enderror" id="konfirm" name="konfirm" placeholder="Konfirmasi Password">
                <label for="floatingname">Konfirmasi Password</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Reset Password</button>
            </form>
        <p class="mt-5 mb-3 text-muted">&copy; ADMIN CAHSAIKI.id</p>
    </main>
{{--  --}}
@endsection