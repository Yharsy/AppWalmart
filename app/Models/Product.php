<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'TB_productos';    // nombre real
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    // Sólo tienes created_at (sin updated_at)
    public $timestamps = false;           // desactiva timestamps de Eloquent
    const CREATED_AT = 'created_at';      // opcional (informativo)

    protected $fillable = ['category_id','name','sku','price'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    


}
