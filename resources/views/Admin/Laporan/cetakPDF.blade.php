<!DOCTYPE html>
<html>
<head>
	<title>Laporan Riwayat Transaksi Kafe Angkringan Cahsaiki</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<style type="text/css">
    table tr td,
    table tr th{
        font-size: 9pt;
    }
</style>

	<center>
		<h5>Laporan Riwayat Transaksi </h5>
        <img class="mb-4" src="{{asset('style/img/logoc.png')}}" alt="" width="240" height="140">
        <h4> Kafe Angkringan Cahsaiki</h4>
		<p>{{ app('request')->input('from') }} Sampai {{ app('request')->input('to') }}</p>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>#</th>
				<th>Tanggal Transaksi</th>
				<th>Nama Pelanggan</th>
				<th>Diterima Oleh</th>
				<th>Total Harga</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($pesanans as $pesanan)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ date('d-m-Y', strtotime($pesanan->tanggal)) }}</td>
				<td>{{ $pesanan->pelanggan->nama }}</td>
				<td>{{ $pesanan->pegawai->name }}</td>
				<td>@currency($pesanan->total)</td>
			</tr>
			@endforeach
            <tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><b>@currency($total_harga)</b></td>
			</tr>
		</tbody>
	</table>

</body>
</html>