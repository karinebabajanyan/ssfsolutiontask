<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check if table users is empty
        if(DB::table('users')->get()->count() == 0){

            DB::table('users')->insert([

                [
                    'name' => 'Mary',
                    'surname'=>'Smith',
                    'email' => 'marysmith@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'John',
                    'surname'=>'Jones',
                    'email' => 'jones@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Ann',
                    'surname'=>'Williams',
                    'email' => 'ann.williams@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Robert',
                    'surname'=>'Taylor',
                    'email' => 'taylor.robert@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Lily',
                    'surname'=>'Brown',
                    'email' => 'brown@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Charles',
                    'surname'=>'Davies',
                    'email' => 'charles@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Ada',
                    'surname'=>'Evans',
                    'email' => 'ada@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Peter',
                    'surname'=>'Evans',
                    'email' => 'peter@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Lily',
                    'surname'=>'Wilson',
                    'email' => 'lilywilson@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Albert',
                    'surname'=>'Hall',
                    'email' => 'alberthall@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Mia',
                'surname'=>'Hall',
                'email' => 'mia.hall@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
               ]

            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
