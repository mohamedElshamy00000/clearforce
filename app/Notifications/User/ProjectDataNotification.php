<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectDataNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $data;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
        ->subject($this->data['title'] . 'ClearForce')
        ->greeting($this->data['description'])
        ->action('login', route('login'));
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
            'category'    => 'new-project-data',
            'title'       => $this->data['title'],
            'description' => $this->data['description'],
            'link' => $this->data['uuid'],
        ];
    }
}
