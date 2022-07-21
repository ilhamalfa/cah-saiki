<?php

namespace App\Console\Commands;

use App\Models\Detailpes;
use App\Models\Menu;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BatalBayar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bayar:batal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 0;

        $pesanan = Pesanan::where('status', 'Menunggu Pembayaran')
                            ->where('expired', '<', Carbon::now())
                            ->first();
        
        $details = Detailpes::where('id_pesanan', $pesanan->id)->get();

        foreach($details as $detail){
            $menu = Menu::where('id', $detail->id_menu)->first();

            Menu::where('id', $detail->id_menu)->update(array(
                'jumlah' => $menu->jumlah + $detail->jumlah,
                'status' => 'Belum Habis'
            ));
        }

        Pesanan::where('id', $pesanan->id)->update(array(
            'status' => 'Pesanan Dibatalkan'
        ));

        echo "Pesanan oleh ". $pesanan->pelanggan->nama ." Dibatalkan Otomatis!";
    }

    // Untuk mengaktifkan scheduler php artisan schedule:work
}
