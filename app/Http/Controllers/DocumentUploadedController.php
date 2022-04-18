<?php

namespace App\Http\Controllers;

use App\Notifications\DocumentUploaded;
use App\Notifications\WeddingInvitation;
use App\User;
use Carbon\Carbon;

class DocumentUploadedController extends Controller
{
    public function  sendDocumentUploadedNotification($id) 
    {   
        $user=User::find($id);

        $documentUploadedData = [
            'body' => 'Has recivido una notificacion de prueba',
            'documentUploadedText' => 'Se ha subido un documento',
            'url' => url('/'),
            'thankYou' => 'Aprobar o rechazar el documento'
        ];

        $user->notify(new DocumentUploaded($documentUploadedData));
    }

    public function  sendNotificationPassword($id, $email, $password, $seconds) 
    {   
        $user=User::find($id);

        $documentUploadedData = [
            'body' => 'Has recibido una notificacion de prueba',
            'documentUploadedText' => 'Su usuario es: ' . $email . ' y su contraseña es: ' . $password,
            'url' => url('/'),
            'thankYou' => 'Gracias por su atención'
        ];

        $time = Carbon::now()->addSeconds($seconds);
        $user->notify((new DocumentUploaded($documentUploadedData))->delay($time));
    }

    
    public function sendInvitation($id, $name, $surname, $abbreviation, $seconds) 
    {   
        $user=User::find($id);

        $documentUploadedData = [
            'abbreviation' => $abbreviation,
            'name' => $name . ' ' . $surname ,
            'salutation' => 'Es un honor compartir con usted la alegría de nuestro matrimonio que con la bendición de Dios y de nuestros padres, se celebrará en la Iglesia Santiago Apóstol de San José de Puembo, seguida de la recepción en la Quinta La Mirá. ',
            'body' => 'Adjunto en este correo encontrará la invitación con toda la información para acompañarnos en este día tan especial para nosotros. ',
            'content' => 'Por favor para confirmar su asistencia sírvase ingresar en la siguiente página web:',
            'documentUploadedText' => 'Confirmar asistencia',
            'url' => url('https://wedding-solvit.com/#/'),
            'help' => '** si usted recibe este correo o mensaje de texto por equivocación por favor responder al correo con el ASUNTO: EQUIVOCADO.',
        ];

        $time = Carbon::now()->addSeconds($seconds);
        $user->notify((new WeddingInvitation($documentUploadedData))->delay($time));
    }


    public function  sendNotificationApproved($id) 
    {   
        $user=User::find($id);

        $documentUploadedData = [
            'body' => 'Has recivido una notificacion de prueba',
            'documentUploadedText' => 'Se ha aprobado su documento',
            'url' => url('/'),
            'thankYou' => 'Gracias por su atención'
        ];

        $user->notify(new DocumentUploaded($documentUploadedData));
    }
    
    public function  sendNotificationDenied($id) 
    {   
        $user=User::find($id);

        $documentUploadedData = [
            'body' => 'Has recivido una notificacion de prueba',
            'documentUploadedText' => 'Se ha rechazado su documento',
            'url' => url('/'),
            'thankYou' => 'Gracias por su atención'
        ];

        $user->notify(new DocumentUploaded($documentUploadedData));
    }
    
}
