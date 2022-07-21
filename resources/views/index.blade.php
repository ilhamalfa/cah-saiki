@extends('Pesanan.Layouts.main')

@section('container')
<div class="row justify-content-center mt-3">
    <div class="col-md-3">
        <main class="form-signin">
            <form action="/pesanan/storePelanggan" method="POST">
            @csrf
            
            <h1 class="h3 mb-3 fw-normal">Masukkan nama</h1>
        
            {{-- Text Input : Nama --}}
            <div class="form-floating">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda..">
                <label for="floatingname">Nama</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Submit</button>
            </form>
        </main>
    </div>
</div>

{{--  --}}
@endsection