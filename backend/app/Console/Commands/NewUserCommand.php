<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Str;

class NewUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:new {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user with the given name and email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');

        if (User::where('email', $email)->exists()) {
            $this->error('User with this email already exists.');
            return 1;
        }

        $password = Str::random(10);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("✅ User {$user->email} created successfully.");
        $this->warn("🔐 Password: $password");

        return 0;
    }
}
