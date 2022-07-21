@extends('Pesanan.Layouts.main')

@section('container')
{{-- Mengecek session --}}
@if (session()->has('failed'))
    <div class="alert alert-danger" role="alert">
        {{ session('failed') }}
    </div>
@endif

<h1 class="mb-5 text-center">Halo There, {{ $pelanggan->nama }}</h1>

<div class="container-xl" style="max-width: 1200px;">
<form action="/pesanan/menu/storePesanan" method="POST">
@csrf
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($menus as $menu)
        @if ($menu->jumlah != 0)
            {{-- Kolom Buat Card --}}
            <div class="col">
                {{-- card body --}}
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="card-header">
                            <input class="form-check-input" type="checkbox" id="menu[]" name="menu[]" value="{{ $menu->id }}" onclick="show()">
                        </div>
                        <div class="col-md-4">
                        {{-- pengecekan gambar jika ada gambar di database --}}
                        @if ($menu->image)
                        <div style="max-height: 400px; overflow:hidden;">
                            <img src="{{ asset('storage/' . $menu->image) }}" class="img-fluid mt-3">
                        </div>
                        @else
                        <img src="https://source.unsplash.com/500x500?food" class="img-fluid" alt="...">
                        @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->nama }}</h5>
                                <p class="card-text">Jumlah : {{ $menu->jumlah }}</p>
                                <p class="card-text">@currency($menu->harga)</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                        {{-- Footer --}}
                        <div class="card-footer">
                            {{-- Pilih Jumlah Yang Akan Dipesan --}}
                            <select class="form-select mb-1" id="jumlah[]" name="jumlah[]" disabled hidden required>
                                <option selected value="">-- Masukkan Jumlah Pesanan --</option>
                                @for ($i = 1; $i <= $menu->jumlah; $i++)
                                <option value={{ $i }}>{{ $i }}</option>
                                @endfor
                            </select>
                            {{-- Keterangan Pesanan --}}
                            <input type="text" class="form-control" id="keterangan[]" name="keterangan[]" placeholder="-- Masukkan Keterangan Pesanan --" disabled hidden>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Kolom Buat Card --}}
            <div class="col">
                {{-- card body --}}
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="card-header">
                            <input class="form-check-input" type="checkbox" id="menu[]" name="menu[]" value="{{ $menu->id }}" onclick="show()" disabled>
                        </div>
                        <div class="col-md-4">
                        <img src="https://source.unsplash.com/500x500?food" class="img-fluid" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->nama }}</h5>
                                <p class="card-text">Jumlah : {{ $menu->jumlah }}</p>
                                <p class="card-text">@currency($menu->harga)</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                        {{-- Footer --}}
                        <div class="card-footer">
                            {{-- Pilih Jumlah Yang Akan Dipesan --}}
                            <select class="form-select mb-1" id="jumlah[]" name="jumlah[]" disabled hidden required>
                                <option selected value="">-- Masukkan Jumlah Pesanan --</option>
                                @for ($i = 1; $i <= $menu->jumlah; $i++)
                                <option value={{ $i }}>{{ $i }}</option>
                                @endfor
                            </select>
                            {{-- Keterangan Pesanan --}}
                            <input type="text" class="form-control" id="keterangan[]" name="keterangan[]" placeholder="-- Masukkan Keterangan Pesanan --" disabled hidden>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @endforeach
    </div>
    <div class="card mt-5">
        <div class="card-body">
        </div>
    </div>
    <input type="text" class="form-control" id="id_Pelanggan" name="id_Pelanggan" value="{{ $pelanggan->id }}" hidden>
    <input type="text" class="form-control" id="slug_Pelanggan" name="slug_Pelanggan" value="{{ $pelanggan->slug }}" hidden>
    {{-- Navbar tempat tombol berada --}}
    <nav class="navbar bg-light fixed-bottom navbar-expand{-xl}">
        <div class="container-fluid">
            <ul class="navbar-nav ms-auto">
                <button type="submit" class="btn btn-primary me-2" name="submit" id="submit" onclick="return confirm('Are You Sure?')">Pesan</button>
            </ul>
        </div>
    </nav>
</form>
</div>

<script>
    var checkbox = document.getElementsByName('menu[]');
    var jml = document.getElementsByName('jumlah[]');
    var ket = document.getElementsByName('keterangan[]');

    function show() {
        for (var i = 0; i < checkbox.length; i++) {
            if(checkbox[i].checked == true){
                jml[i].disabled = false;
                ket[i].disabled = false;
                jml[i].hidden = false;
                ket[i].hidden = false;
            }else{
                jml[i].disabled = true;
                ket[i].disabled = true;
                jml[i].hidden = true;
                ket[i].hidden = true;
            }
        }
    }

    function test(){
        var checkedValue = null; 
        var inputElements = document.getElementsByName('menu[]');
        for(var i=0; inputElements[i]; ++i){
            if(inputElements[i].checked){
            checkedValue = inputElements[i].value;
            break;
    }
}
    }

</script>

@endsection