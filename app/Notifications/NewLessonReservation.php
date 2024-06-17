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

class NewLessonReservation extends Notification implements ShouldQueue
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
        $this->detail = $detail;
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
            // ->subject($subject)
            // ->greeting($greeting)
            ->line('You have new Lesson Reservation Booking from Student.')
            ->line('Check it out now!!.')
            ->action(route('lessonrv.show',$this->detail->id), route('lessonrv.show',$this->detail->id))
            ->line('Thank you for using our application!');
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
            'title' => 'Lesson Reservation Received',
            'body' => 'New Lesson Reservation Received from Student',
            'action_url' =>route('lessonrv.show',$this->detail->id),
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
            'title' => 'Lesson Reservation Received',
            'body' => 'New Lesson Reservation Received from Student',
            'action_url' =>url('/event/{lessonReservation}/detail'),
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
            ->title('Lesson Reservation Received')
            ->icon('/notification-icon.png')
            ->body('New Lesson Reservation Received from Student')
            ->action('View app', 'view_app')
            ->data(['id' => $notification->id]);
    }
}
