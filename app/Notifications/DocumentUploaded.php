<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DocumentUploaded extends Notification implements ShouldQueue
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
        $header = '<h1 style="text-align:center; font-size:34px; color: #BD945A"">Caro & Dani</h1>
        <p style="text-align:center; font-size:20px; color: #808080">¡NOS VAMOS A CASAR!</p><br>';
        $content2 = '<br><p style="text-align:justify; font-size:14px; color: #808080">
        Su usuario de registro es su dirección de correo electrónico o su número de celular (sin código de país), no olvide tener a la mano su certificado de vacunación (.pdf o .jpg) para adjuntarlo a su confirmación de asistencia, este es un requisito importante para cuidar de todos en nuestra boda. 
        </p>
        <p style="text-align:justify; font-size:14px; color: #808080">
        Esperamos contar con su presencia,<br><br>
        Con mucho cariño<br><br>
        Caro & Dani<br><br>
        PD: cualquier consulta contactar al +593996439571<br><br>      
        </p>
        ';

        return (new MailMessage)
            // ->line(new HtmlString($header))
            ->line(new HtmlString('<p style="text-align:left; font-size:16px; color: #808080">' . $this->documentUploadedData['abbreviation'] . '</p>'))
            ->line(new HtmlString('<p style="text-align:left; font-size:16px; color: #808080">' . $this->documentUploadedData['name'] . '</p><br>'))
            ->line(new HtmlString('<p style="text-align:justify; font-size:14px; color: #808080">' . $this->documentUploadedData['salutation'] . '</p>'))
            ->line(new HtmlString('<p style="text-align:justify; font-size:14px; color: #808080">' . $this->documentUploadedData['body'] . '</p>'))
            ->line(new HtmlString('<p style="text-align:justify; font-size:14px; color: #808080">' . $this->documentUploadedData['content'] . '</p><br>'))
            ->action(
                $this->documentUploadedData['documentUploadedText'],
                $this->documentUploadedData['url']
            )
            ->line(new HtmlString($content2))
            ->line(new HtmlString('<p style="text-align:left; font-size:10px; color: #808080">' . $this->documentUploadedData['help'] . '</p><br>'))
            ->attach(public_path() . "/invitation.pdf");
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
