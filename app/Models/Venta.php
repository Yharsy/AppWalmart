<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'tb_ventas';   // tu tabla real
    public $timestamps = false;       // pon true si tienes created_at/updated_at
    protected $fillable = ['user_id']; // agrega los campos reales de tu tabla
}