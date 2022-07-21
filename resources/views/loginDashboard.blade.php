@extends('Pesanan.Layouts.main')

@section('container')
<div class="row justify-content-center mt-3">
    <div class="col-md-3">
        <main class="form-signin">
            {{-- If Session --}}
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/loginDashboard/login" method="POST">
            @csrf
            
            <h1 class="h3 mb-3 fw-normal">Login</h1>
        
            {{-- Text Input : Nama --}}
            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                <label for="floatingname">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="floatingname">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Submit</button>
            </form>
            <a href="/lupa-password">Lupa Password</a>
        </main>
    </div>
</div>

{{--  --}}
@endsection