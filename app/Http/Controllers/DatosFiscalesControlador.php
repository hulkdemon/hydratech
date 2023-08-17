<?php

namespace App\Http\Controllers;

use App\Models\DatosFiscalesModelo;
use Illuminate\Http\Request;

class DatosFiscalesControlador extends Controller
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
        return view('caja.datos_fiscales.registrar_datos_fiscales');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //Función que realiza todo de crear, obtener y guardar
        $datos_fiscales = new DatosFiscalesModelo();
        $datos_fiscales->id_contrato = $request->input('id_contrato');
        $datos_fiscales ->rfc = $request->input('rfc');
        $datos_fiscales ->razon_social = $request->input('razon_social');
        $datos_fiscales ->save();
    
        //Método que nos direcciona a cursos.show una vez guardado
        return redirect()->route('caja.datos_fiscales.ver_datos_fiscales');
    }

    /**
     * Display the specified resource.
     */
    public function show(DatosFiscalesModelo $datosFiscalesModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatosFiscalesModelo $datosFiscalesModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DatosFiscalesModelo $datosFiscalesModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatosFiscalesModelo $datosFiscalesModelo)
    {
        //
    }
}
