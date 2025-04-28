<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ParseWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse weather from .....';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('weather parse');
    }
}
