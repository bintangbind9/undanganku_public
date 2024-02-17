<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_account extends Model
{
    use HasFactory;

    protected $fillable = ['bank_func_category_id', 'bank_master_id', 'user_id', 'number', 'name', 'currency_id', 'status'];

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function bank_master()
    {
        return $this->belongsTo(Bank_master::class);
    }

    public function bank_func_category()
    {
        return $this->belongsTo(Bank_func_category::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}