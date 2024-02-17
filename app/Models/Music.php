<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Music extends Model
{
    use HasFactory;

    protected $table = 'musics';

    protected $fillable = ['template_category_id', 'role_id', 'user_id', 'image', 'name', 'artist', 'description', 'path'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function wedding()
    {
        return $this->hasMany(Wedding::class);
    }
}