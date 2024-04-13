<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class OrderRepository
{
    public static function presalesOrder($order)
    {   
        self::sendData(order: $order, products: $order->products, bonification: 0);
        if($order->bonifications->count()){
            self::sendData(order: $order, products: $order->bonifications, bonification: 1);
        }
      
    }

    private static function sendData($order, $products, $bonification = 0){
       
        $user  = $order->user;
 
        $min_delivery = $products->min('product.delivery_days');
        
        $delivery_date = now()->addDays($min_delivery)->format('Y-m-d');
        $day = $user->day;
        $route = $user->route;
        $zone = $user->zone;

        $productList = '';

        foreach ($products as $product) {
            $unitPrice = $product->price + $product->discount;
            if($bonification){
                $unitPrice = $product->product->price;
            }
          
            $productList .= '<dyn:listDetails>
                            <dyn:discount>' . (int)$product->discount . '</dyn:discount>
                            <dyn:itemId>' . $product->product->sku . '</dyn:itemId>
                            <dyn:qty>' . $product->quantity . '</dyn:qty>
                            <dyn:qtyCust>' . $product->quantity . '</dyn:qtyCust>
                            <dyn:um>Unidad</dyn:um>
                            <dyn:umCust>None</dyn:umCust>
                            <dyn:unitPrice>' . (int)$unitPrice . '</dyn:unitPrice>
                        </dyn:listDetails>';
        }


        $order_id = $order->id;
        if ($bonification) {
            $order_id = $order->id.'-1';
        }

        $body = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:dat="http://schemas.microsoft.com/dynamics/2013/01/datacontracts" xmlns:tem="http://tempuri.org" xmlns:dyn="http://schemas.datacontract.org/2004/07/Dynamics.AX.Application">
            <soapenv:Header>
                <dat:CallContext>
                    <dat:Company>trx</dat:Company>
                    <dat:Language/>
                    <dat:MessageId/>
                    <dat:PartitionKey/>
                </dat:CallContext>
            </soapenv:Header>
            <soapenv:Body>
                <tem:PreSaslesProcess>
                    <tem:ArrayOfPreSalesOrder>
                        <dyn:preSalesOrder>
                            <dyn:TRO_E_obsequio>'. $bonification.'</dyn:TRO_E_obsequio> 
                            <dyn:codCustomer>' . $user->code . '</dyn:codCustomer> 
                            <dyn:deliveryDate>' . $delivery_date . '</dyn:deliveryDate>
                            <dyn:diaRecorrido>' . $day . '</dyn:diaRecorrido>
                            <dyn:listDetails>
                                <!--Zero or more repetitions:-->
                                ' . $productList . '
                            </dyn:listDetails>
                            <dyn:orderSales>' . $order_id . '</dyn:orderSales>
                            <dyn:ruta>' . $route . '</dyn:ruta> 
                            <dyn:salesCons>' . $order_id . '</dyn:salesCons> 
                            <dyn:transactionDate>' . $order->created_at->format('Y-m-d') . '</dyn:transactionDate>
                            <dyn:zona>' . $zone . '</dyn:zona> 
                        </dyn:preSalesOrder>
                    </tem:ArrayOfPreSalesOrder>
                </tem:PreSaslesProcess>
            </soapenv:Body>
        </soapenv:Envelope>';

       

        $token = Setting::getByKey('microsoft_token');

        $response = Http::withHeaders([
            'Content-Type' => 'text/xml;charset=UTF-8',
            'SOAPAction' => 'http://tempuri.org/DWSSalesForce/PreSaslesProcess',
            'Authorization' => "Bearer {$token}"
        ])->send('POST', 'https://uattrx.sandbox.operations.dynamics.com/soap/services/DIITDWSSalesForceGroup?=null', [
            'body' => $body
        ]);

        $data = $response->body();
        $xmlString = preg_replace('/<(\/)?(s|a):/', '<$1$2', $data);
        $xml = simplexml_load_string($xmlString);
        
        info($response);
        try{
            $response = $xml->sBody->PreSaslesProcessResponse->result->aPreSaslesProcessResult;
            if($response == 'OK'){
                $order->update(['status_id' => Order::STATUS_PROCESED]);
            }else{
                $order->update(['status_id' => Order::STATUS_ERROR]);
            }
        }catch(\Exception $e){
            
        }


      

    }
}
