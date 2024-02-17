<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = ['template_category_id', 'code', 'name', 'countable', 'status'];

    public function rule_value()
    {
        return $this->hasMany(Rule_value::class);
    }

    public function template_category()
    {
        return $this->belongsTo(Template_category::class);
    }
}
