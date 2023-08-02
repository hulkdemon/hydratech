<?php

namespace App\Http\Controllers;

use App\Models\ContratosModelo;
use Illuminate\Http\Request;
use App\Models\TiposContratoModelo;

class ContratosControlador extends Controller
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
        $tipos_contratos = TiposContratoModelo::all();
        return view('caja.contratos.registrar_contrato', ['tipos_contratos' => $tipos_contratos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        //Validaciones del formulario
        $request->validate([
            'numero_contrato' => 'required|numeric|unique:contratos|digits:10',
            'nombre' => 'required|string|regex:/^[a-zA-Z]+\s[a-zA-Z]+$/',
            'apellido' => 'required|string|regex:/^[a-zA-Z]+\s[a-zA-Z]+$/',
            'domicilio' => 'required|string|regex:/^[a-zA-Z0-9\s]+$/',         
            'correo_electronico' => 'required|unique:contratos|email',
            'tipo_contrato' => 'required',
            'fecha_vigencia' => 'required|date',
        ]);
        
        //Función que realiza todo de crear, obtener y guardar
        $contrato = new ContratosModelo();
        $contrato ->numero_contrato = $request->input('numero_contrato');
        $contrato ->nombre = $request->input('nombre');
        $contrato ->apellido = $request->input('apellido');
        $contrato ->domicilio = $request->input('domicilio');
        $contrato ->correo_electronico = $request->input('correo_electronico');
        $contrato ->id_tipo_contrato = $request->input('tipo_contrato');
        $contrato ->fecha_vigencia = $request->input('fecha_vigencia');

        $contrato ->save();

    
        //Método que nos direcciona a cursos.show una vez guardado
        return redirect()->route('caja.contratos.ver_contratos');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $contratos = ContratosModelo::all();
        return view('caja.contratos.ver_contratos', ['contratos' => $contratos]);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContratosModelo $contratosModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContratosModelo $contratosModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContratosModelo $contratosModelo)
    {
        //
    }
}
