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
        ->greeting(Lang::get('مرحبا, ').$this->event['full_name'])
        ->subject('منظومة متابعة الصفقات العمومية : جامعة جندوبة')
        ->line(Lang::get('يسعدنا إعلامكم بإنشاء حساب خاص بكم لمتابعة ملفات الصفقات العمومية لفائدة جامعة جندوبة'))
        ->action(Lang::get('الرجاء النقر على الرابط للدخول للمنظومة'), $this->event['url'])
        ->line(Lang::get('معلومات الحساب '))
        ->line($this->event['email'].Lang::get(' :المستعمل'))
        ->line($this->event['pass'].Lang::get(' :كلمة العبور'));
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
