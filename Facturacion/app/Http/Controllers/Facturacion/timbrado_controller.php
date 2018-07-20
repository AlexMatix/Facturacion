<?php

namespace App\Http\Controllers\Facturacion;

use App\Http\Controllers\apicontroller;
use SoapClient;

class timbrado_controller extends apicontroller
{
    public function timbra_cdfi(){
        $ws = "https://cfdi33-pruebas.buzoncfdi.mx:1443/Timbrado.asmx?wsdl"; /* RUTA PARA EL SERVICIO DE PRUEBAS*/
        $response = '';
        $workspace="/home/dylan/Descargas/Kit-PHP-CFDI3.3/Kit-PHP-CFDI3.3/ArchivosPrueba/ArchivosservicioIntegracionTimbrado/";
        $rutaArchivo = $workspace.'comprobanteSinTimbrar.xml';
        $base64Comprobante = file_get_contents($rutaArchivo);
        $base64Comprobante = base64_encode($base64Comprobante);
        try
        {
            $params = array();
            $params['usuarioIntegrador'] = 'mvpNUXmQfK8=';
            /* Comprobante en base 64*/
            $params['xmlComprobanteBase64'] = $base64Comprobante;
            $params['idComprobante'] = rand(5, 999999);

            $context = stream_context_create(array(
                'ssl' => array(
                    // set some SSL/TLS specific options
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => false
                ),
                'http' => array(
                    'user_agent' => 'PHPSoapClient'
                )
            ) );
            $options =array();
            $options['stream_context'] = $context;
            $options['cache_wsdl']= WSDL_CACHE_MEMORY;
            $options['trace']= true;

            libxml_disable_entity_loader(false);
            print_r("SoapClient ");

            $client = new SoapClient($ws,$options);
            print_r("__soapCall ");
            $response = $client->__soapCall('TimbraCFDI', array('parameters' => $params));

        }
        catch (SoapFault $fault)
        {
            print_r("SOAPFault: ".$fault->faultcode."-".$fault->faultstring."\n");

        }
        /*Obtenemos resultado del response*/
        print_r("resultado");
        //echo $response;
        $tipoExcepcion = $response->TimbraCFDIResult->anyType[0];
        $numeroExcepcion = $response->TimbraCFDIResult->anyType[1];
        $descripcionResultado = $response->TimbraCFDIResult->anyType[2];
        $xmlTimbrado = $response->TimbraCFDIResult->anyType[3];
        $codigoQr = $response->TimbraCFDIResult->anyType[4];
        $cadenaOriginal = $response->TimbraCFDIResult->anyType[5];
        $errorInterno = $response->TimbraCFDIResult->anyType[6];
        $mensajeInterno = $response->TimbraCFDIResult->anyType[7];
        $detalleError = $response->TimbraCFDIResult->anyType[8];

        if($xmlTimbrado != '')
        {
            print_r("xmlTimbrado");
            /*El comprobante fue timbrado correctamente*/

            /*Guardamos comprobante timbrado*/
            file_put_contents($workspace.'comprobanteTimbrado.xml', $xmlTimbrado);

            /*Guardamos codigo qr*/
            file_put_contents($workspace.'codigoQr.jpg', $codigoQr);

            /*Guardamos cadena original del complemento de certificacion del SAT*/
            file_put_contents($workspace.'cadenaOriginal.txt', $cadenaOriginal);

            print_r("Timbrado exitoso");

        }
        else
        {
            print_r("else ");
            print_r("[".$tipoExcepcion."  ".$numeroExcepcion." ".$descripcionResultado."  ei=".$errorInterno." mi=".$mensajeInterno."]") ;
        }
    }
}
