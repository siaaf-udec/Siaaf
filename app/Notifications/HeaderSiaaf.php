<?php

namespace App\Notifications;

use App\Container\Users\Src\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Notifications\Messages\BroadcastMessage;

class HeaderSiaaf extends Notification
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array
     */
    public function toDataBase()
    {
        return [
          'url' => $this->data['url'],
          'description' => $this->data['description'],
          'image' =>  $this->data['image'],
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'url' => $this->data['url'],
            'description' => $this->data['description'],
            'image' =>  $this->data['image'],
            'created_at' =>  Carbon::now()->toDateTimeString(),
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notification');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */

    public function broadcastAs()
    {
        return 'head-notify';
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
