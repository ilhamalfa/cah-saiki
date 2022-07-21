@extends('Customer.Layouts.main')

@section('menu')
{{-- Mengecek session --}}
{{-- @if (session()->has('failed'))
    <div class="alert alert-danger" role="alert">
        {{ session('failed') }}
    </div>
@endif --}}
<div class="card mt-3">
    <div class="card-body">
    </div>
</div>

<div class="container-sm mb-3 mt-3">
    <h3>
    <center>
        Selamat datang,<br>
        {{ $pelanggan->nama }}
    </center>
    </h3>
</div>

<div class="container-xl" style="max-width: 800px;">
    <form action="/pesanan/menu/storePesanan" method="POST">
    @csrf
    <div class="row row-cols-1 row-cols-md-2 g-4">
    @foreach ($menus as $menu)

    @if ($menu->jumlah != 0)

        {{-- Kolom Buat Card --}}
        <div class="col">

            {{-- card body --}}
            <div class="card mb-2" style="width: auto; margin-left: 10px; margin-right: 10px;">
                {{-- Gambar --}}
                    <div class="card" style="padding: 8px">
                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top">
                        @else
                            <img src="https://source.unsplash.com/500x150?foods" class="card-img-top" alt="..."  height="150px">
                        @endif
                    </div>

                    <div class="card">
                        <div class="card">
                            <p style="font-weight: bold; margin-left: 5px">{{ $menu->nama }}</p>
                            <p style="font-size: 15px;  margin-left: 5px" >Stok : {{ $menu->jumlah }}
                                <br>
                        @currency($menu->harga)</p>
                        </div>
                        <div class="card-footer">
                            <input class="form-check-input" type="checkbox" id="menu[]" name="menu[]" value="{{ $menu->id }}" onclick="show()">
                            <-- centang box
                            {{-- Pilih Jumlah Yang Akan Dipesan --}}
                            <select class="form-select mb-1 mt-2" id="jumlah[]" name="jumlah[]" disabled hidden required>
                                <option selected value="">Jumlah Pesanan</option>
                                @for ($i = 1; $i <= $menu->jumlah; $i++)
                                <option value={{ $i }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
            </div>
        </div>

            {{-- <div class="card" style="max-width: 540px;"> --}}

                    {{-- <div class="col-md" style="width: 200px; margin-left:90px"> --}}
                        {{-- pengecekan gambar jika ada gambar di database --}}
                        {{-- @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top">
                        </div>
                        @else
                        <img src="https://source.unsplash.com/500x500?food" class="card-img" alt="..."  height="125px">
                        @endif
                        </div>
                <div class="card-body">
                    <div class="card-body">
                        <h6 class="card-title">{{ $menu->nama }}</h6>
                        
                        <p class="card-text">Stok : {{ $menu->jumlah }}</p>
                        
                        <p class="card-text">@currency($menu->harga)</p>
                        
                    </div>
                    <div class="card-header">
                        Centang untuk memilih pesanan ->
                        <input class="form-check-input" type="checkbox" id="menu[]" name="menu[]" value="{{ $menu->id }}" onclick="show()">
                    </div>
                </div> --}}
            
                {{-- <div class="card-footer"> --}}
                    {{-- Pilih Jumlah Yang Akan Dipesan --}}
                    {{-- <select class="form-select mb-1" id="jumlah[]" name="jumlah[]" disabled hidden required>
                        <option selected value="">Jumlah Pesanan</option>
                        @for ($i = 1; $i <= $menu->jumlah; $i++)
                        <option value={{ $i }}>{{ $i }}</option>
                        @endfor
                    </select>
                    <input type="text" class="form-control" id="keterangan[]" name="keterangan[]" placeholder="Masukkan Keterangan Pesanan" disabled hidden>
                </div> --}}
            
        @else
            {{-- Kolom Buat Card --}}
            <div class="col">

                {{-- card body --}}
                <div class="card mb-2" style="width: auto; margin-left: 10px; margin-right: 10px;">
                    {{-- Gambar --}}
                        <div class="card" style="padding: 8px">
                            @if ($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top">
                            @else
                                <img src="https://source.unsplash.com/500x150?foods" class="card-img-top" alt="..."  height="150px">
                            @endif
                        </div>

                        <div class="card">
                            <div class="card">
                                <p style="font-weight: bold; margin-left: 5px">{{ $menu->nama }}</p>
                                <p style="font-size: 15px;  margin-left: 5px" class="text-danger fw-bold">Habis</p>
                            </div>
                            <div class="card-footer">
                                <input class="form-check-input" type="checkbox" id="menu[]" name="menu[]" value="{{ $menu->id }}" onclick="show()" disabled>
                                <-- centang box
                                {{-- Pilih Jumlah Yang Akan Dipesan --}}
                                <select class="form-select mb-1 mt-2" id="jumlah[]" name="jumlah[]" disabled hidden required>
                                    <option selected value="">Jumlah Pesanan</option>
                                    @for ($i = 1; $i <= $menu->jumlah; $i++)
                                    <option value={{ $i }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                </div>

            </div>
    @endif
    @endforeach
    </div>

    <nav class="navbarbot navbar fixed-bottom navbar-expand-sm navbar-dark" width=100% style="background-color: #AD3537;">
        <div class="bawah container-fluid">
            <div class="total form-group">
            </div>
            <button type="submit" class="btn btn-primary btn-outline-light me-2" style="width: 130px" name="submit" id="submit" onclick="return confirm('Yakin dengan pesanan nya?')">Pesan</button>
            <div class="total form-group">
            </div>
        </div>
    </nav>

    <div class="card mt-4">
        <div class="card-body">
        </div>
    </div>

    {{-- id pelanggan dan slug --}}
    <input type="hidden" class="form-control" id="id_Pelanggan" name="id_Pelanggan" value="{{ $pelanggan->id }}">
    <input type="hidden" class="form-control" id="slug_Pelanggan" name="slug_Pelanggan" value="{{ $pelanggan->slug }}">

    </form>
</div>
@endsection