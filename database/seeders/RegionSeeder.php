<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(array(
            'Auvergne-Rhône-Alpes',
            'Bourgogne-Franche-Comté',
            'Bretagne', 
            'Centre-Val de Loire', 
            'Corse', 
            'Grand Est', 
            'Guadeloupe', 
            'Guyane', 
            'Hauts-de-France', 
            'Île-de-France', 
            'La Réunion', 
            'Martinique', 
            'Mayotte', 
            'Normandie', 
            'Nouvelle-Aquitaine', 
            'Occitanie', 
            'Pays de la Loire', 
            'Provence-Alpes-Côte d\'Azur'
                ) as $nom){
            DB::table('regions')->insert([
                'nom' => $nom    
            ]);
        }
    }
}
