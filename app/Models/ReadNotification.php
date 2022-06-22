<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadNotification extends Model
{
    use HasFactory;

    protected $table = 'read_notification';
    protected $fillable = [ 'read_user_id', 'notification_id' ];

    public function user()
    {
        return $this->belongsTo(User::class, 'read_user_id');
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }
}
