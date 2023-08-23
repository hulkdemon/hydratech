<?php

namespace App\Http\Controllers;

use App\Models\CreditosModelo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreditosControlador extends Controller
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
        return view('caja.creditos.registrar_creditos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'id_contrato' => 'required',
            'monto' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/'
        ]);

          //Función que realiza todo de crear, obtener y guardar
        $creditos = new CreditosModelo();
        $creditos->id_contrato = $request->input('id_contrato');
        $creditos ->monto = $request->input('monto');
        $creditos ->save();
        flash()->addPreset('creditos');

        //Método que nos direcciona a Gestion_contratos una vez guardado
        return redirect()->route('caja.cobros.gestion_contratos');  
    }

    /**
     * Display the specified resource.
     */
    public function show(CreditosModelo $creditosModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CreditosModelo $creditosModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CreditosModelo $creditosModelo)
    {
        //
    }
}
