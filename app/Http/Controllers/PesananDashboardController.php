<?php

namespace App\Http\Controllers;

use App\Models\Detailpes;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;

use function PHPUnit\Framework\returnSelf;

class PesananDashboardController extends Controller
{
    // 1. index ke dashboard pesanan
    public function index(){

        return view('Admin.pesanan.pesanan', [
            'pesanans' => Pesanan::latest()->filter(request(['search', 'status']))->paginate(10)->withQueryString()
        ]);
    }

    // 2. Detail Pesanan
    public function detail($id){
        return view('Admin.pesanan.detail', [
            'pesanan' => Pesanan::where('id', $id)->first(),
            'detpes' => Detailpes::where('id_pesanan', $id)->get()
        ]);
    }

    // 3. Menerima Pesanan
    public function konfirmasi($id, Request $request){
        $pesanan = Pesanan::where('id', $id)->first();
        
        if($request->input('cashIn') >= $pesanan->total){
            Pesanan::where('id', $id)->update(array(
                'status' => 'Telah Dibayar',
                'cash_in' => $request->input('cashIn'),
                'cash_out' => $request->input('cashIn') - $pesanan->total,
                'id_pegawai' => auth()->user()->id
            ));

            return back()->with('success', 'Transaksi Telah Selesai!');
        }else{
            return back()->with('failed', 'Transaksi Gagal, Dana Tidak Mencukupi!');
        }
    }

    // 3. Membatalkan Pesanan
    public function batal($id){
        $details = Detailpes::where('id_pesanan', $id)->get();

        foreach($details as $detail){
            $menu = Menu::where('id', $detail->id_menu)->first();

            // echo $menu->nama . '<br>';
            Menu::where('id', $detail->id_menu)->update(array(
                'jumlah' => $menu->jumlah + $detail->jumlah,
                'status' => 'Belum Habis'
            ));
        }

        Pesanan::where('id', $id)->update(array(
            'status' => 'Pesanan Dibatalkan'
        ));

        return back()->with('success', 'Transaksi Dibatalkan!');
    }

    // 4. Cetak Invoice 
    public function invoice($id){
        
        return view('Admin.pesanan.invoice', [
            'pesanan' => Pesanan::where('id', $id)->first(),
            'details' =>Detailpes::where('id_pesanan', $id)->get()
        ]);
    }
}
