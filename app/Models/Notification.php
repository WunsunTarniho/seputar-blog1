<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function notificationReads(){
        return $this->hasMany(NotificationRead::class);
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function causer()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
