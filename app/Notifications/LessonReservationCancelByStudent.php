<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class LessonReservationCancelByStudent extends Notification implements ShouldQueue
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
        return ['mail', 'broadcast', 'database', WebPushChannel::class];
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
        ->subject("RESERVE: {$this->detail->start_time} by ({$this->detail->student->user->name})")
        ->line("{$this->detail->student->user->name} 様")
        ->line('シースクールです。')
        ->line('いつもお世話になっております。')
        ->line('')
        ->line('下記日時のご予約を受け付けました。')
        ->line("[予約ID] {$this->detail->id}")
        ->line("[講師] {$this->detail->teacher->user->name}")
        ->line("[コース] {$this->detail->subject->name}")
        ->line("[日時] {$this->detail->start_time}")
        ->line("[要望] {$this->detail->request}")
        ->line("[ズームリンク] : {$this->detail->lesson_link}")
        ->line("[スカイプID] : {$this->detail->lesson_link}")
        ->line("(受付日時: {$this->detail->start_time} - {$this->detail->end_time})")
        ->line("キャンセルされる場合は、キャンセルルールに則って下記URLよりキャンセルしていただくよ")
        ->line("うお願いいたします。")
        ->line("キャンセル期限を過ぎていたらキャンセルいたしかねます。")
        ->action(route('lessonrv.show',$this->detail->id), route('lessonrv.show',$this->detail->id))
        ->line('')
        ->line("Mr/Ms. {$this->detail->student->user->name}")
        ->line('This is from C-School.')
        ->line('Thank you so much for everything.')
        ->line('We accepted the lesson booking on the following date and time')
        ->line("[Booking ID] {$this->detail->id}")
        ->line("[Teacher] {$this->detail->teacher->user->name}")
        ->line("[Course] {$this->detail->subject->name}")
        ->line("[Date and Tim] {$this->detail->start_time}")
        ->line("[Request] {$this->detail->request}")
        ->line("[Zoom Link] : {$this->detail->lesson_link}")
        ->line("[Skype ID] : {$this->detail->lesson_link}")
        ->line("(Lesson Reservation Time: {$this->detail->start_time} - {$this->detail->end_time})")
        ->line('( If you want to cancel the lesson ) Please cancel from the following URL according to the cancellation rule. If the cancellation deadline has passed, we will not be able to cancel.')
        ->action(url("/event/".$this->detail->id."/detail"), route('lessonrv.show',$this->detail->id))
        ->line('Thank you so much for everything.');
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
            'title' => 'Lesson Reservation Cancelled',
            'body' => 'Lesson Reservation Cancelled By Student.',
            'action_url' => '/',
            'created' => Carbon::now()->toIso8601String(),
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'Lesson Reservation Cancelled',
            'body' => 'Lesson Reservation Cancelled By Student.',
            'action_url' => '/',
            'created' => Carbon::now()->toIso8601String(),
        ]);
    }
    /**
     * Get the web push representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  mixed  $notification
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Lesson Reservation Cancelled')
            ->icon('/notification-icon.png')
            ->body('Lesson Reservation Cancelled By Student.')
            ->action('View app', 'view_app')
            ->data(['id' => $notification->id]);
    }
}
