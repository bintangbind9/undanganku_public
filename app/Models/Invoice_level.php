<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_level extends Model
{
    use HasFactory;

    protected $fillable = ['level', 'name', 'image'];

    public function invoice_type()
    {
        return $this->hasMany(Invoice_type::class);
    }
}
