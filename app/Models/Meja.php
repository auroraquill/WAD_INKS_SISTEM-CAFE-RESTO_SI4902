<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'meja_264';
    public $timestamps = false;

    protected $fillable = ['nomor_meja', 'kapasitas', 'zonasi', 'status'];
}