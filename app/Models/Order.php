<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipper_id',
        'order_date',
        'status',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'shipper_id');
    }
}
