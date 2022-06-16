<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory,SoftDeletes;

    public function addresses()
    {
        return $this->morphMany(Address::class,'addressable');
    }

}
