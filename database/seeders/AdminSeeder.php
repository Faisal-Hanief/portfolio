<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('portfolio.admin.email');
        $password = config('portfolio.admin.password');

        if (! $email || ! $password) {
            $this->command->warn('ADMIN_EMAIL or ADMIN_PASSWORD is not set in .env. Skipping admin user.');

            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            ['name' => config('portfolio.admin.name'), 'password' => $password]
        );
    }
}