<?php

namespace App\Http\Controllers;

use App\Models\TiposContratoModelo;
use Illuminate\Http\Request;

class TiposContratoControlador extends Controller
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
        return view('caja.tipos_contrato.registrar_tipo_contrato');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nombre' => 'required|unique:tipos_contratos|max:20|alpha'
        ]);

        $TipoContrato = new TiposContratoModelo();
        $TipoContrato ->nombre = $request->input('nombre');
        $TipoContrato->save();

        return redirect()->route('caja.tipos_contrato.ver_tipos_contrato');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $tipos_contrato = TiposContratoModelo::all();
        return view('caja.tipos_contrato.ver_tipos_contrato', ['tipos_contrato' => $tipos_contrato]);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_tipo_contrato)
    {
        $tipos_contrato = TiposContratoModelo::find($id_tipo_contrato);
        return view('caja.tipos_contrato.editar_tipos_contrato', ['tipo_contrato' => $tipos_contrato]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_tipo_contrato)
    {
        //Método para validar los datos ingresados
        $request -> validate([
            'nombre' => 'required|unique:tipos_contratos|max:20|alpha'
        ]);

        //Método para encontrar el id y poder actualizar sus datos
        $tipos_contrato = TiposContratoModelo::find($id_tipo_contrato);
        $tipos_contrato ->nombre = $request->input('nombre');
        $tipos_contrato->save();

        //Método que nos direcciona a la ruta para ver los tipos de contrato
        return redirect()->route('caja.tipos_contrato.ver_tipos_contrato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_tipo_contrato)
    {
        $tipos_contrato = TiposContratoModelo::find($id_tipo_contrato);
        $tipos_contrato->delete();

        return redirect()->route('caja.tipos_contrato.ver_tipos_contrato');
    }
}
