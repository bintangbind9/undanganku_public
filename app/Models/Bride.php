<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bride extends Model
{
    use HasFactory;

    // protected $table = 'brides';

    protected $fillable = ['user_id', 'gender', 'name', 'nickname', 'photo', 'about', 'father', 'mother'];
}
