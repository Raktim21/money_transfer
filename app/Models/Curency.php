<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curency extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function scopeSearch($query){
        
        $name = request()->search;

       return   $query->when(request()->search , function ($q) use ($name) {
                    return $q->where('name', 'like', "%$name%");
                });
    }

}
