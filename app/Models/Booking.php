<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'user_id',
        'room_id',
        'subject',
        'lecturer_name',
        'booking_date',
        'start_time',
        'end_time',
        'participants',
        'purpose',
        'status',
        'approved_by',
        'approved_at',
        'rejection_reason',
    ];

    protected $dates = [
        'booking_date',
        'approved_at',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by', 'user_id');
    }

    public function history()
    {
        return $this->hasMany(BookingHistory::class, 'booking_id', 'booking_id');
    }
}