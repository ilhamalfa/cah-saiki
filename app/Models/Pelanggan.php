<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Pelanggan extends Model
{
    use HasFactory;

    use Sluggable;

    protected $guarded = ['id']; //Tidak boleh diisi

    public function pesanan()
    {
        //satu makanan bisa aja dimiliki oleh banyak detail pesanan
        return $this->hasMany(Pesanan::class);
    }

    //Sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }
}
