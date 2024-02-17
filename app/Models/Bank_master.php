<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_master extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'image'];

    public function bank_account()
    {
        return $this->hasMany(Bank_account::class);
    }
}
