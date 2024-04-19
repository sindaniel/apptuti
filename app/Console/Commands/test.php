<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Setting;
use App\Repositories\OrderRepository;
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
        //$order = Order::find(16);
        OrderRepository::getBusinessDay();
        
      
    }
}
