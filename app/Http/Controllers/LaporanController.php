<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Detailpes;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pesanan;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Index
    public function index(){
        $pesanan = Pesanan::where('status', 'Telah Dibayar');

        $from = request('from');
        $to = date('Y-m-d', strtotime(request('to'). ' + 1 days'));
        
        if(request('from') && request('to')){
            $pesanan = Pesanan::where('status', 'Telah Dibayar')
                    ->whereBetween('tanggal', [$from, $to]);

            $total_harga = Pesanan::where('status', 'Telah Dibayar')
                    ->whereBetween('tanggal', [$from, $to])->sum('total');
        }else{
            $total_harga = Pesanan::where('status', 'Telah Dibayar')->sum('total');
        }

        return view('Admin.Laporan.riwayat', [
            'pesanans' => $pesanan->paginate(10)->withQueryString(),
        ], compact('total_harga'));
    }

    // Export Excel
    public function exportexcel(){
        $nama_file = 'laporan_transaksi_'.date('Y-m-d_H-i-s').'.xlsx';

        $from = date('Y-m-d', strtotime(request('from')));
        $to = date('Y-m-d', strtotime(request('to'). ' + 1 days'));

        return Excel::download(new TransaksiExport($from, $to), $nama_file);
    }

    // Export PDF
    public function exportpdf(){
        $pesanans = Pesanan::where('status', 'Telah Dibayar')->get();

        $from = request('from');
        $to = date('Y-m-d', strtotime(request('to'). ' + 1 days'));
        $to2 = request('to');
        
        if(request('from') && request('to')){
            $pesanans = Pesanan::where('status', 'Telah Dibayar')
                    ->whereBetween('tanggal', [$from, $to])->get();

            $total_harga = Pesanan::where('status', 'Telah Dibayar')
                    ->whereBetween('tanggal', [$from, $to])->sum('total');
        }else{
            $total_harga = Pesanan::where('status', 'Telah Dibayar')->sum('total');
        }

        $pdf = PDF::loadView('Admin.Laporan.cetakPDF', compact('total_harga', 'pesanans'));
        return $pdf->download('Laporan_'.$from.'-'.$to2.'.pdf');
    }

    // Index
    public function test(){
        $pesanan = Pesanan::where('status', 'Telah Dibayar');

        $from = request('from');
        $to = date('Y-m-d', strtotime(request('to'). ' + 1 days'));
        
        if(request('from') && request('to')){
            $pesanan = Pesanan::where('status', 'Telah Dibayar')
                    ->whereBetween('tanggal', [$from, $to]);

            $total_harga = Pesanan::where('status', 'Telah Dibayar')
                    ->whereBetween('tanggal', [$from, $to])->sum('total');
        }else{
            $total_harga = Pesanan::where('status', 'Telah Dibayar')->sum('total');
        }

        return view('Admin.Laporan.cetakExcel', [
            'pesanans' => $pesanan,
        ], compact('total_harga'));
    }
}

