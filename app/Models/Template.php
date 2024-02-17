<?php

namespace App\Models;

use App\Models\Template_category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;

    // protected $table = "templates";

    protected $fillable = ['template_category_id', 'invoice_type_id', 'name', 'photo', 'view'];

    public function template_category()
    {
        return $this->belongsTo(Template_category::class);
    }

    public function invoice_type()
    {
        return $this->belongsTo(Invoice_type::class);
    }

    public function wedding()
    {
        return $this->hasMany(Wedding::class);
    }
}