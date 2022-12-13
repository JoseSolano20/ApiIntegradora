<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_id',
        'branch_offices_id'
    ];

    public $timestamps = false;

    public function office(){
        return $this->belongsTo(Offices::class, 'branch_offices_id', 'id');
    }

    public function order(){
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }
}
