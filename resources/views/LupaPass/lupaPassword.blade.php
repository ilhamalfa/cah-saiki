@extends('DUMP.Pesanan.Layouts.main')

@section('container')
<div class="row justify-content-center mt-3">
    <div class="col-md-3">
        <main class="form-signin">
            <form action="/lupa-password/reset" method="POST">
            @csrf
            
            <h1 class="h3 mb-3 fw-normal">Lupa Passsword</h1>
        
            <div class="form-floating">
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
        </main>
    </div>
</div>

{{--  --}}
@endsection