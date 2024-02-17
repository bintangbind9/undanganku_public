<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule_value extends Model
{
    use HasFactory;

    protected $fillable = ['template_category_id', 'rule_id', 'invoice_type_id', 'value'];

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
