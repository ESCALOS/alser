<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ComplaintBook extends Notification implements ShouldQueue
{
    use Queueable;

    private $filePath;

    /**
     * Create a new notification instance.
     */
    public function __construct($filePath = '')
    {
        $this->filePath = $filePath;
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->attach($this->filePath)
            ->line('Se le hace llegar la copia de su reclamo')
            ->action('Alser Cambio', url('/'))
            ->line('Gracias por usar nuestros servicios!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
