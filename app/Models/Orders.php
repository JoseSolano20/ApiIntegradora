<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        'id',
        'number',
        'start_date',
        'end_date',
        'comments',
        'amount',
        'created',
        'modified',
        'status'
    ];

    public $timestamps = false;

    public function products(){
        //Para relaciones de muchos a muchos
        return $this->belongsToMany(
            Products::class, //Tabla de relación
            'order_product', //Tabla de pivote o intersección
            'order_id', //donde
            'product_id' //hacía
        );
    }
}
