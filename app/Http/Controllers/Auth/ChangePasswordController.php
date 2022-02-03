<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash as FacadesHash;

class ChangePasswordController extends Controller
{
    public function index()
    {

      return view('auth.passwords.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
          'current_password' => 'required',
          'password' => 'required|string|min:1|confirmed',
          'password_confirmation' => 'required',
        ]);

        $user = FacadesAuth::user();

         /*if (!FacadesHash::check($request->current_password, $user->password)) {
          return response()->json([
            'summary' => 'error',
            'message' => 'La contraseña dada no es correcta',
            'code' => '401',
        ], 401);
        }*/

        if (!FacadesHash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match!');
        }
        
        $user->password = FacadesHash::make($request->password);
        $user->save();

        return back()->with('success', 'Password successfully changed!');
    }

    public function changePasswordApi(Request $request)
    {
        $request->validate([
          'new_password' => 'required|string|min:1'
        ]);

        $user = FacadesAuth::user();       
        
        $user->password = FacadesHash::make($request->new_password);
        $user->save();

        return response()->json([
          'summary' => 'success',
          'code' => '200',
          'message' => 'Contraseña actualizada con éxito'
      ], 200);
    }
}