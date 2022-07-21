<?php

namespace App\Http\Controllers;

use App\Models\Detailpes;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use SimpleSoftwareIO\QrCode\Generator;

class PesananController extends Controller
{
    //untuk men-generate kalimat random
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // 1. ke index
    public function index(){
        return view('Customer.loginCust');
    }

    // 2. Proses menginput nama pelanggan
    public function storePelanggan(Request $request){
        $slug = SlugService::createSlug(Pelanggan::class, 'slug', $request->nama);

        //memvalidasi data pelanggan (nama)
        $validateData = $request->validate([
            'nama' => 'required | min:3'
        ]); 

        //memasukkan data slug
        $validateData['slug'] = $slug;

        //meng-create data pelanggan
        Pelanggan::create($validateData);

        //jika berhasil akan pindah ke halaman selanjutnya
        return redirect('/pesanan/menu/'. $slug )->with('success', 'Silahkan Pilih Menu Yang Akan Dipesan!');
    }

    // 3. Halaman Pilih Menu
    public function menuPesanan($slug){
        return view('Customer.menu', [
            'menus' => Menu::all(),
            'pelanggan' => Pelanggan::where('slug', $slug)->first()
        ]);
    }

    //4. proses menyimpan pesanan
    public function storePesanan(Request $request){
        // untuk menghitung hasil akhir
        $total = 0;
        $hasilAkhir = 0;
        //mengambil id pelanggan untuk digunakan sbg pencarian di tabel pesanan sesuai dengan id_pelanggan
        $id_pelanggan = $request->id_Pelanggan;

        // 1. untuk mewajibkan memilih menu
        if(empty($request->menu)){
            // kembali ke halaman pesanan
            return back()->with('failed', 'Tolong isi Pesanan');
        }else{

            // 2. inputan untuk dimasukkan ke dalam table pesanan
            $pesanan = [
                'id_pelanggan' => $id_pelanggan,
                'total' => 0,
                'status' => 'Menunggu Pembayaran',
                'kode' => $this->generateRandomString(),
                'expired' => Carbon::now()->addMinutes(30)
            ];
    
            // 3.menyimpan pesanan
            Pesanan::create($pesanan);

            //mencari id pesanan yang id pelanggannya sesuai yang mana akan dimasukkan ke dalam id_pesanandetail
            $id_pesanan = Pesanan::where('id_pelanggan', $id_pelanggan)->first();

            // 4. Memasukkan data ke Detail Pesanan
            //looping, karena menggunakan array
            foreach($request->menu as $key=>$value){
                //mencari id makanan di tabel makanan yang sesuai dengan inputan pelanggan
                $menu = Menu::where('id', $request->menu[$key])->first();
                
                        //inputan untuk dimasukkan ke dalam table pesanan detail
                        $detailPesanan = [
                            'id_pesanan' => $id_pesanan->id,
                            'id_menu' => $menu->id,
                            'jumlah' => $request->jumlah[$key],
                            'harga' => $menu->harga * $request->jumlah[$key]
                        ];
            

                //menyimpan pesanan
                Detailpes::create($detailPesanan);
    
                //untuk mengupdate jumlah makanan pada tabel makanan
                $jumlah_upd = $menu->jumlah - $request->jumlah[$key];
                
                if($jumlah_upd === 0){
                    Menu::where('id', $menu->id)->update(array('status' => 'Empty', 'jumlah' => $jumlah_upd));
                }

                Menu::where('id', $menu->id)->update(array('jumlah' => $jumlah_upd));
            }

            //menghitung total seluruh pesanan
            foreach($request->menu as $key=>$value){
                $menu = Menu::where('id', $request->menu[$key])->first();
                $total = $menu->harga*$request->jumlah[$key];
                $hasilAkhir += $total;
            }
    
            //memasukkan data lagi untuk mengupdate tabel pesanan (untuk menambahkan total harga)
            $pesanan_fix = [
                'id_pelanggan' => $id_pesanan->id_pelanggan,
                'total' => $hasilAkhir,
                'status' => $id_pesanan->status,
                'kode' => $id_pesanan->id_pelanggan . "-" . $id_pesanan->kode,
            ];
    
            //proses update data
            Pesanan::where('id', $id_pesanan->id)->update($pesanan_fix);
    
            return redirect('/menu/checkOut/'.$id_pesanan->id)->with('success', 'Berhasil Menambahkan Pesanan');
        }

    }

    public function checkOut($id){
        $qrcode = new Generator;
        $pesanan = Pesanan::where('id', $id)->first();
        $kode_pembayaran = $qrcode->size(200)->generate($pesanan->kode);

        return view('Customer.cekout', [
            'detail_pesanan' => Detailpes::where('id_pesanan', $id)->get(),
            'pesanan' => Pesanan::where('id', $id)->first(),
            'kode_pembayaran' => $kode_pembayaran
        ]);
    }
}
