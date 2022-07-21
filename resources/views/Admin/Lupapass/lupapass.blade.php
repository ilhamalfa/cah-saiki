@extends('Admin.Layouts.LoginDash')

@section('container')

    <main class="form-signin" style="background-color: #fff;">
            <form action="/lupa-password/reset" method="POST">
            @csrf
            <img class="mb-4" src="{{asset('style/img/logoc.png')}}" alt="" width="240" height="140">
            <h1 class="h3 mb-3 fw-normal">Lupa Passsword</h1>
        
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email">
                <label for="floatingname">E-mail</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Submit</button>
            </form>
        <p class="mt-5 mb-3 text-muted">&copy; ADMIN CAHSAIKI.id</p>
    </main>
{{--  --}}
@endsection