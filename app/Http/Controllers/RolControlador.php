<?php

namespace App\Http\Controllers;

use App\Models\RolModelo;
use Illuminate\Http\Request;

class RolControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.registrar_rol');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'tipo' => 'required|unique:rol|string|regex:/^[a-zA-Z]+(\s[a-zA-Z]+)?$/'
        ]);

        $rol = new RolModelo();
        $rol ->tipo = $request->input('tipo');
        $rol->save();

        return redirect()->route('admin.roles.ver_roles');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $roles = RolModelo::all();
        return view('admin.roles.ver_roles', ['roles' => $roles]);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_rol)
    {
        $roles = RolModelo::find($id_rol);
        return view('admin.roles.editar_roles', ['rol' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_rol)
    {
        //Método para validar los datos ingresados
        $request -> validate([
            'tipo' => 'required|unique:rol|max:20|alpha'
        ]);

        //Método para encontrar el id y poder actualizar sus datos
        $rol = RolModelo::find($id_rol);
        $rol ->tipo = $request->input('tipo');
        $rol->save();

        //Método que nos direcciona a la ruta para ver los roles
        return redirect()->route('admin.roles.ver_roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_rol)
    {
        $rol = RolModelo::find($id_rol);
        $rol->delete();

        return redirect()->route('admin.roles.ver_roles');
    }
}
