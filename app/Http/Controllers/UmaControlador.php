<?php

namespace App\Http\Controllers;

use App\Models\UmaModelo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UmaControlador extends Controller
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
        $umas = UmaModelo::all();
        return view('admin.uma.registrar_uma', ['umas' => $umas]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'valor' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'fecha_aplicacion' => [
                'required',
                'date',
                // Función para obtener el año y validar
                function ($attribute, $valorAnio, $error) {
                    // Obtener el año actual
                    $añoActual = date('Y');
                    
                    // Verificar si ya existe un UMA para el año actual
                    $contarUma = UmaModelo::whereYear('fecha_aplicacion', $añoActual)->count();
                    
                    // Si ya existe un UMA para el año actual, mostrar mensaje de error
                    if ($contarUma > 0) {
                        $error('Ya se ha registrado un UMA para el año actual.');
                    }
            
                    // Obtener el año de la fecha de aplicación
                    $fechaAplicacion = Carbon::parse($valorAnio)->format('Y');
                    
                    // Verificar si la fecha de aplicación no es del año actual
                    if ($fechaAplicacion != $añoActual) {
                        $error('La fecha de aplicación debe ser del año actual ' . $añoActual);
                    }
                },
            ],
            
        ]);
        $uma = new UmaModelo();
        $uma ->valor = $request->input('valor');
        $uma ->fecha_aplicacion = $request->input('fecha_aplicacion');

        // Calcular fecha de vigencia sumando 1 año a la fecha de aplicación
        $fechaAplicacion = Carbon::parse($request->input('fecha_aplicacion'));
        $uma->fecha_vigencia = $fechaAplicacion->addYear();

        $uma->save();

        return redirect()->route('admin.uma.registrar_uma');
    }

    /**
     * Display the specified resource.
     */
    public function show(UmaModelo $umaModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UmaModelo $umaModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UmaModelo $umaModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UmaModelo $umaModelo)
    {
        //
    }
}
