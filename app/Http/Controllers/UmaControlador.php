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
            'fecha_aplicacion' => 'required|date',
        ]);
    
        // Obtener el año actual
        $añoActual = date('Y');
    
        // Obtener la fecha de aplicación del formulario
        $fechaAplicacion = Carbon::parse($request->input('fecha_aplicacion'));
    
        if ($fechaAplicacion->year != $añoActual) {
            flash()->addPreset('fecha_uma');
        } else {
            // Verificar si ya existe un UMA para el año actual
            $contarUma = UmaModelo::whereYear('fecha_aplicacion', $añoActual)->count();
    
            if ($contarUma > 0) {
                flash()->addPreset('error_uma');
            } else {
                $uma = new UmaModelo();
                $uma->valor = $request->input('valor');
                $uma->fecha_aplicacion = $fechaAplicacion; // Asignar la fecha de aplicación sin formato
    
                // Calcular fecha de vigencia sumando 1 año a la fecha de aplicación
                $uma->fecha_vigencia = $fechaAplicacion->copy()->addYear();
    
                $uma->save();
                flash()->addPreset('guardar_uma');
            }
        }
    
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
