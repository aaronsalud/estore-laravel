<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EstoreInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'estore:install {--force : Do not ask for user confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize data for the EStore application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('force')) {
            $this->proceed();
        } else if ($this->confirm('This will reset ALL your current data. Are you sure you want to proceed?')) {
            $this->proceed();
        }
    }

    protected function proceed()
    {
        // Clear pre existing images in the storage folder
        File::deleteDirectory(public_path('storage/products/dummy'));

        $this->callSilent('storage:link');
        $copySuccessFul = File::copyDirectory(public_path('img/products'), public_path('storage/products/dummy'));

        if ($copySuccessFul) {
            $this->info('Images succesfully copied to the storage folder');
        }

        $this->call('migrate:fresh', [
            '--seed' => true,
        ]);

        try {
            $this->call('scout:flush', [
                'model' => 'App\\Product',
            ]);

            $this->call('scout:import', [
                'model' => 'App\\Product',
            ]);
        } catch (\Exception $e) {
            $this->error('Algolia credentials incorrect. Check your .env file. Make sure ALGOLIA_APP_ID and ALGOLIA_SECRET are correct.');
        }

        DB::unprepared(file_get_contents(base_path('database/exports/voyager-export.sql')));

        $this->info('EStore app settings initialization complete');
    }
}
