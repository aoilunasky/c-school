<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentRegisterInformation extends Notification
{
    use Queueable;
    public $detail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail=$detail;
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
        ->line("{$this->detail->student->user->name} 様")
        ->line('シースクールです。')
        ->line('')
        ->line('体験レッスンのご登録ありがとうございました。')
        ->line('下記ユーザー名とパスワードをお使いになって、ログインしてください。')
        ->line('')
        ->line("ユーザー名:[{$this->detail->student->user->name}]")
        ->line("パスワード:[お客さまが決めたパスワードです。]")
        ->line('')
        ->line('こちらからログインしてください:')
        ->action('login', url('/'))
        ->line('');

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
