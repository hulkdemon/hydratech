<?php

namespace App\Http\Controllers;

use App\Models\ConceptosModelo;
use App\Models\CondonacionesModelo;
use App\Models\ContratosModelo;
use App\Models\CreditosModelo;
use App\Models\RolModelo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class CondonacionesControlador extends Controller
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
    public function asignar_condonaciones()
    {
        $users = User::all();
        $contratos = ContratosModelo::all();
        return view('admin.condonaciones.asignar_condonaciones', ["users"=>$users, "contratos"=>$contratos ]);       
    }

    public function solicitar_condonaciones()
    {
        $users = User::all();
        $contratos = ContratosModelo::all();
        return view('caja.conceptos.asignar_condonaciones', ["users"=>$users, "contratos"=>$contratos ]);       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function registrar_condonacion(Request $request)
    {
        try {
            $ValidarDatos = $request->validate([            
            'id_usuario' => 'required',
            'id_contrato' => 'required',
            'descuento' => 'required|numeric',
            'porcentaje' => 'required|numeric|between:0,100',
            'motivo' => 'required|string|regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚ]+$/u',
        ]);
        
        $condonacion = new CondonacionesModelo();
        $condonacion ->id_usuario  = $request->input('id_usuario');
        $condonacion ->id_contrato  = $request->input('id_contrato');
        $condonacion ->descuento = $request->input('descuento');
        $condonacion ->porcentaje = $request->input('porcentaje');
        $condonacion ->motivo = $request->input('motivo');
        $condonacion->estado = 'aprobada';
        $condonacion->inicio_vigencia = now()->toDateString();

        // Calcular fecha de vigencia sumando 1 año a la fecha de aplicación
        $fechaActual = now();
        $condonacion->fin_vigencia = $fechaActual->addYear();
        $condonacion->save();
        
        //Enviar mensaje de guardado exitoso
        $mensaje = [
            'success' => true,
            'message' => 'Condonación asignada correctamente',
        ];
         //Si no se respeta la validación entonces que muestre excepción
        } catch (ValidationException $e) {
            $mensaje = [
                'success' => false,
                'errors' => $e->validator->getMessageBag()->toArray(),
            ];
        }
        return response()->json($mensaje);
    }

    public function guardar_condonacion_solicitada(Request $request)
    {
        $request->validate([
            'descuento' => 'required|numeric',
            'porcentaje' => 'required|numeric|between:0,100',
            'motivo' => 'required|string|regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚ]+$/u',
        ]);
        
        $condonacion_solicitar = new CondonacionesModelo();
        $condonacion_solicitar ->id_usuario  = $request->input('id_usuario');
        $condonacion_solicitar ->id_contrato  = $request->input('id_contrato');
        $condonacion_solicitar ->descuento = $request->input('descuento');
        $condonacion_solicitar ->porcentaje = $request->input('porcentaje');
        $condonacion_solicitar ->motivo = $request->input('motivo');
        $condonacion_solicitar->inicio_vigencia = now()->toDateString();

        // Calcular fecha de vigencia sumando 1 año a la fecha de aplicación
        $fechaActual = now();
        $condonacion_solicitar->fin_vigencia = $fechaActual->addYear();

        $condonacion_solicitar->save();
        flash()->addPreset('condonacion_solicitada');

        return redirect()->route('caja.cobros.gestion_contratos');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $condonaciones = CondonacionesModelo::with('usuarios.rol')->get();

        $condonacionesPendientes = $condonaciones->where('estado', 'pendiente')->count();
        
        return view('admin.condonaciones.gestion_condonaciones', [
            'condonaciones' => $condonaciones,
            'condonacionesPendientes' => $condonacionesPendientes,
        ]);
    }

    public function gestion_contratos()
    {
        $contratos = ContratosModelo::with('condonaciones')->get();
        $conceptos = ConceptosModelo::all();
        $creditos = CreditosModelo::all();
        
        return view("admin.condonaciones.gestion_contratos", [
            "contratos" => $contratos,
            "conceptos" => $conceptos,
            "creditos" => $creditos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CondonacionesModelo $condonacionesModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function aceptar_condonacion($id_condonacion)
    {
        $condonacion = CondonacionesModelo::find($id_condonacion);
        $condonacion->estado = "aprobada";
        $condonacion->save();

        flash()->addPreset('condonacion_aceptada');
        return redirect()->route('admin.condonaciones.gestion_condonaciones');
    }

    public function rechazar_condonacion($id_condonacion)
    {
        $condonacion = CondonacionesModelo::find($id_condonacion);
        $condonacion->estado = "rechazada";
        $condonacion->save();

        flash()->addPreset('condonacion_rechazada');
        return redirect()->route('admin.condonaciones.gestion_condonaciones');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CondonacionesModelo $condonacionesModelo)
    {
        //
    }
}
