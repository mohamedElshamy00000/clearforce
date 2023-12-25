<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanySendInvitationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $company;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($company, $user)
    {
        $this->company = $company;
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
        ->subject('Join the "'. $this->company->name .'" Clearforce team')
        ->greeting('Join the "'. $this->company->name .'" Clearforce team '. $this->user->name .' invited you With Clearforce')
        ->action('Accept Invite', route('login'))
        ->line('Your password is: "C#SDSRBR%33" Please change it!');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        
    }
}
