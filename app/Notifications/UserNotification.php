<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Log;

class UserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $event)
    {
        $this->event = $event;
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
        Log::info($this->event['full_name']);
        return (new MailMessage)
        ->greeting(Lang::get('Hello, ').$this->event['full_name'])
        ->subject(Lang::get('Customer Account Notification'))
        ->line(Lang::get('You are receiving this email because we have created an account for you.'))
        ->action(Lang::get('Access to your account'), $this->event['url'])
        ->line(Lang::get('Your account credentials :'))
        ->line(Lang::get('User: ').$this->event['email'])
        ->line(Lang::get('Password: ').$this->event['pass']);
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
