<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'address',
        'latitude',
        'longitude',
        'addressable_type',
        'addressable_id',
    
    ];


    public function addresses()
    {
        return $this->morphTo(Address::class,'addressable');
    }
}
