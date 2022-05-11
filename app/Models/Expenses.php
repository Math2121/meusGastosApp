<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'photo',
        'expense_date',
        'description',
        'type',
        'amount',
    ];

    protected $dates = ['expense_date'];
    public function getAmountAttribute()
    {
        return $this->attributes['amount'] / 100;
    }

    public function setAmountAttribute($prop)
    {
        return $this->attributes['amount'] = $prop * 100;
    }

    public function setExpenseDateAttribute($prop)
    {
        return $this->attributes['expense_date'] = (DateTime::createFromFormat('d/m/Y H:i:s',$prop)->format('Y-m-d H:i:s'));
    }
    // N - > 1
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
