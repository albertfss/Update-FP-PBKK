<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'iis@mdp.ac.id',
            'password' => Hash::make('secret'),
            'is_admin'=> 1
        ]);
        User::create([
            'name' => 'juned',
            'email' => 'aas@mdp.ac.id',
            'password' => Hash::make('secret'),
            'is_admin'=> 0
        ]);
        User::create([
            'name' => 'albert',
            'email' => 'ees@mdp.ac.id',
            'password' => Hash::make('secret'),
            'is_admin'=> 0
        ]);
    }
}
