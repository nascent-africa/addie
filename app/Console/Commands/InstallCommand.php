<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:addie {--dev=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Addie for first use';

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
        $this->info('Preparing database...');
        $this->call('migrate:fresh');

        $this->info('Create roles...');
        Role::create(['name' => 'superuser']);
        Role::create(['name' => 'administrator']);

        $this->info('Creating superuser');
        $user = User::create([
            'name' => env('SUPERUSER_NAME'),
            'email' => env('SUPERUSER_EMAIL'),
            'password' => Hash::make(env('SUPERUSER_PASSWORD')),
            'email_verified_at' => now()
        ]);

        $user->assignRole(['superuser']);

        if ($this->option('dev')) {
            // Preparing development test data...
            $this->call('db:seed', [
                '--class' => 'DatabaseSeeder'
            ]);
        }

        $this->info('Flushing cache...');
        Cache::flush();

        $this->info('All done!');
    }
}
