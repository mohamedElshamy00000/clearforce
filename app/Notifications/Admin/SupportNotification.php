<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return (new MailMessage)
            ->subject($this->ticket['subject'])
            ->greeting('category : ' . $this->ticket['category'])
            ->action($this->ticket['title'], route('login'))
            ->line($this->ticket['message']);
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
            'user_id'     => $this->user['id'],
            'user_name'   => $this->user['name'],
            'user_email'  => $this->user['email'],
            'category'    => 'support-message',
            'title'       => $this->ticket['subject'],
            'description' => $this->ticket['message'],
            'link' => $this->ticket['id'],
        ];
    }
}
