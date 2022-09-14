<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Install extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:install {--clear}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Application';

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
     * @return void
     */
    public function handle()
    {
        if ($this->option('clear'))
        {
            $this->clear();
        }


        if (!file_exists(public_path('storage')))
        {
            Artisan::call('storage:link');
            $this->info(Artisan::output());
        }

        $before = Carbon::now();

        // drop tables and migrate
        Artisan::call('migrate:refresh',['--force' => true]);
        $this->info(Artisan::output());

        $after = Carbon::now();

        $this->warn('(migration time ~ : ' . $after->diffInSeconds($before) . ' seconds)');

        $before = Carbon::now();

        // seed data
        Artisan::call('db:seed',['--force' => true,'--no-interaction' => true]);
        $this->info(Artisan::output());

        $after = Carbon::now();

        $this->warn('(seeding time ~ : ' . $after->diffInSeconds($before) . ' seconds)');


        // install passport package
        Artisan::call('jwt:secret',['--force' => true]);
        $this->info(Artisan::output());
    }

    public function clear()
    {
        Artisan::call('cache:clear');
        $this->info(Artisan::output());

        Artisan::call('config:clear');
        $this->info(Artisan::output());

        Artisan::call('view:clear');
        $this->info(Artisan::output());

        Artisan::call('route:clear');
        $this->info(Artisan::output());

        Artisan::call('optimize:clear');
        $this->info(Artisan::output());

        //composer dump
        shell_exec('composer dump');
    }
}

