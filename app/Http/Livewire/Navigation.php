<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use App\Models\ReadNotification;
use Livewire\Component;
use Livewire\WithPagination;

class Navigation extends Component
{
    use WithPagination;
    public $notifications;

    public function mount()
    {
        $this->getNotifications();
    }

    public function getNotifications()
    {
        $this->notifications = Notification::orderBy('id', 'desc')
            ->with(['readNofications' => function ($query) {
                $query->where('read_user_id', 1);
            }])
            ->where(function ($query) {
                $query->whereNull('user_id');
                $query->orWhere('user_id', 1);
            })
            ->get();
    }

    public function getListeners()
    {
        return ["echo:channel,.event" => 'notify'];
    }

    public function notify()
    {
        $this->getNotifications();
    }

    public function toogleRead($notificationId)
    {
        $item = ReadNotification::where(['notification_id' => $notificationId, 'read_user_id' => 1]);
        $alreadExists = $item->exists();

        if ($alreadExists) {
            $item->delete();
        } else {
            ReadNotification::create(['read_user_id' => 1, 'notification_id' => $notificationId]);
        }

        $this->getNotifications();
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
