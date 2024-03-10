<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Genre;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            [
                "name" => "admin"
            ],
            [
                "name" => "user"
            ],
        ];
        $users = [
            [
                "username" => "admin",
                "email" => "admin@mail.com",
                "password" => bcrypt('admin123'),
                "role_id" => 1,
            ],
            [
                "username" => "user",
                "email" => "user@mail.com",
                "password" => bcrypt('user123'),
                "role_id" => 2,
            ],
        ];
        $genres = [
            [
                "name" => "Adventure"
            ],
            [
                "name" => "Racing"
            ],
            [
                "name" => "First Person Shooter"
            ],
            [
                "name" => "Action"
            ],
            [
                "name" => "Role-Playing-Games"
            ],
            [
                "name" => "Puzzle"
            ],
            [
                "name" => "Strategy"
            ],
            [
                "name" => "Simulation"
            ],
            [
                "name" => "Fighting"
            ],
            [
                "name" => "Horror"
            ],
            [
                "name" => "Music/Rhythm"
            ],
            [
                "name" => "Sports"
            ],
            [
                "name" => "Platformer"
            ],
            [
                "name" => "Survival"
            ],
            [
                "name" => "Visual Novel"
            ],
            [
                "name" => "Sandbox"
            ],
            [
                "name" => "Card & Board Games"
            ],
            [
                "name" => "Education"
            ]
        ];
        

        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name']
            ]);
        }
        foreach ($users as $user) {
            User::create([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role_id' => $user['role_id'],
            ]);
        }
        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre['name'],
            ]);
        }
    }
}
