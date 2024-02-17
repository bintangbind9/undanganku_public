<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_func_category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc'];

    public function bank_account()
    {
        return $this->hasMany(Bank_account::class);
    }
}
