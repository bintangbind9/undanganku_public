<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Greeting extends Model
{
    use HasFactory;

    protected $fillable = ['guest_id', 'date', 'greeting', 'is_shown_on_dashboard', 'status'];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
