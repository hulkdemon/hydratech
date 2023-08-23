<?php

namespace App\Http\Controllers;

use App\Models\ConceptosModelo;
use App\Models\ContratosModelo;
use Illuminate\Http\Request;

class ConceptosControlador extends Controller
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
        return view('caja.conceptos.registrar_conceptos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'descripcion' => 'required|string|regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚ]+$/u',
            'precio' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/'
        ]);

        //Función que realiza todo de crear, obtener y guardar
        $concepto = new ConceptosModelo();
        $concepto->descripcion = $request->input('descripcion');
        $concepto ->precio = $request->input('precio');
        $concepto ->save();
        flash()->addPreset('concepto');

        //Método que nos direcciona a Gestion_contratos una vez guardado
        return redirect()->route('caja.cobros.gestion_contratos');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConceptosModelo $conceptosModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConceptosModelo $conceptosModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConceptosModelo $conceptosModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConceptosModelo $conceptosModelo)
    {
        //
    }
}
