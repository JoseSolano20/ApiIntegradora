<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'branch_offices_id'
    ];

    public $timestamps = false;

    public function office(){
        return $this->belongsTo(Offices::class, 'branch_offices_id', 'id');
    }

    public function user(){
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
