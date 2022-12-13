<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = "users";

    protected $fillable = [
        'id',
        'name',
        'lastname',
        'username',
        'password',
        'created',
        'modified',
        'status'
    ];

    public $timestamps = false;


    public function offices(){
        //Para relaciones de muchos a muchos
        return $this->belongsToMany(
            Offices::class, //Tabla de relación
            'offices_user', //Tabla de pivote o intersección
            'user_id', //donde
            'branch_offices_id' //hacía
        );
    }
}
