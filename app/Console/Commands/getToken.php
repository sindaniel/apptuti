<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class getToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-token';

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
        
      
        $client_id = config('microsoft.client_id');
        $client_secret = config('microsoft.client_secret');
        $resource = config('microsoft.resource');
        $url = config('microsoft.url_token');

        $data = [
            'grant_type' => 'client_credentials',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'resource' => $resource,
        ];

        $response = Http::asForm()->post($url, $data);

        $json = $response->json();
       
        $token = $json['access_token'];
        Setting::where('key', 'microsoft_token')->update(['value' => $token]);
        
        //print 
        $this->info('Token: ' . $token);
        

    }
}
