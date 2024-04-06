<?php

namespace App\Console\Commands;

use App\Models\Setting;
use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7\Utils;
use SimpleXMLElement;
use Spatie\ArrayToXml\ArrayToXml;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        //         $xmlstr = <<<XML
        // <s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
        //  <Body>
        //   <title>PHP: Behind the Parser</title>
        //   <characters>
        //    <character>
        //     <name>Ms. Coder</name>
        //     <actor>Onlivia Actora</actor>
        //    </character>
        //    <character>
        //     <name>Mr. Coder</name>
        //     <actor>El Act&#211;r</actor>
        //    </character>
        //   </characters>
        //   <plot>
        //    So, this language. It's like, a programming language. Or is it a
        //    scripting language? All is revealed in this thrilling horror spoof
        //    of a documentary.
        //   </plot>
        //   <great-lines>
        //    <line>PHP solves all my web problems</line>
        //   </great-lines>
        //   <rating type="thumbs">7</rating>
        //   <rating type="stars">5</rating>
        //  </Body>
        // </s:Envelope>
        // XML;

        //             $xml = new SimpleXMLElement($xmlstr, LIBXML_NOERROR, false);
        //             dd($xml->Body);


        // $xmlString =
        // '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"><s:Header><Infolog xmlns="http://schemas.microsoft.com/dynamics/2013/01/datacontracts" xmlns:i="http://www.w3.org/2001/XMLSchema-instance"><Entries/></Infolog></s:Header><s:Body><getRuterosResponse xmlns="http://tempuri.org"><result xmlns:a="http://schemas.datacontract.org/2004/07/Dynamics.AX.Application" xmlns:i="http://www.w3.org/2001/XMLSchema-instance"><a:getRuterosResult><a:ListRuteros><a:Detail><a:ListDetailsRuteros><a:AccountNum>901703447</a:AccountNum><a:Address>%1 110111 Bogotá, Bogotá, D.C. CL 71P 27L 16 SUR</a:Address><a:Balance>0</a:Balance><a:City>11001</a:City><a:CountyId>11001</a:CountyId><a:CustRuteroID>1012402021050161</a:CustRuteroID><a:CustStatus>No</a:CustStatus><a:DTCCustType>Papelería</a:DTCCustType><a:District/><a:Email>NO TIENE CORREO</a:Email><a:IdentificationNum>901703447</a:IdentificationNum><a:LineDisc/><a:Locked>No</a:Locked><a:ModifiedVendor/><a:Name>TIENDAS LA 30 EC SAS</a:Name><a:NoCompraId/><a:Orden>1</a:Orden><a:Phone>3208347122</a:Phone><a:PhoneMobile/><a:PriceGroup>TATNAC</a:PriceGroup><a:QuotaValue>0</a:QuotaValue><a:RazonSocial>TIENDAS LA 30 EC SAS</a:RazonSocial><a:TaxGroup>C_NAL</a:TaxGroup><a:TermsPayment/><a:Track/><a:TypeCustomer>Contado</a:TypeCustomer><a:Whatsapp>0</a:Whatsapp></a:ListDetailsRuteros></a:Detail><a:DiaRecorrido>1- Lunes</a:DiaRecorrido><a:Route>1301</a:Route><a:Zona>101</a:Zona></a:ListRuteros></a:getRuterosResult></result></getRuterosResponse></s:Body></s:Envelope>';

        // //replace 
       

        // $array = json_decode(json_encode($xml)); // Convert SimpleXML object to array

        




        $body = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:dat="http://schemas.microsoft.com/dynamics/2013/01/datacontracts" xmlns:tem="http://tempuri.org" xmlns:dyn="http://schemas.datacontract.org/2004/07/Dynamics.AX.Application">
            <soapenv:Header>
                <dat:CallContext>
                    <!--Optional:-->
                    <dat:Company>TRX</dat:Company>
                    
                    <!--Optional:-->
                </dat:CallContext>
            </soapenv:Header>
            <soapenv:Body>
                <tem:getRuteros>
                    <!--Optional:-->
                    <tem:_getRuteros>
                        <!--Optional:-->
                        <dyn:IdentificationNum>901703447</dyn:IdentificationNum>
                        <!--Optional:-->
                        <dyn:ruteroId></dyn:ruteroId>
                        <!--Optional:-->
                        <dyn:zona></dyn:zona>
                    </tem:_getRuteros>
                </tem:getRuteros>
            </soapenv:Body>
            </soapenv:Envelope>';

        $token = Setting::getByKey('microsoft_token');  
      
        $response = Http::withHeaders([
            'Content-Type' => 'text/xml;charset=UTF-8',
            'SOAPAction' => 'http://tempuri.org/DWSSalesForce/getRuteros',
            'Authorization' => "Bearer {$token}"
        ])
        ->send('POST', 'https://uattrx.sandbox.operations.dynamics.com/soap/services/DIITDWSSalesForceGroup?=null', [
            'body' => $body
        ]);

        $data = $response->body();
        $xmlString = preg_replace('/<(\/)?(s|a):/', '<$1$2', $data);
        $xml = simplexml_load_string($xmlString);
        dd($xml->sBody);
        
      
    }
}
