<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'template_id', 'photo_sampul', 'music_id'];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function music()
    {
        return $this->belongsTo(Music::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}