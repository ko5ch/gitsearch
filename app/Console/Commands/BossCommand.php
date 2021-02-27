<?php

namespace App\Console\Commands;

use App\Services\Boss\BossTimer;
use Illuminate\Console\Command;

class BossCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boss {--f|frontend} {--b|breeze}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Like a boss.';

    protected $timer;

    /**
     * BossCommand constructor.
     * @param BossTimer $timer
     */
    public function __construct(BossTimer $timer)
    {
        $this->timer = $timer;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->timer->take();
        $this->alert('Like a boss');

        if($this->option('breeze')) {
            if($this->isBreezeExist()) {
                $this->info('call auth breeze install');
                $this->call('breeze:install');
            }
        }

        if($this->option('frontend')) {
            $this->info('run building frontend...');
            $this->info(shell_exec('npm install'));
            $this->info(shell_exec('npm run dev'));
        }

        $this->info('call migrate:fresh');
        $this->call('migrate:fresh');


        $this->info('call migrate');
        $this->call('migrate');

        $this->info('call seed');
        $this->call('db:seed');

        $this->alert('Boss command complete, it took: ' . $this->timer->difference());
    }

    private function isBreezeExist()
    {
        $file = base_path('composer.lock');
        $packages = collect(json_decode(file_get_contents($file), true)['packages-dev']);

        return $packages->filter(function($package) {
            return $package['name'] == 'laravel/breeze';
        })->count();
    }
}
