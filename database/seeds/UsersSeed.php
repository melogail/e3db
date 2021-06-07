<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'mohamed',
            'last_name' => 'elogail',
            'username' => 'melogail',
            'email' => 'moh.elogail@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('melogail_321'),
            'department' => 'e3mel business',
            'role' => 'superuser',
            'active' => 1
        ]);
    }
}
