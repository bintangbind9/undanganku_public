<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template_category extends Model
{
    use HasFactory;

    // protected $table = "template_categories";

    protected $fillable = ['name'];

    public function template()
    {
        return $this->hasMany(Template::class);
    }

    public function template_user()
    {
        return $this->hasMany(Template_user::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function rule()
    {
        return $this->hasMany(Rule::class);
    }
}
