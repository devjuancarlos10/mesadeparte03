<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function create()
    {
        return view('iniciarsesion');
    }

    public function store(Request $request)
    {
        // Valida las credenciales
        $request->validate([
            'correo' => 'required|email',
            'contrasenia' => 'required|min:6',
        ]);
        // Validar los datos de entrada
        $user = Usuario::where('correo', $request->correo)->first();

        if ($user && Hash::check($request->contrasenia, $user->contrasenia)) {
            // Iniciar sesión
            Auth::login($user);

            // Redirigir al usuario a la página principal o dashboard
            return response()->json(['success' => true, 'redirect' => route('welcome')]); // Redirige al dashboard
            
        }

        /* Si las credenciales son incorrectas
        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas son incorrectas.',
        ]);*/
        return response()->json(['success' => false, 'message' => 'Correo o contraseña incorrecta.'], 401);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function enviarCodigo(Request $request)
    {
        $request->validate(['correo' => 'required|email']);

        // Verificar si el correo está registrado
        $user = DB::table('usuarios')->where('correo', $request->correo)->first();
        if (!$user) {
            return back()->withErrors(['correo' => 'El correo no está registrado.']);
        }

        // Generar código de 6 dígitos
        $codigo = rand(100000, 999999);

        // Guardar el código en la base de datos (puedes usar una tabla aparte o sessions)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->correo],
            ['token' => Hash::make($codigo), 'created_at' => now()]
        );

        // Enviar correo con el código
        Mail::raw("Tu código de recuperación es: $codigo", function ($message) use ($request) {
            $message->to($request->correo)
                ->subject('Código de Recuperación');
        });

        return redirect()->route('password.code.view')->with('email', $request->correo);
    }

    public function verificarCodigo(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'codigo' => 'required|digits:6',
        ]);

        // Obtener el token guardado en la base de datos
        $resetEntry = DB::table('password_reset_tokens')->where('email', $request->correo)->first();

        if (!$resetEntry || !Hash::check($request->codigo, $resetEntry->token)) {
            return back()->with('error', 'El código es incorrecto o ha expirado.');
        }

        
        return redirect()->route('password.reset.view')->with('email', $request->correo);
    }

    public function actualizarContraseña(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contrasenia' => 'required|min:8|confirmed',
        ]);

        // Actualizar la contraseña
        DB::table('usuarios')->where('correo', $request->correo)->update([
            'contrasenia' => Hash::make($request->contrasenia),
        ]);

        // Eliminar el token de recuperación
        DB::table('password_reset_tokens')->where('email', $request->correo)->delete();

        return redirect()->route('login')->with('status', 'Contraseña actualizada correctamente.');
    }

}
