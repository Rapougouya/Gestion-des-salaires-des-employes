<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $departements = [
        'Marketing',
        'Informatique',
        'Production',
        'Comptabilité et Finance',
        'Ventes',
        'Ressources Humaines',
        'Communication',
        'Service clients',
        'Logistique',
        'Developpement'
    ];

    foreach ($departements as $departement) {
        Departement::create(['name' => $departement]);
    }
}

}
