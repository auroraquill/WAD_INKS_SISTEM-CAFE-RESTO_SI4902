<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama',
    'kategori',
    'harga',
    'deskripsi',
    'foto', // ganti dari gambar ke foto sesuai kodingan form kamu
    'halal'
];
}