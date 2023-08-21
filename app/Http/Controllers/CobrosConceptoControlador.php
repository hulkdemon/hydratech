<?php

namespace App\Http\Controllers;

use App\Models\CobrosConceptoModelo;
use App\Models\ConceptosModelo;
use App\Models\ContratosModelo;
use Illuminate\Http\Request;

class CobrosConceptoControlador extends Controller
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
        $contratos = ContratosModelo::all();
        $conceptos = ConceptosModelo::all();
        return view('caja.conceptos.asignar_concepto', ["contratos"=>$contratos, "conceptos"=>$conceptos ]);   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'id_contrato' => 'required',
            'id_concepto' => 'required',
        ]);

        //Función que realiza todo de crear, obtener y guardar
        $CobroConcepto = new CobrosConceptoModelo();
        $CobroConcepto->id_contrato = $request->input('id_contrato');
        $CobroConcepto ->id_concepto = $request->input('id_concepto');
        $CobroConcepto ->save();
    
        //Método que nos direcciona a Gestion_contratos una vez guardado
        return redirect()->route('caja.cobros.gestion_contratos');
    }

    /**
     * Display the specified resource.
     */
    public function show(CobrosConceptoModelo $cobrosConceptoModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CobrosConceptoModelo $cobrosConceptoModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CobrosConceptoModelo $cobrosConceptoModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CobrosConceptoModelo $cobrosConceptoModelo)
    {
        //
    }
}
