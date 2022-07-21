@extends('Customer.Layouts.loginlayout')

@section('container')
<main class="form-signin" style="background-color: #fff;">
  <div class="card-body">
    <form action="/pesanan/storePelanggan" method="POST">
      @csrf
      <img class="mb-4" src="{{asset('style/img/logoc.png')}}" alt="" width="240" height="140">
      <!-- <h1 class="h3 mb-3 fw-normal">Please sign in</h1> -->
  
      <div class="form-floating">
        <input type="text" class="form-control" id="nama" name="nama" placeholder="username">
        <label for="floatingname">Isi nama kakak disini</label>
      </div>
  
      <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Selesai</button>
      <p class="mt-5 mb-3 text-muted">&copy; CAHSAIKI.id</p>
    </div>
    </form>
  </main>

{{--  --}}
@endsection