<?php

namespace App\Http\Controllers;

use App\Models\CobrosConceptoModelo;
use App\Models\CobrosModelo;
use App\Models\ConceptosModelo;
use App\Models\CondonacionesModelo;
use App\Models\ContratosModelo;
use App\Models\CreditosModelo;
use App\Models\UmaModelo;
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
    public function create($id_contrato)
    {
        $contrato = ContratosModelo::find($id_contrato);
        $conceptos = $contrato->conceptos;
        $creditos = $contrato->creditos;
    
        // Obtener el UMA del año actual
        $uma = UmaModelo::where('fecha_aplicacion', '<=', now())
        ->where('fecha_vigencia', '>=', now())
        ->first();

        $creditosActivos = CreditosModelo::where('id_contrato', $id_contrato)
        ->where('activo', 1)
        ->where('monto', '>', 0)
        ->get();

        // Obtener las condonaciones vigentes
        $condonacionesVigentes = CondonacionesModelo::where('id_contrato', $id_contrato)
            ->whereDate('fin_vigencia', '>=', now())
            ->get();
    
        // Obtener las multas asociadas al usuario
        $cobros_conceptos = CobrosConceptoModelo::where('id_contrato', $contrato->id_contrato)->get();
    
        return view("caja.cobros.registrar_cobro", [
            "contrato" => $contrato,
            "condonacionesVigentes" => $condonacionesVigentes,
            "conceptos" => $conceptos,
            "creditos" => $creditos,
            "uma" => $uma,
            "cobros_conceptos" => $cobros_conceptos,
            "creditosActivos" => $creditosActivos,
        ]);
        
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
