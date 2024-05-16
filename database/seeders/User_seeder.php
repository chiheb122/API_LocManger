<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class User_seeder extends Seeder {

    public function run(): void
    {
        // créer un client fictif
        \DB::table('client')->insert([
        "cli_nom"=> "Mme. Dr. Kaitlin Koss",
        "cli_prenom"=>  "Adela Hane V",
        "cli_note"=>  4,
        "cli_tel"=>  37,
        "cli_adresse"=>  "704 Felipa Rapid\nLylachester, LA 38715-1440",
        "cli_ville"=> "East Paulinestad",
        "cli_pays"=> "Suisse",
        "cli_codePostal"=> "1200"
        ]);

        \DB::table('client')->insert([
        "cli_nom"=> "Dr. Kaitlin Koss",
        "cli_prenom"=>  "Adela Hane V",
        "cli_note"=>  4,
        "cli_tel"=>  37,
        "cli_adresse"=>  "704 Felipa Rapid\nLylachester, LA 38715-1440",
        "cli_ville"=> "East Paulinestad",
        "cli_pays"=> "Suisse",
        "cli_codePostal"=> "1200"
        ]);

        //rempir le table user avec des données fictives
        \DB::table('users')->insert([
            'name' => 'demo',
            'email' => 'demo@demo.com',
            'password' => Hash::make('demo'),
            'role' => 'admin', 
            'Fk_cli_id'=> 1,        
            ]);

        \DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@test.com',
            'password' => Hash::make('user'),
            'role' => 'user',
            'Fk_cli_id'=> 2,
            ]);
    }
}