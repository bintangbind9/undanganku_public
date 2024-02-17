<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','template_category_id','country_code_id','name','phone','presence','status'];

    public function greeting()
    {
        return $this->hasMany(Greeting::class);
    }

    public function guest_presence()
    {
        return $this->hasMany(Guest_presence::class);
    }

    public function country_code()
    {
        return $this->belongsTo(Country_code::class);
    }
}