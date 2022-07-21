<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    
    protected $guarded = ['id']; //Tidak boleh diisi

    //pencarian
    public function scopeFilter($query, array $filters){
        //jika sesuatu yang dicari ada di kolom pencarian , tambahkan query ke variabel pesanan
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('kode', 'like', '%' . $search . '%')
            ->orWhereHas('pelanggan', function($query) use($search){
                $query->where('nama', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['status'] ?? false, function($query, $status) {
            return $query->where('status', $status);
        });
    }

    //menyambungkan ke model/data base pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_pegawai');
    }
}
