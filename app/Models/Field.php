<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name',
        'location',
        'price',
        'description',
        'owner_id',
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
