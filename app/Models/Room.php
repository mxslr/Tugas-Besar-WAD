<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'room_id';

    protected $fillable = [
        'room_code',
        'room_name',
        'building',
        'floor',
        'capacity',
        'facilities',
        'description',
        'status',
    ];

    protected $casts = [
        'facilities' => 'array', 
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id', 'room_id');
    }
}