<?php

namespace App\Http\Controllers;

use App\Models\ContratosModelo;
use Illuminate\Http\Request;
use App\Models\TiposContratoModelo;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

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
    //Validación por el método try para poder pasarlos a AJAX
    try {

        $ValidarDatos = $request->validate([
            'nombre' => 'required|string|regex:/^[\pL\s]+$/u',
            'apellido' => 'required|string|regex:/^[\pL\s]+$/u',
            'domicilio' => 'required|unique:contratos|string|regex:/^[\pL\d\s]+$/u',
            'correo_electronico' => 'nullable|unique:contratos|email',
            'tipo_contrato' => 'required',
        ]);
        
        //Función que realiza todo de crear, obtener y guardar
        $contrato = new ContratosModelo();
        $contrato ->numero_contrato = $request->input('numero_contrato');
        $contrato ->nombre = $request->input('nombre');
        $contrato ->apellido = $request->input('apellido');
        $contrato ->domicilio = $request->input('domicilio');
        $contrato ->correo_electronico = $request->input('correo_electronico');
        $contrato ->id_tipo_contrato = $request->input('tipo_contrato');
        $contrato->fecha_vigencia = now()->toDateString();        
        $contrato ->save();

        //Enviar mensaje de guardado exitoso
        $mensaje = [
            'success' => true,
            'message' => 'Contrato registrado exitosamente',
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
        $contratos = ContratosModelo::all();
        $tipos_contratos = TiposContratoModelo::all(); 
        return view('caja.contratos.ver_contratos', ['contratos' => $contratos], ['tipos_contratos' => $tipos_contratos]);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_contrato)
    {
        $contrato = ContratosModelo::find($id_contrato);
        return view('caja.contratos.editar_contrato',['contrato' => $contrato, 'tipos_contratos' => TiposContratoModelo::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_contrato)
    {
        //Validaciones del formulario
        $request->validate([
            'numero_contrato' => 'required|numeric|unique:contratos|digits:12',
            'nombre' => 'required|string|regex:/^[a-zA-Z]+(\s[a-zA-Z]+)?$/',
            'apellido' => 'required|string|regex:/^[a-zA-Z]+(\s[a-zA-Z]+)?$/',            
            'domicilio' => 'required|string|regex:/^[a-zA-Z0-9\s]+$/',         
            'correo_electronico' => 'nullable|unique:contratos|email',
            'tipo_contrato' => 'required',
            'fecha_vigencia' => 'required|date',
        ]);
        
            

        //Método para encontrar el id y poder actualizar sus datos
        $contrato = ContratosModelo::find($id_contrato);
        $contrato ->numero_contrato = $request->input('numero_contrato');
        $contrato ->nombre = $request->input('nombre');
        $contrato ->apellido = $request->input('apellido');
        $contrato ->domicilio = $request->input('domicilio');
        $contrato ->correo_electronico = $request->input('correo_electronico');
        $contrato ->id_tipo_contrato = $request->input('tipo_contrato');
        $contrato ->fecha_vigencia = $request->input('fecha_vigencia');
        $contrato ->save();

        //Mensaje de alerta
        flash()->addPreset('registro_guardado');

        //Método que nos direcciona a la ruta para ver los contratos
        return redirect()->route('caja.contratos.ver_contratos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContratosModelo $contratosModelo)
    {
        //
    }
}
