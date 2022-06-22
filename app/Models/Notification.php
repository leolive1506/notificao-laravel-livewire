<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $fillable = [ 'user_id', 'message', 'href' ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function readNofications()
    {
        return $this->hasMany(ReadNotification::class, 'notification_id');
    }
}
