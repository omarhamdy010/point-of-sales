<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('12345678'),
            'phone'=>'01011111111',
        ]);
        $user->attachRole('super_admin');
    }
}
