<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'description',
        'type',
        'amount',
    ];
// N - > 1 
    public function user(){
        return $this->belongsTo(User::class);
    }

}
