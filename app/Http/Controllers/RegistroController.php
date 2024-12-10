<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class RegistroController extends Controller
{
    public function mostrarCorreo()
    {
        return view('correo');
    }

        // En el controlador:
    public function verificarCorreo(Request $request)
    {
        $correo = $request->input('correo');

        // Verificar si el correo ya está registrado en la base de datos
        $existe = Usuario::where('correo', $correo)->exists();

        return response()->json([
            'existe' => $existe,
            'mensaje' => $existe ? 'Correo ya registrado' : 'Correo válido'
        ]);
    }

    public function enviarCodigo(Request $request)
    {
        
        $request->validate([
            'correo' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@uncp\.edu\.pe$/'],
        ], [
            'correo.regex' => 'El correo debe pertenecer al dominio @uncp.edu.pe.',
        ]);

        $codigo = rand(100000, 999999);
        session(['codigo' => $codigo, 'correo' => $request->correo, 'codigo_expiracion' => now()->addSeconds(60)]);
        

        // Enviar correo con el código
        Mail::send([], [], function ($message) use ($request, $codigo) {
            $message->to($request->correo)
                ->subject('Código de Verificación')
                ->html("Tu código de verificación es: <strong>$codigo</strong>");
        });
        

        return redirect()->route('verificar.codigo');
    }

    public function mostrarCodigo()
    {
        return view('codigo');
    }

    public function verificarCodigo(Request $request)
    {
        // Asegúrate de que el código se reciba como un array de 6 dígitos
        $request->validate([
            'codigo' => 'required|array|min:6|max:6',  // El código debe ser un arreglo con 6 elementos
            'codigo.*' => 'required|digits:1',  // Cada campo del código debe ser un dígito
        ]);

        // Convierte el array de códigos en un solo string
        $codigoIngresado = implode('', $request->codigo);
        $codigoExpiracion = session('codigo_expiracion');
        // Compara con el código guardado en la sesión
        if(now()->greaterThan($codigoExpiracion)){
            return response()->json([
                'success' => false, 
                'message' => 'Código incorrecto o expirado.'
            ]);
        }else{
            if ($codigoIngresado == session('codigo')) {
                return response()->json([
                    'success' => true,
                    'message' => 'Código validado correctamente.',
                    'redirect' => route('registro.datos') // Incluye la URL de redirección
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'El código es incorrecto.'
                ]);
            }
        
        }
        
    }


    public function mostrarDatos()
    {
        return view('datos');
    }

    public function guardarDatos(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'fechaNacimiento' => 'required|date',
            'genero' => 'required',
        ]);

        session($request->only(['nombres', 'apellidos', 'fechaNacimiento', 'genero']));
        return redirect()->route('crear.contrasenia');
    }

    public function mostrarContrasenia()
    {
        return view('contrasenia');
    }

    public function crearCuenta(Request $request)
    {
        $request->validate([
            'contrasenia' => 'required|min:6|confirmed',
        ]);

        $usuario = Usuario::create([
            'nombres' => session('nombres'),
            'apellidos' => session('apellidos'),
            'correo' => session('correo'),
            'contrasenia' => Hash::make($request->contrasenia),
            'fechaNacimiento' => session('fechaNacimiento'),
            'genero' => session('genero'),
            'rol' => 3,
        ]);


        Auth::login($usuario);

        return redirect()->route('welcome');
    }


}
