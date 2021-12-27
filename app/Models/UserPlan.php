<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'reference_transaction',

    ];
// 1 -> 1
    public function user()
    {
        return $this->belongsTo(User::class);
    }
// 1 -> N
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
