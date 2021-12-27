<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'slug',
        'reference',
        'price',
    ];
    // 1 -> N
   public function features(){
       return $this->hasMany(Features::class);
   }
}
