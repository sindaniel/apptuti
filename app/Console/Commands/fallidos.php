<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Console\Command;

class fallidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fallidos';

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
        $ordes = Order::whereIn('status_id', [Order::STATUS_ERROR, Order::STATUS_ERROR_WEBSERVICE])->get();

        foreach ($variable as $key => $value) {
            OrderRepository::presalesOrder($order);
        }
    }
}
