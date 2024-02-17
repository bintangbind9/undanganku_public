<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template_user extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'template_category_id', 'user_url', 'message_guest', 'is_greeting_auto_approved', 'status'];

    public function template_category()
    {
        return $this->belongsTo(Template_category::class);
    }
}
