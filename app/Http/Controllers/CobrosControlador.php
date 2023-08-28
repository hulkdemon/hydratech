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
        // Obtener los datos del formulario
        $id_contrato = $request->input('id_contrato');
        $id_usuario = $request->input('id_usuario');
        $monto = $request->input('monto');
        $iva = $monto * 0.16;        
        $fecha_cobro = now();        
        $recibo_formato = $request->input('recibo_formato');
        $creditosTotal = $request->input('creditos_total');
        $multasTotal = $request->input('multas_total');
        $condonacionesTotal = $request->input('condonaciones_total');
        $uma_valor = $request->input('uma_valor');
        $id_uma = $request->input('id_uma');
        
        // Obtener el valor del UMA basado en el ID
        $uma = UmaModelo::find($id_uma);
        $uma_valor = $uma->valor;
        
        // Inicializar los valores de créditos, multas y condonaciones
        $creditosTotal = 0;
        $multasTotal = 0;
        $condonacionesTotal = 0;
        
        // Verificar si los campos de créditos, multas y condonaciones están presentes
        if ($request->has('creditos_total')) {
            $creditosTotal = $request->input('creditos_total');
        }
        
        if ($request->has('multas_total')) {
            $multasTotal = $request->input('multas_total');
        }
        
        if ($request->has('condonaciones_total')) {
            $condonacionesTotal = $request->input('condonaciones_total');
        }
        
        // Calcular el total a pagar incluyendo créditos, multas, condonaciones, etc.
        $total = $monto + $iva + $multasTotal + $condonacionesTotal + ($uma_valor * 30.4) - $creditosTotal;
        
        // Crear el registro en la base de datos
        $cobro = new CobrosModelo();
        $cobro->id_contrato = $id_contrato;
        $cobro->id_usuario = $id_usuario;
        $cobro->id_uma = $id_uma;       
        $cobro->fecha_cobro = $fecha_cobro;
        $cobro->monto = $monto;
        $cobro->iva = $iva;
        $cobro->total = $total;
        $cobro->recibo_formato = $recibo_formato;
        $cobro->estado = 'activo'; // Puedes ajustar el estado según tus requerimientos
        $cobro->save();
        
        // Retornar respuesta
        return response()->json(['success' => true, 'message' => 'Cobro registrado con éxito']);
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
