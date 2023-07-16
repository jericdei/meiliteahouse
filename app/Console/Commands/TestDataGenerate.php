<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestDataGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Test Data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('db:seed', [
            'class' => 'TestDataSeeder',
        ]);
    }
}
