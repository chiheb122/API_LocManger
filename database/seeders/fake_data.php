<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class fake_data extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed the paiement table
        DB::table('paiement')->insert([
            [
                'pai_statut' => 'en attente',
                'pai_mode' => 'carte bancaire',
                'pai_montant' => 150.00,
                'pai_date' => '2024-05-01',
            ],
            [
                'pai_statut' => 'payé',
                'pai_mode' => 'paypal',
                'pai_montant' => 200.00,
                'pai_date' => '2024-05-02',
            ],
            [
                'pai_statut' => 'annulé',
                'pai_mode' => 'virement',
                'pai_montant' => 50.00,
                'pai_date' => '2024-05-03',
            ],
        ]);

        // Seed the client table
        DB::table('client')->insert([
            [
                'cli_nom' => 'Dupont',
                'cli_prenom' => 'Jean',
                'cli_note' => 8,
                'cli_tel' => '0601234567',
                'cli_adresse' => '123 Rue des Lilas',
                'cli_ville' => 'Geneve',
                'cli_pays' => 'Suisse',
                'cli_codePostal' => '1200',
            ],
            [
                'cli_nom' => 'Martin',
                'cli_prenom' => 'Lucie',
                'cli_note' => 9,
                'cli_tel' => '0607654321',
                'cli_adresse' => '456 Avenue des Alpes',
                'cli_ville' => 'Genève',
                'cli_pays' => 'Suisse',
                'cli_codePostal' => '1222',
            ],
            [
                'cli_nom' => 'Bernard',
                'cli_prenom' => 'Claude',
                'cli_note' => 7,
                'cli_tel' => '0609876543',
                'cli_adresse' => '789 Boulevard',
                'cli_ville' => 'Genève',
                'cli_pays' => 'Suisse',
                'cli_codePostal' => '1234',
            ],
        ]);

        // Seed the employe table
        DB::table('employe')->insert([
            [
                'emp_nom' => 'Moreau',
                'emp_prenom' => 'Pierre',
                'emp_email' => 'pierre.moreau@example.com',
                'emp_salaire' => 4500.00,
            ],
          
        ]);

        // Seed the notification table
        DB::table('notification')->insert([
            [
                'not_message' => 'Votre location est confirmée pour le 05/05/2024.',
                'not_type' => 'email',
                'not_cli_id' => 1,
                'not_dateEnvoi' => '2024-05-01',
                'not_sujet' => 'Location confirmée',
                'not_description' => 'Location de vélo confirmée',
            ],
            [
                'not_message' => 'Votre rendez-vous est confirmé.',
                'not_type' => 'sms',
                'not_cli_id' => 2,
                'not_dateEnvoi' => '2024-05-02',
                'not_sujet' => 'Rendez-vous confirmé',
                'not_description' => 'Votre rendez-vous avec notre conseiller est confirmé pour le 05/05/2024.',
            ],
            [
                'not_message' => 'Votre facture est disponible.',
                'not_type' => 'email',
                'not_cli_id' => 3,
                'not_dateEnvoi' => '2024-05-03',
                'not_sujet' => 'Facture disponible',
                'not_description' => 'Votre facture pour le mois de mai est disponible.',
            ],
        ]);

        // Seed the piece table
        DB::table('piece')->insert([
            [
                'pie_nom' => 'Pièce A',
                'pie_quantite' => 50,
                'pie_prix' => 15.50,
                'pie_reference' => 'REF001',
                'pie_dateEntree' => '2024-05-01',
            ],
            [
                'pie_nom' => 'Pièce B',
                'pie_quantite' => 30,
                'pie_prix' => 25.00,
                'pie_reference' => 'REF002',
                'pie_dateEntree' => '2024-05-02',
            ],
            [
                'pie_nom' => 'Pièce C',
                'pie_quantite' => 20,
                'pie_prix' => 35.75,
                'pie_reference' => 'REF003',
                'pie_dateEntree' => '2024-05-03',
            ],
        ]);

        // Seed the service table
        DB::table('service')->insert([
            [
                'cli_id' => 1,
                'ser_type' => 'réparation',
                'ser_cout' => 100.00,
                'ser_empId' => 1,
                'ser_statuts' => 'En Cours',
                'ser_dateDebut' => '2024-05-01',
                'ser_dateFin' => '2024-05-05',
            ],
            [
                'cli_id' => 2,
                'ser_type' => 'entretien',
                'ser_cout' => 150.00,
                'ser_empId' => 1,
                'ser_statuts' => 'Terminé',
                'ser_dateDebut' => '2024-05-02',
                'ser_dateFin' => '2024-05-06',
            ],
            [
                'cli_id' => 3,
                'ser_type' => 'réparation',
                'ser_cout' => 200.00,
                'ser_empId' => 1,
                'ser_statuts' => 'En Attente',
                'ser_dateDebut' => '2024-05-03',
                'ser_dateFin' => '2024-05-07',
            ],
        ]);

        // Seed the service_piece table with unique pairs
        DB::table('service_piece')->insert([
            [
                'SP_serid' => 1,
                'SP_pieid' => 1,
            ],
            [
                'SP_serid' => 2,
                'SP_pieid' => 2,
            ],
            [
                'SP_serid' => 3,
                'SP_pieid' => 3,
            ],
        ]);

        // Seed the location table
        DB::table('location')->insert([
            [
                'loc_DateDebut' => '2024-05-01',
                'loc_DateFin' => '2024-05-10',
                'loc_PrixTotal' => 60.00,
                'loc_equ_id' => 1,
                'loc_EtatEquipement' => 'en bon état',
                'Fk_loc_paie' => 1,
                'Fk_loc_cli' => 1,
            ],
            [
                'loc_DateDebut' => '2024-05-02',
                'loc_DateFin' => '2024-05-11',
                'loc_PrixTotal' => 120.00,
                'loc_equ_id' => 2,
                'loc_EtatEquipement' => 'en bon état',
                'Fk_loc_paie' => 2,
                'Fk_loc_cli' => 2,
            ],
            [
                'loc_DateDebut' => '2024-05-03',
                'loc_DateFin' => '2024-05-12',
                'loc_PrixTotal' => 25.00,
                'loc_equ_id' => 3,
                'loc_EtatEquipement' => 'en bon état',
                'Fk_loc_paie' => 3,
                'Fk_loc_cli' => 3,
            ],
        ]);

        // Seed the promotion table
        DB::table('promotion')->insert([
            [
                'pro_nom' => 'Promo A',
                'pro_pourcentage' => 10.00,
                'pro_dateDebut' => '2024-05-01',
                'pro_dateFin' => '2024-05-10',
                'fk_pro_locId' => 1,
            ],
            [
                'pro_nom' => 'Promo B',
                'pro_pourcentage' => 15.00,
                'pro_dateDebut' => '2024-05-02',
                'pro_dateFin' => '2024-05-11',
                'fk_pro_locId' => 2,
            ],
            [
                'pro_nom' => 'Promo C',
                'pro_pourcentage' => 20.00,
                'pro_dateDebut' => '2024-05-03',
                'pro_dateFin' => '2024-05-12',
                'fk_pro_locId' => 3,
            ],
        ]);

        // Seed the materiels table
        DB::table('equipement')->insert([
            [
                'equ_Nom' => 'Vélo de montagne',
                'equ_Catégorie' => 'vélo',
                'equ_StockDisponible' => 10,
                'equ_PrixParJour' => 15.00,
                'equ_Description' => 'Vélo de montagne pour les sentiers difficiles',
            ],
            [
                'equ_Nom' => 'Raquette de tennis',
                'equ_Catégorie' => 'raquette',
                'equ_StockDisponible' => 20,
                'equ_PrixParJour' => 5.00,
                'equ_Description' => 'Raquette de tennis pour les débutants',
            ],
            [
                'equ_Nom' => 'Kayak',
                'equ_Catégorie' => 'kayak',
                'equ_StockDisponible' => 5,
                'equ_PrixParJour' => 25.00,
                'equ_Description' => 'Kayak pour les amateurs de sports nautiques',
            ],
        ]);

      
    }
}
