<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'tb_clientes';   // tu tabla real
    public $timestamps = false;         // pon true si tienes created_at/updated_at
    protected $fillable = ['id'];       // agrega los campos reales de tu tabla
    protected $primaryKey = 'id';       // tu clave primaria real
    protected $allowedFields = ['name','email','phone','address','created_at'];
}