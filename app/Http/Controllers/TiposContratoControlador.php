<?php

namespace App\Http\Controllers;

use App\Models\ContratosModelo;
use App\Models\TiposContratoModelo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        //Validación por el método try para poder pasarlos a AJAX
        try {
            $ValidarDatos = $request->validate([
                'nombre' => 'required|unique:tipos_contratos|string|regex:/^[a-zA-Z]+(\s[a-zA-Z]+)?$/'
            ]);
        
        //Generar nuevo registro ingresando cada input a registrar
        $TipoContrato = new TiposContratoModelo();
        $TipoContrato ->nombre = $request->input('nombre');
        $TipoContrato->save();

        //Enviar mensaje de guardado exitoso
        $mensaje = [
            'success' => true,
            'message' => 'Tipo de contrato registrado exitosamente',
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
            'nombre' => 'required|string|regex:/^[a-zA-Z]+(\s[a-zA-Z]+)?$/|unique:tipos_contratos,nombre,' . $id_tipo_contrato . ',id_tipo_contrato',
        ]);

        //Método para encontrar el id y poder actualizar sus datos
        $tipos_contrato = TiposContratoModelo::find($id_tipo_contrato);
        $tipos_contrato ->nombre = $request->input('nombre');
        $tipos_contrato->save();
        flash()->addPreset('registro_guardado');

        //Método que nos direcciona a la ruta para ver los tipos de contrato
        return redirect()->route('caja.tipos_contrato.ver_tipos_contrato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_tipo_contrato)
    {
        $tipos_contrato = TiposContratoModelo::find($id_tipo_contrato);

        if ($tipos_contrato) {
            // Verificar si existen claves relacionadas en la tabla "contratos"
            $ContratosRelacion = ContratosModelo::where('id_tipo_contrato', $id_tipo_contrato)->exists();

            if ($ContratosRelacion) {
                flash()->addPreset('registro_validado');
            } else {
                $tipos_contrato->delete();
                flash()->addPreset('registro_eliminado');
            }
        } else {
            flash()->error('No se encontró el tipo de contrato que se intentó eliminar.');
        }
        return redirect()->route('caja.tipos_contrato.ver_tipos_contrato');
    }
}
