<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class UserRepository
{
    public static function presalesOrder($order)
    {   
        
        //901703447
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
                        <dyn:IdentificationNum>' . $document . '</dyn:IdentificationNum>
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
        ])->send('POST', 'https://uattrx.sandbox.operations.dynamics.com/soap/services/DIITDWSSalesForceGroup?=null', [
            'body' => $body
        ]);

        $data = $response->body();
        $xmlString = preg_replace('/<(\/)?(s|a):/', '<$1$2', $data);
        $xml = simplexml_load_string($xmlString);

        $aListRuteros = $xml->sBody->getRuterosResponse->result->agetRuterosResult->aListRuteros;

        if ($aListRuteros->aRoute) {

            $zone = $aListRuteros->aRoute->__toString();
            $route = $aListRuteros->aZona->__toString();
            $day = $aListRuteros->aDiaRecorrido->__toString();
            $aCustRuteroID = $aListRuteros->aDetail->aListDetailsRuteros->aCustRuteroID->__toString();
            $day = explode('- ', $day)[0];

            return [
                'zone' => $zone,
                'route' => $route,
                'code' => $aCustRuteroID,
                'day' => $day
            ];
        } else {
            return null;
        }
    }
}
