<?php

namespace App\Jobs;

use App\Models\Tax;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Faker\Core\File;
use Illuminate\Support\Facades\Storage;
use Image;

class ProcessImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        //    public $item, 
        //    public $folder
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // info("proceso jon");
        // info($this->item);

        Tax::create([
            'name' => 'IVA',
            'tax' => 21,
        ]);
        // $image = $this->image;
        // $name = $this->name;


        // $imgFile = Image::make($image->getRealPath());


        // Storage::disk('do')->put("{$name}.jpg", $imgFile->stream());

        // $imgFile->resize(1000, 1000, function ($constraint) {$constraint->aspectRatio();});
        // Storage::disk('do')->put("{$name}-1000x1000.jpg", $imgFile->encode('jpg', 75)->stream());


        // $imgFile->resize(500, 500, function ($constraint) {$constraint->aspectRatio();});
        // Storage::disk('do')->put("{$name}-500x500.jpg", $imgFile->encode('jpg', 75)->stream());


    }
}
