<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest_presence extends Model
{
    use HasFactory;

    protected $fillable = ['guest_id', 'presence', 'date', 'time', 'is_shown'];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
