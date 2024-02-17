<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';
    protected $fillable = ['user_id','ulasan','is_shown_on_dashboard','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}