<?php

namespace App\Http\Livewire\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExemploDois implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $model;
    public $todo;
    public $field;

    public function __construct($Model, $id, $field)
    {
        $this->model = $Model;
        $this->todo = $this->model::findOrFail($id);
        $this->field = $this->todo->{$field};
    }

    // retornar os canais (channel) em que o evento deve ser transmitido
    public function broadcastOn()
    {
        // transmitiremos o evento em um canal privado vinculado ao pedido
        //     return new PrivateChannel('orders.'.$this->order->id);
        // vendo se o user esta autorizado a ouvir evento
        //     Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
        //         return $user->id === Order::findOrNew($orderId)->user_id;
        //     });
        return new Channel('new-card');
    }

    public function broadcastAs()
    {
        return 'ExemploDois';
    }

    public function broadcastWith()
    {
        return ['id' => $this->field];
    }
}
