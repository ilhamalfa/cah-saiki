<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .container {
            width: 300px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container {
            width: 300px;
            display: flex;
        }

        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="invoice-POS">
        <div class="header" style="margin-bottom: 30px;">
            <h1>LOGO</h1>
            <h3>Kafe Angkringan Cah Saiki</h3>
            <small>
                Jl. Marrakash Square, Bahagia, Kec. Babelan, Kabupaten Bekasi, Jawa Barat 17610
            </small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>Atas Nama</li>
                    <li>No Order</li>
                    <li>Tanggal</li>
                    <li>Kasir</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> {{ $pesanan->pelanggan->nama }} </li>
                    <li> {{ $pesanan->kode }} </li>
                    <li> {{ date('Y-m-d : H:i:s', strtotime($pesanan->tanggal)) }} </li>
                    <li> {{ $pesanan->pegawai->name }} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right; width:75mm">
            <div style="text-align: left;">Menu</div>
            <div>Harga/Qty</div>
            <div>Total</div>
        </div>
        @foreach ($details as $detail)
            <div class="flex-container" style="text-align: right; width:75mm">
                <div style="text-align: left;">{{ $detail->menu->nama }} x {{ $detail->jumlah }}</div>
                <div>@currency($detail->menu->harga) </div>
                <div>@currency($detail->harga) </div>
            </div>
        @endforeach
        <hr>
        <div class="flex-container" style="text-align: right; margin-top: 10px;  width:75mm">
            <div></div>
            <div>
                <ul>
                    <li>Grand Total</li>
                    <li>Pembayaran</li>
                    <li>Kembalian</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    <li>@currency($pesanan->total) </li>
                    <li>@currency($pesanan->cash_in)</li>
                    <li>@currency($pesanan->cash_out)</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 50px;">
            <h3>**Terimakasih**</h3>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>

<style>
    #invoice-POS{
        box-shadow: 0 0 1in -0.35in rgb(0, 0, 0.5);
        padding: 2mm;
        width : 75mm;
        background: #fff;
    }

    #invoice-POS::selection{
        background: #f315f3;
        color: #fff
    }

</style>


</body>
</html>