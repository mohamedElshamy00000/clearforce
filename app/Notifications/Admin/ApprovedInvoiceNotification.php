<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApprovedInvoiceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $project;
    public $user;
    public $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project, $invoice, $user)
    {
        $this->project = $project;
        $this->invoice = $invoice;
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
        return ['mail','database'];
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
        ->subject('Invoice accepted - ClearForce')
        ->greeting('Invoice assigned No. '.$this->invoice->id.' in Project No. '.$this->project->id.' has been accepted (The amount will be transferred to you and after payment, attach proof of payment)')
        ->action('project page', route('login'));
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
            'category'    => 'invoice-accepted',
            'title'       => 'Invoice accepted',
            'description' => 'Invoice has been accepted (The amount will be transferred to you and after payment, attach proof of payment)',
            'link' => $this->project->uuid,

        ];
    }
}
