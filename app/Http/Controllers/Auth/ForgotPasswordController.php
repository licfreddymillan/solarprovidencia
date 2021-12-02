<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB; use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function reset_password(Request $request){
        $usuario = DB::table('users')
                    ->select('id', 'name')
                    ->where('email', '=', $request->email)
                    ->first();

        if (!is_null($usuario)){
            $claveTemporal = strtolower(Str::random(9));

            DB::table('users')
                ->where('id', '=', $usuario->id)
                ->update(['password' => Hash::make($claveTemporal)]);

            $data['correo'] = $request->email;
            $data['cliente'] = $usuario->name;
            $data['clave'] = $claveTemporal;

            Mail::send('emails.resetPassword',['data' => $data], function($msg) use ($data){
                $msg->to($data['correo']);
                $msg->subject('Recuperar Contraseña');
            });

            return redirect()->back()->with('msj-exitoso', 'Se ha enviado una clave temporal a su correo registrado.');

        }else{
            return redirect()->back()->with('msj-erroneo', 'El correo ingresado no se encuentra registrado.');
        }
    }
}
