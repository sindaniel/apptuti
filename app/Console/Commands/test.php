<?php

namespace App\Console\Commands;

use App\Mail\OrderEmail;
use App\Models\Order;
use App\Models\Setting;
use App\Repositories\OrderRepository;
use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Support\Facades\Mail;
use SimpleXMLElement;
use Spatie\ArrayToXml\ArrayToXml;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

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
        // //$order = Order::find(16);
        // $date = OrderRepository::getBusinessDay();
        // dd($date);

        $order = Order::with(['products', 'user', 'zone'])->find(51);
      // dd($order->products[0]->product);
        Mail::to('danielpunk4@gmail.com')->send(new OrderEmail($order));
        
      
    }
}
