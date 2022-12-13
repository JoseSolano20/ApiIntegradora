<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
    use HasFactory;
    protected $table = "branch_offices";

    protected $fillable = [
        'id',
        'name',
        'mobile',
        'email',
        'manager',
        'created',
        'modified',
        'status'
    ];

    public $timestamps = false;

    public function orders(){
        //Para relaciones de muchos a muchos
        return $this->belongsToMany(
            Orders::class, //Tabla de relación
            'offices_order', //Tabla de pivote o intersección
            'branch_offices_id', //donde
            'order_id' //hacía
        );
    }

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
