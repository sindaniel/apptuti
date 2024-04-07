<?php

namespace App\Console\Commands;

use App\Models\State;
use Illuminate\Console\Command;

class importStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-states';

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
        $csv = storage_path('states.csv');

        if ($open = fopen($csv, 'r')) {

            while (($data = fgetcsv($open)) !== FALSE) {

                $state = State::firstOrCreate([
                    'name'=>$data[2]
                ]);

                $state->cities()->create([
                    'name'=>$data[4]
                ]);   
                
            }

            fclose($open);
        }
    }
}
