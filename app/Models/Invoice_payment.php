<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_payment extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'date', 'amount', 'attachment', 'is_confirmed'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
