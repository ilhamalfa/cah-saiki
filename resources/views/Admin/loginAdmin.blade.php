@extends('Admin.Layouts.LoginDash')

@section('container')

    <main class="form-signin" style="background-color: #fff;">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session()->has('loginError'))
            <div class="alert alert-danger" role="alert">
                {{ session('loginError') }}
            </div>
        @endif

        <form action="/loginDashboard/login" method="POST">
        @csrf
        <img class="mb-4" src="{{asset('style/img/logoc.png')}}" alt="" width="240" height="140">
        <!-- <h1 class="h3 mb-3 fw-normal">Please sign in</h1> -->
    
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            <label for="floatingname">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <label for="floatingname">Password</label>
        </div>
    
        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Masuk</button>
        </form>
        <a href="/lupa-password">Lupa Password</a>
        <p class="mt-5 mb-3 text-muted">&copy; ADMIN CAHSAIKI.id</p>
    </main>
{{--  --}}
@endsection