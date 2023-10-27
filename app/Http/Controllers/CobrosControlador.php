<?php

namespace App\Http\Controllers;

use App\Models\CobrosConceptoModelo;
use App\Models\CobrosModelo;
use App\Models\ConceptosModelo;
use App\Models\CondonacionesModelo;
use App\Models\ContratosModelo;
use App\Models\CreditosModelo;
use App\Models\FacturasModelo;
use App\Models\UmaModelo;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\View;
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
        $contratos_cobros = ContratosModelo::whereHas('cobros')->get();

        return view("caja.cobros.gestion_contratos", [
            "contratos" => $contratos,
            "conceptos" => $conceptos,
            "creditos" => $creditos,
            "contratos_cobros" => $contratos_cobros,
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
        ->where('estado', 'aprobada')
        ->whereDate('fin_vigencia', '>=', now())
        ->get();
    
        // Obtener las multas asociadas al usuario
        $cobros_conceptos = CobrosConceptoModelo::where('id_contrato', $contrato->id_contrato)
        ->whereHas('concepto', function ($multas) {
            $multas->where('activo', 1);
        })
        ->get();

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
        try {
        $ValidarDatos = $request->validate([
            'id_contrato' => 'required',
            'id_usuario' => 'required',
            'id_uma' => 'required',
        ]);
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
        $condonacionesTotal = $condonacionesTotal / 100;

        // Verificar si los campos de créditos, multas y condonaciones están presentes
        if ($request->has('creditos_total')) {
            $creditosTotal = $request->input('creditos_total');
        }

        if ($request->has('multas_total')) {
            $multasTotal = floatval($request->input('multas_total'));
        }
        
        if ($request->has('condonaciones_total')) {
            $condonacionesTotal = floatval($request->input('condonaciones_total'));
        }

        // Calcular el total a pagar incluyendo créditos, multas, condonaciones, etc.
        $total = $monto + $iva + $multasTotal - ($monto * ($condonacionesTotal / 100)) + ($uma_valor * 30.4);

        //Este es para poder ingresar el id_cobro al crearlo por medio de Eloquent, es importante este 
        DB::beginTransaction();

        try {
        // Crear el registro en la base de datos
        $cobro = new CobrosModelo();
        $cobro->id_contrato = $id_contrato;
        $cobro->id_usuario = $id_usuario;
        $cobro->id_uma = $id_uma;       
        $cobro->fecha_cobro = $fecha_cobro;
        $cobro->monto = $monto;
        $cobro->iva = $iva;
        $cobro->total = $total;
        
        $cobro->estado = 'activo'; 
        // Guardar el cobro sin asignar el ID
        $cobro->save();

        // Obtén el ID del cobro recién creado
        $id_cobro = $cobro->id_cobro;
        
        // Verificar si se utilizaron condonaciones
        if ($condonacionesTotal > 0) {
        // Marcar las condonaciones como utilizadas en la base de datos
        CondonacionesModelo::where('id_contrato', $id_contrato)
            ->where('estado', 'aprobada')
            ->limit($condonacionesTotal)
            ->update(['estado' => 'utilizada']);

        // Luego, asigna el ID del cobro a las condonaciones
        CondonacionesModelo::where('id_contrato', $id_contrato)
            ->where('estado', 'utilizada')
            ->limit($condonacionesTotal)
            ->update(['id_cobro' => $id_cobro]);
        }

        // Verificar si se utilizaron multas
        if ($multasTotal > 0) {
            // Obtener los IDs de los conceptos relacionados con las multas en la tabla cobrosconcepto
            $conceptoIDs = CobrosConceptoModelo::where('id_contrato', $id_contrato)
                ->whereHas('concepto', function ($activo) {
                    $activo->where('activo', 1); // Filtrar conceptos activos
                })
                ->take($multasTotal) // Tomar la cantidad adecuada de registros
                ->pluck('id_concepto'); // Obtener los IDs de los conceptos

            // Actualizar el campo 'activo' en la tabla 'conceptos'
            ConceptosModelo::whereIn('id_concepto', $conceptoIDs)
                ->update(['activo' => 0]);

            // Luego, asigna el ID del cobro a las multas en la tabla cobrosconcepto
            CobrosConceptoModelo::whereIn('id_concepto', $conceptoIDs)
                ->update(['id_cobro' => $cobro->id_cobro]); // Usar el ID del cobro recién creado
        }

        $cobro->save();
        // Commit (confirmar) la transacción
        DB::commit();
        } catch (\Exception $e) {
            // En caso de error, revertir la transacción
            DB::rollback();
            throw $e; // Puedes manejar el error según tus necesidades
        }
        // Obtener todos los créditos disponibles para el contrato
        $creditosDisponibles = CreditosModelo::where('id_contrato', $id_contrato)
        ->where('activo', 1)
        ->orderBy('id_credito')
        ->get();

        // Recorre los créditos disponibles y resta los montos utilizados al total
        foreach ($creditosDisponibles as $credito) {
        if ($credito->monto >= $total) {
            // El crédito es suficiente para cubrir el total, lo marcamos como utilizado parcialmente
            $credito->monto -= $total;
            $credito->save();
            $total = 0;
            break;
        } else {
            // El crédito no es suficiente para el total, lo marcamos como utilizado completamente
            $total -= $credito->monto;
            $credito->monto = 0;
            $credito->activo = 0;
            $credito->save();
        }
        }

        //Enviar mensaje de guardado exitoso
        $mensaje = [
            'success' => true,
            'message' => 'Cobro realizado exitosamente',
        ];
        //Si no se respeta la validación entonces que muestre excepción
        } catch (ValidationException $e) {
            $mensaje = [
                'success' => false,
                'errors' => $e->validator->getMessageBag()->toArray(),
            ];
        }
        return view('caja/cobros/generando_recibo')->with('id_cobro', $cobro->id_cobro);

    }

    /**
     * Display the specified resource.
     */
    public function show($id_contrato)
    {
        $cobros = CobrosModelo::where('id_contrato', $id_contrato)->where('estado', 'activo')->get();
        $contrato = ContratosModelo::find($id_contrato);

        return view('caja.cobros.ver_cobros', ['cobros' => $cobros, 'contrato' => $contrato]);    
    }  

    public function ver_cobros_desactivados($id_contrato)
    {
        $cobros = CobrosModelo::where('id_contrato', $id_contrato)->where('estado', 'inactivo')->get();
        $contrato = ContratosModelo::find($id_contrato);

        return view('caja.cobros.ver_cobros_desactivados', ['cobros' => $cobros, 'contrato' => $contrato]);    
    }  

    public function recibo($id_cobro)
    {
        $cobros = CobrosModelo::find($id_cobro);
        $facturaGenerada = FacturasModelo::where('id_cobro', $id_cobro)->exists();

        return view('caja.cobros.recibo', ['cobros' => $cobros, 'facturaGenerada' => $facturaGenerada]);    
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

    //Función para desactivar el cobro
    public function desactivar_cobro($id_cobro)
    {
        $cobro = CobrosModelo::find($id_cobro);
        $cobro->estado = 'inactivo';
        $cobro->save();

        return back()->with('success', 'Cobro desactivado correctamente');
        
    }

    //Función para desactivar el cobro
    public function activar_cobro($id_cobro)
    {
        $cobro = CobrosModelo::find($id_cobro);
        $cobro->estado = 'activo';
        $cobro->save();

        return back()->with('success', 'Cobro activado correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CobrosModelo $cobrosModelo)
    {
        //
    }
}
