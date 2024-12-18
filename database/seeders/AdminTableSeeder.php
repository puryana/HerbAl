<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'I Kadek Diwa Anjapuryana',
            'email'=> 'puryanaanja@gmail.com',
            'password'=> Hash::make('diwa123'),
        ]);
    }
}
