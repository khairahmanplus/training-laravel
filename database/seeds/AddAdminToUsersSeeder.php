<?php

use Illuminate\Database\Seeder;

use App\User;

class AddAdminToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'                  => 'Administrator',
            'username'              => 'admin',
            'email'                 => 'admin@contoh.com',
            'password'              => bcrypt('passwordsecret'),
            'is_administrator'      => true
        ]);
    }
}
