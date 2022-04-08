<?php

namespace App\Http\Controllers;

use App\Notifications\DocumentUploaded;
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
            'name' => $abbreviation . ' ' . $name . ' ' . $surname ,
            'salutation' => 'Tenemos el honor de invitarle a celebrar con nosotros la alegría de nuestro matrimonio que se realizará en la Iglesia Santiago Apóstol de San José de Puembo, seguida de la recepción en la Quinta La Mirá.',
            'body' => 'Con la bendición de Dios y de nuestros padres, uniremos nuestras vidas en matrimonio y le invitamos a participar de la ceremonia eclesiástica que se realizará en la Iglesia',
            'content' => 'Por favor ingresar en la siguiente página web para confirmar su asistencia y obtener todos los detalles de la boda:',
            'documentUploadedText' => 'Confirmar asistencia',
            'url' => url('https://wedding-solvit.com/#/'),
            'help' => '** si usted recibe este correo o mensaje de texto por equivocación por favor responder al correo con el ASUNTO: EQUIVOCADO.',
        ];

        $time = Carbon::now()->addSeconds($seconds);
        $user->notify((new DocumentUploaded($documentUploadedData))->delay($time));
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
