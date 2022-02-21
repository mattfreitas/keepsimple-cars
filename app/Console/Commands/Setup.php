<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all the necessary migrations and factories.';

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
     * Execute the console command to run migrations and factories.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting setup...');

        if ($this->option('email')) {
            $this->call('migrate:refresh');
            $this->call('db:seed');

            User::insert([
                'name' => 'Default User',
                'email' => $this->option('email'),
                'password' => bcrypt('contratado!'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->info('You are ready to go. Enjoy!');
            $this->table(
                ['Email', 'Password'], 
                [
                    [$this->option('email'), 'contratado!']
                ]
            );

            return;
        }

        $this->error('Please, provide an email so we can create a default user (use: php artisan setup --email=yourbestemail@gmail.com).');
        return 0;
    }
}
