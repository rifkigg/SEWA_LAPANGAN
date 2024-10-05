<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'field_id',
        'status',
        'payment_status',
        'payment_method',
        'start_time',
        'end_time',
        'booking_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
