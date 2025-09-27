<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'tb_usuarios';   // tu tabla
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';


    public $timestamps = false;
   
    protected $fillable = ['name','email','password'];

    public function ventas()
{
    return $this->hasMany(Venta::class, 'user_id', 'id');
}
}