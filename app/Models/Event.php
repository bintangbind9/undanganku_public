<?php

namespace App\Models;

use App\Models\Event_type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['template_category_id', 'event_type_id', 'user_id', 'name', 'startdate', 'enddate', 'place', 'address', 'map'];

    public function event_type()
    {
        return $this->belongsTo(Event_type::class);
    }
}
