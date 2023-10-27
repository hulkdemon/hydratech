<?php

namespace App\Http\Controllers;

use App\Models\CobrosModelo;
use App\Models\FacturasModelo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleXMLElement; 
use Illuminate\Support\Facades\Mail;

class FacturasControlador extends Controller
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
        //
    }
    
    
    public function factura($id_cobro)
    { 
        $cobros = CobrosModelo::find($id_cobro);

        // Generar el PDF a partir de la vista
        $pdf = PDF::loadView('caja.cobros.factura', ['cobros' => $cobros]);
    
        // Guarda el PDF en la ubicación deseada (storage/app/public/facturas)
        $pdfPath = 'facturas/factura_' . $id_cobro . '.pdf';
        $pdf->save(storage_path('app/public/' . $pdfPath));

        // Crea un nuevo registro en la tabla 'facturas'
        $factura = FacturasModelo::create([
            'id_contrato' => $cobros->id_contrato,
            'id_cobro' => $cobros->id_cobro,
            'ruta' => $pdfPath,
        ]);

        
        // Genera el XML
        $xmlData = [
            'id_factura' => $factura->id_factura,
            'id_contrato' => $factura->id_contrato,
            'id_cobro' => $factura->id_cobro,
        ];

        $xml = new SimpleXMLElement('<factura></factura>');
        array_walk_recursive($xmlData, [$xml, 'addChild']);

        // Guarda el XML como una cadena en el campo 'xml'
        $factura->update(['xml' => $xml->asXML()]);
        
        if (!empty($cobros->contratos->correo_electronico)) {
            // Enviar el PDF por correo electrónico y luego redirigir
            // Puedes utilizar la librería SwiftMailer para enviar correos. Ejemplo:
            $pdfFilePath = storage_path('app/public/' . $pdfPath);
    
            Mail::send('emails.factura', [], function ($message) use ($cobros, $pdfFilePath) {
                $message
                    ->to($cobros->contratos->correo_electronico)
                    ->subject('Factura')
                    ->attach($pdfFilePath, [
                        'as' => 'factura.pdf',
                        'mime' => 'application/pdf',
                    ]);
            });
    
            return view('caja.cobros.factura', ['cobros' => $cobros]);
        }

        // Devolver la vista de la factura junto con los datos
        return view('caja.cobros.factura', ['cobros' => $cobros]);
        
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
    public function show(FacturasModelo $facturasModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacturasModelo $facturasModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FacturasModelo $facturasModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacturasModelo $facturasModelo)
    {
        //
    }
}
