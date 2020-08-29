<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
        [
            'email' => 'admin@email.com',
        ],
        [
            'name' => 'Administrador',
            'password' => bcrypt('123456789')
        ]
    );
    }
}
