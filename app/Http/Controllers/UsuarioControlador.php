<?php

namespace App\Http\Controllers;

use App\Models\RolModelo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = RolModelo::all();
        return view('admin.usuarios.registrar_usuario', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validaciones del formulario
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|unique:users|email',
            'password' => 'required|string',
            'id_rol' => 'required',
        ]);
        
        //Función que realiza todo de crear, obtener y guardar
        $usuario = new User();
        $usuario ->name = $request->input('name');
        $usuario ->username = $request->input('username');
        $usuario ->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        $usuario ->id_rol = $request->input('tipo');
        $usuario ->save();

    
        //Método que nos direcciona a cursos.show una vez guardado
        return redirect()->route('admin.usuarios.ver_usuarios');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $usuarios = User::all();
        return view('admin.usuarios.ver_usuarios', ['usuarios' => $usuarios]);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.editar_usuario',['usuario' => $usuario, 'roles' => RolModelo::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Validaciones del formulario
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|unique:users|email',
            'password' => 'required|string',
            'id_rol' => 'required',
        ]);

        //Método para encontrar el id y poder actualizar sus datos
        $usuario = User::find($id);
        $usuario ->name = $request->input('name');
        $usuario ->username = $request->input('username');
        $usuario ->email = $request->input('email');
        $usuario ->password = $request->input('password');
        $usuario ->id_rol = $request->input('id_rol');        
        $usuario->save();

        //Método que nos direcciona a la ruta para ver los usuarios
        return redirect()->route('admin.usuarios.ver_usuarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios.ver_usuarios');
    }
}
