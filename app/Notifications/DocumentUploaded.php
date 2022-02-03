<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentUploaded extends Notification
{
    use Queueable;
    private $documentUploadedData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($documentUploadedData)
    {
        $this->documentUploadedData = $documentUploadedData;
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
                    ->line($this->documentUploadedData['body'])
                    ->action($this->documentUploadedData['documentUploadedText'],
                     $this->documentUploadedData['url'])
                    ->line($this->documentUploadedData['thankYou']);
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
