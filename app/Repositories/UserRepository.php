<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class UserRepository
{
    public static function getCustomRuteroId($document){


        $token = Setting::where('key', 'microsoft_token')->first();
        
        //check if updated_at is grander than 30 minutes
        if($token->updated_at->diffInMinutes(now()) > 25){
            //call command app:get-token
            Artisan::call('app:get-token');
            $token = Setting::where('key', 'microsoft_token')->first();
        }

        $token = $token->value;


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
                        <dyn:IdentificationNum>'.$document.'</dyn:IdentificationNum>
                        <!--Optional:-->
                        <dyn:ruteroId></dyn:ruteroId>
                        <!--Optional:-->
                        <dyn:zona></dyn:zona>
                    </tem:_getRuteros>
                </tem:getRuteros>
            </soapenv:Body>
            </soapenv:Envelope>';

            

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

        try {
            $aListRuteros = $xml->sBody->getRuterosResponse->result->agetRuterosResult->aListRuteros;
        } catch (\Throwable $th) {
            return null;
        }
        
        if(!empty($aListRuteros->aRoute)){
            $address = $aListRuteros->aDetail->aListDetailsRuteros->aAddress->__toString();
            $name = $aListRuteros->aDetail->aListDetailsRuteros->aName->__toString();
            $route = $aListRuteros->aRoute->__toString();
            $zone = $aListRuteros->aZona->__toString();
            $day = $aListRuteros->aDiaRecorrido->__toString();
            $aCustRuteroID = $aListRuteros->aDetail->aListDetailsRuteros-> aCustRuteroID->__toString();
            $day = explode('- ', $day)[0];
            
            return [
                'zone' => $zone,
                'route' => $route,
                'code' => $aCustRuteroID,
                'day' => $day,
                'address' => $address,
                'name' => $name
            ];

        }else{
            return null;
        }
       


        
        
    }


}
