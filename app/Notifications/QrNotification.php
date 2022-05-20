<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class QrNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private $documentUploadedData;
    public $tries = 5;

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
        $name = $this->documentUploadedData['name'];
        $codeqr = $this->documentUploadedData['qr'];
        // return (new MailMessage)
        //     ->line($this->documentUploadedData['laravel'])
        //     ->line(new HtmlString('<img src="'.$this->documentUploadedData['qr'].'" class="logo" alt="" style="width:auto; height:auto">'))
        //     ->line(new HtmlString('<p style="text-align:left; font-size:16px; color: #808080">' . $this->documentUploadedData['abbreviation'] . '</p>'))
        //     ->line(new HtmlString('<p style="text-align:left; font-size:16px; color: #808080">' . $this->documentUploadedData['name'] . '</p><br>'))
        //     ->line(new HtmlString('<p style="text-align:justify; font-size:14px; color: #808080">' . $this->documentUploadedData['salutation'] . '</p>'))
        //     ->line(new HtmlString('<p style="text-align:justify; font-size:14px; color: #808080">' . $this->documentUploadedData['body'] . '</p>'))
        //     ->line(new HtmlString('<p style="text-align:justify; font-size:14px; color: #808080">' . $this->documentUploadedData['content'] . '</p><br>'))
        //     ->action(
        //         $this->documentUploadedData['documentUploadedText'],
        //         $this->documentUploadedData['url']
        //     )
        //     ->line(new HtmlString('<p style="text-align:left; font-size:10px; color: #808080">' . $this->documentUploadedData['help'] . '</p><br>'));
        return (new MailMessage)->view('/vendor/notifications/checkinqrcode', compact('name', 'codeqr'));     
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
