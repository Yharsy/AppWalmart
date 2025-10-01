<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoStock extends Model
{
    protected $table = 'tb_movimientos_stock';   // tu tabla real
    public $timestamps = false;                  // pon true si tienes created_at/updated_at
    protected $fillable = ['product_id'];        // agrega los campos reales de tu tabla
    protected $primaryKey = 'product_id';        // tu clave primaria real
    protected $allowedFields = ['movement_date','qty_change','ref_type','ref_id','reason','note'];
}