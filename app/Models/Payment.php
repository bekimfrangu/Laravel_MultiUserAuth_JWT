<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'provider_id',
        'amount',
        'status'
    ];

    public function pType()
    {
        return $this->belongsTo(PaymentType::class, 'type_id');
    }

    public function pProvider()
    {
        return $this->belongsTo(PaymentProvider::class, 'provider_id');
    }
}
