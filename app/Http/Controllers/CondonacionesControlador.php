<?php

namespace App\Http\Controllers;

use App\Models\CondonacionesModelo;
use App\Models\ContratosModelo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function create()
    {
        $users = User::all();
        $contratos = ContratosModelo::all();
        return view('caja.conceptos.asignar_condonaciones', ["users"=>$users, "contratos"=>$contratos ]);       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descuento' => 'required',
            'porcentaje' => 'required',
            'inicio_vigencia' => 'required',
        ]);
        
        $condonacion = new CondonacionesModelo();
        $condonacion ->id_usuario  = $request->input('id_usuario');
        $condonacion ->id_contrato  = $request->input('id_contrato');
        $condonacion ->descuento = $request->input('descuento');
        $condonacion ->porcentaje = $request->input('porcentaje');
        $condonacion->estado = 'aprobada';
        $condonacion ->inicio_vigencia = $request->input('inicio_vigencia');

        // Calcular fecha de vigencia sumando 1 año a la fecha de aplicación
        $fechaAplicacion = Carbon::parse($request->input('inicio_vigencia'));
        $condonacion->fin_vigencia = $fechaAplicacion->addYear();

        $condonacion->save();
        flash()->addPreset('condonacion');

        return redirect()->route('caja.cobros.gestion_contratos');
    }

    /**
     * Display the specified resource.
     */
    public function show(CondonacionesModelo $condonacionesModelo)
    {
        $condonaciones = CondonacionesModelo::all();
        return view('admin.condonaciones.gestion_condonaciones', ['condonaciones' => $condonaciones]); 
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
    public function update(Request $request, CondonacionesModelo $condonacionesModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CondonacionesModelo $condonacionesModelo)
    {
        //
    }
}
