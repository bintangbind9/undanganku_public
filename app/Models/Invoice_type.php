<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_type extends Model
{
    use HasFactory;

    protected $fillable = ['template_category_id', 'invoice_level_id', 'name', 'amount', 'expired_day', 'highlight'];

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoice_level()
    {
        return $this->belongsTo(Invoice_level::class);
    }

    public function template()
    {
        return $this->hasMany(Template::class);
    }
}
