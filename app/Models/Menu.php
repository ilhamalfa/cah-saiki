<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id']; //Tidak boleh diisi

    public function detailpes()
    {
        //satu menu bisa aja dimiliki oleh banyak Detail pesanan
        return $this->hasMany(Detailpes::class);
    }
}
