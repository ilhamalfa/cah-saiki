<!DOCTYPE html>
<html>
<head>
	<title>Laporan Riwayat Transaksi Kafe Angkringan Cahsaiki</title>
</head>
<body>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th colspan="5">RIWAYAT TRANSAKSI KAFE ANGKRINGAN CAH SAIKI</th>
			</tr>
			<tr>
				<th colspan="5">{{ app('request')->input('from') }} Sampai {{ app('request')->input('to') }}</th>
			</tr>
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
				<td>{{ $pesanan->total }}</td>
			</tr>
			@endforeach
            <tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>{{ $total_harga }}</td>
			</tr>
		</tbody>
	</table>

</body>
</html>