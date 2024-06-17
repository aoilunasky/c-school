<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class AcceptLessonCancelToStudent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $message, $detail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail = $detail;
        
        $this->message = (new MailMessage)
            ->line("{$detail->student->user->name} 様")
            ->line('シースクールです。')
            ->line('いつもお世話になっております。')
            ->line(' ')
            ->line('下記日時のご予約のキャンセルを受け付けました。')
            ->line("[予約ID] {$detail->id}")
            ->line("[講師] {$detail->teacher->user->name}")
            ->line("[コース] {$detail->subject->name}")
            ->line("[日時] {$detail->start_time}")
            ->line("[要望] {$detail->request}")
            ->line("[ズームリンク] : {$detail->lesson_link}")
            ->line("[スカイプID] : {$detail->lesson_link}")
            ->line("(受付日時: {$detail->start_time} - {$detail->end_time})")
            ->line(' ')
            ->line("Mr/Ms. {$detail->student->user->name}")
            ->line('This is from C-School.')
            ->line('Thank you so much for everything.')
            ->line('We accepted the cancellation of the following date and time booking lesson.')
            ->line("[Booking ID] {$detail->id}")
            ->line("[Teacher] {$detail->teacher->user->name}")
            ->line("[Course] {$detail->subject->name}")
            ->line("[Date and Tim] {$detail->start_time}")
            ->line("[Request] {$detail->request}")
            ->line("[Zoom Link] : {$detail->lesson_link}")
            ->line("[Skype ID] : {$detail->lesson_link}")
            ->line("(Lesson Reservation Time: {$detail->start_time} - {$detail->end_time})");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.notifications.email', $this->message->data())
        ->subject("Lesson Cancel: {$this->detail->start_time} by ({$this->detail->student->user->name})");
    }
}
