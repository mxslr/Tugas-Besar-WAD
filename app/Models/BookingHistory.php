<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    use HasFactory;

    protected $primaryKey = 'history_id';
    protected $table = 'booking_history'; 

    public $timestamps = false; 

    protected $fillable = [
        'booking_id',
        'changed_by',
        'old_status',
        'new_status',
        'notes',
        'changed_at',
    ];

    protected $dates = [
        'changed_at',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }

    public function changer()
    {
        return $this->belongsTo(User::class, 'changed_by', 'user_id');
    }
}