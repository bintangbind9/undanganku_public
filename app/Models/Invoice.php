<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'template_category_id', 'invoice_type_id', 'bank_account_id', 'code', 'expired', 'amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template_category()
    {
        return $this->belongsTo(Template_category::class);
    }

    public function invoice_type()
    {
        return $this->belongsTo(Invoice_type::class);
    }

    public function bank_account()
    {
        return $this->belongsTo(Bank_account::class);
    }

    public function invoice_payment()
    {
        return $this->hasMany(Invoice_payment::class);
    }
}
