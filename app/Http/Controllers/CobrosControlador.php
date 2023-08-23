<?php

namespace App\Http\Controllers;

use App\Models\CobrosModelo;
use App\Models\ConceptosModelo;
use App\Models\CondonacionesModelo;
use App\Models\ContratosModelo;
use App\Models\CreditosModelo;
use Illuminate\Http\Request;

class CobrosControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contratos = ContratosModelo::with('condonaciones')->get();
        $conceptos = ConceptosModelo::all();
        $creditos = CreditosModelo::all();
        
        return view("caja.cobros.gestion_contratos", [
            "contratos" => $contratos,
            "conceptos" => $conceptos,
            "creditos" => $creditos,
        ]);
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CobrosModelo $cobrosModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CobrosModelo $cobrosModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CobrosModelo $cobrosModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CobrosModelo $cobrosModelo)
    {
        //
    }
}
