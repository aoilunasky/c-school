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

class TeacherWarning extends Notification implements ShouldQueue
{
    use Queueable;

    public $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
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
                    ->subject('警告書 / Warning Letter')
                    ->line('警告書')
                    ->line($this->name.' 〇〇様')
                    ->line('弊社のルールを破る行為を行ったことにより、警告書を送らせていただきました。')
                    ->line('今後、ルールに則って、秩序ある行動をしていただくよう、強く願います。')
                    ->line('この警告書は、ルール違反発見後、2回まで送られることになり、3回目以降、')
                    ->line('アカウントは凍結され、このシステムを使えなくなります。')
                    ->line('添付されている警告書に、違反行為の理由と、その対策を書き、アドミンまで送ってください。')
                    ->line('今後同じような過ちが起きないように切にお願いいたします。')
                    ->line('Warning Letter')
                    ->line('Mr/Ms. '.$this->name)
                    ->line('We have sent you a warning letter for violating our rules. We strongly request that you act in an orderly manner in accordance with the rules.')
                    ->line('This warning will be sent up to twice after the rule violation is found, and after the third time, Your account will be frozen and you will no longer be able to use this system.')
                    ->line('Please write down the reason for the violation and the countermeasures in the attached warning letter and send it to Admin. Please do not make similar mistakes in the future.')
                    ->attach(public_path("files/warning_letter.pdf"), [
                        'as' => 'WarningLetter.pdf',
                        'mime' => 'application/pdf',
                    ]);
                    // ->line('Thank you for using our application!');
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
            'title' => 'Warning!!',
            'body' => 'Admin send Warning Letter for your absence.',
            'action_url' => '',
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
            'title' => 'Warning!!',
            'body' => 'Admin send Warning Letter for your absence.',
            'action_url' => '',
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
            ->title('Warning!!')
            ->icon('/notification-icon.png')
            ->body('Admin send Warning Letter for your absence.')
            ->data(['id' => $notification->id]);
    }
}
