<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpes extends Model
{
    use HasFactory;

    protected $guarded = ['id']; //Tidak boleh diisi

    //menyambungkan dengan model pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    //menyambungkan dengan model menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
