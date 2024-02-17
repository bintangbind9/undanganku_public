<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event_type extends Model
{
    use HasFactory;

    protected $fillable = ['template_category_id','name'];

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
