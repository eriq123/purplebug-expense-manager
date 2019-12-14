<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';

    // Amount
    public function getAmountAttribute($Amount)
    {
        return $Amount / 100;
    }

    public function setAmountAttribute($Amount)
    {
        $this->attributes['Amount'] = $Amount * 100;
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d'); 
    }
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
