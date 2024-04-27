<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Genre;
use App\Models\Console;
use App\Models\Game;
use App\Models\Game_genre;

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
                "name" => "admin",
                "username" => "admin",
                "email" => "admin@mail.com",
                "password" => bcrypt('admin123'),
                "image_path" => "profile_pictures/profile.jpg",
                "role_id" => 1,
            ],
            [
                "name" => "user",
                "username" => "user",
                "email" => "user@mail.com",
                "password" => bcrypt('user123'),
                "image_path" => "profile_pictures/profile.jpg",
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
                "name" => "Music"
            ],
            [
                "name" => "Sports"
            ],
            [
                "name" => "Survival"
            ],
            [
                "name" => "Card & Board Games"
            ],
            [
                "name" => "Hack and Slash"
            ],
            [
                "name" => "Education"
            ]
        ];
        $consoles = [
            [
                "name" => "Playstation",
                "image_path" => "console_images/ps1.webp",
                "developer" => "Sony",
                "release_year" => "1994",
                "description" => "The PlayStation is a home video game console developed and marketed by Sony Computer Entertainment.",
                "stock" => 5,
                "price" => 1,
            ],
            [
                "name" => "Playstation 2",
                "image_path" => "console_images/ps2.webp",
                "developer" => "Sony",
                "release_year" => "2000",
                "description" => "The PlayStation is a home video game console developed and marketed by Sony Interactive Entertainment.",
                "stock" => 5,
                "price" => 1,
            ],
            [
                "name" => "Playstation 3",
                "image_path" => "console_images/ps3.jpg",
                "developer" => "Sony",
                "release_year" => "2006",
                "description" => "The PlayStation is a home video game console developed and marketed by Sony Interactive Entertainment.",
                "stock" => 5,
                "price" => 1,
            ],
            [
                "name" => "Playstation 4",
                "image_path" => "console_images/ps4.jpg",
                "developer" => "Sony",
                "release_year" => "2013",
                "description" => "The PlayStation is a home video game console developed and marketed by Sony Interactive Entertainment.",
                "stock" => 5,
                "price" => 1,
            ],
        ];
        $games = [
            [
                "name" => "Crash Bandicoot",
                "image_path" => "game_images/crash-bandicoot.jpg",
                "publisher" => "Activision",
                "release_year" => "1996",
                "description" => "Crash Bandicoot is a video game series, originally developed by Naughty Dog as an exclusive game for the Sony PlayStation console.",
                "console_id" => 1,
                "stock" => 5,
                "price" => 1,
            ],
            [
                "name" => "Sengoku Basara 2 Heroes",
                "image_path" => "game_images/basara2.jpg",
                "publisher" => "Capcom",
                "release_year" => "2007",
                "description" => "Sengoku Basara 2 is the sequel to the first Sengoku Basara game. First released by Capcom for the PlayStation 2 on 27 July 2006.",
                "console_id" => 2,
                "stock" => 5,
                "price" => 1,
            ],
            [
                "name" => "God of War 3",
                "image_path" => "game_images/gow3.jpg",
                "publisher" => "Sony Interactive Entertainment",
                "release_year" => "2010",
                "description" => "God of War III is the fifth installment in the God of War series, released on March 16, 2010 for the PlayStation 3.",
                "console_id" => 3,
                "stock" => 5,
                "price" => 1,
            ],
            [
                "name" => "Grand Turismo 7",
                "image_path" => "game_images/grandturismo.webp",
                "publisher" => "Sony Interactive Entertainment",
                "release_year" => "2022",
                "description" => "Gran Turismo 7 is a racing video game developed by Polyphony Digital and published by Sony Interactive Entertainment.",
                "console_id" => 4,
                "stock" => 5,
                "price" => 1,
            ],
            [
                "name" => "Red Dead Redemption 2",
                "image_path" => "game_images/rdr2.jpg",
                "publisher" => "Rockstar Games",
                "release_year" => "2018",
                "description" => "Red Dead Redemption 2 (stylized as Red Dead Redemption II) is a western-themed action-adventure video game developed and published by Rockstar Games.",
                "console_id" => 4,
                "stock" => 5,
                "price" => 1,
            ],
            [
                "name" => "FIFA 2",
                "publisher" => "Electronic Arts",
                "image_path" => "game_images/fifa22.jpg",
                "release_year" => "2021",
                "description" => "FIFA 22 is a football simulation video game published by Electronic Arts. It is the 29th installment in the FIFA series, and was released worldwide on 1 October 2021.",
                "console_id" => 4,
                "stock" => 5,
                "price" => 1,
            ],
        ];
        $game_genres = [
            [1,15],
            [4,15],
            [1,4,15],
            [2],
            [1,4],
            [12]
        ];
        

        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name']
            ]);
        }
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
                'image_path' => $user['image_path'],
                'role_id' => $user['role_id'],
            ]);
        }
        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre['name'],
            ]);
        }
        foreach ($consoles as $console) {
            Console::create([
                'name' => $console['name'],
                'image_path' => $console['image_path'],
                'developer' => $console['developer'],
                'release_year' => $console['release_year'],
                'description' => $console['description'],
                'stock' => $console['stock'],
                'price' => $console['price'],
            ]);
        }
        foreach ($games as $index => $game) {
            $newGame = Game::create([
                'name' => $game['name'],
                'image_path' => $game['image_path'],
                'publisher' => $game['publisher'],
                'release_year' => $game['release_year'],
                'description' => $game['description'],
                'console_id' => $game['console_id'],
                'stock' => $game['stock'],
                'price' => $game['price'],
            ]);
        
            foreach ($game_genres[$index] as $genreId) {
                $newGame->genres()->attach($genreId);
            }
        }
    }
}