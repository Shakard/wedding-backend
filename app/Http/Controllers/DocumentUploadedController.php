<?php

namespace App\Http\Controllers;

use App\Notifications\DocumentUploaded;
use App\User;
use Illuminate\Http\Request;

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
