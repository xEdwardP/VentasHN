<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Edward J. Pineda',
                'email' => 'epineda@yopmail.com',
                'rol' => 'admin',
                'active' => true
            ],
            [
                'name' => 'Jose B. Alvarado',
                'email' => 'jorellana@yopmail.com',
                'rol' => 'admin',
                'active' => true
            ],
            [
                'name' => 'Hector de Jesus Villeda',
                'email' => 'hvilleda@yopmail.com',
                'rol' => 'cajero',
                'active' => true
            ],
            [
                'name' => 'Edar Z. Castillo',
                'email' => 'ecastillo@yopmail.com',
                'rol' => 'cajero',
                'active' => true
            ],
            [
                'name' => 'Omar A. Pinto',
                'email' => 'opinto@yopmail.com',
                'rol' => 'cajero',
                'active' => true
            ],
            [
                'name' => 'Stefano A. Ponce',
                'email' => 'sponce@yopmail.com',
                'rol' => 'cajero',
                'active' => true
            ],
            [
                'name' => 'Franci S. Abrego',
                'email' => 'fabrego@yopmail.com',
                'rol' => 'cajero',
                'active' => true
            ]
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->password = Hash::make('123');
            $user->rol = $userData['rol'];
            $user->active = $userData['active'];
            $user->save();
        }
    }
}
