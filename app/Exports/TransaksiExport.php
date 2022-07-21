<?php

namespace App\Exports;

use App\Models\Pesanan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TransaksiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function __construct(string $from , $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function view(): View
    {
        
        return view('Admin.Laporan.cetakExcel', [
            'pesanans' => Pesanan::where('status', 'Telah Dibayar')
                        ->whereBetween('tanggal', [$this->from, $this->to])->get(),
            'total_harga' => Pesanan::where('status', 'Telah Dibayar')
                        ->whereBetween('tanggal', [$this->from, $this->to])->sum('total')
        ]);
    }
}
