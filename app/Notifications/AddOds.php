<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddOds extends Notification implements ShouldQueue
{
    use Queueable;

    public $id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id_ods)
    {
        $this->id = $id_ods;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/expertise/liste/'.$this->id);
        return (new MailMessage)
                    ->line('Création ODS.')
                    ->action('Voir ODS', $url)
                    ->line('Merci');
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
