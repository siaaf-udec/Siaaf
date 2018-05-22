<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Notification
{
    use Queueable;

    private $token;


    /**
     * Create a new notification instance.
     *
     * @param $data
     */
    public function __construct($token)
    {
        $this->token=$token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recuperar contraseña')
            ->greeting('Hola')
            ->line('Estás recibiendo este correo porque hiciste una solicitud de recuperación de contraseña para tu cuenta.')
            ->action('Recuperar contraseña', route('password.reset', $this->token))
            ->line('Si no realizaste esta solicitud, no se requiere realizar ninguna otra acción.')
            ->salutation('Saludos, ' . config('app.name'));
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
