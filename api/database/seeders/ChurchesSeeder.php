<?php

namespace Database\Seeders;

use App\Models\Church;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChurchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public $churches = [
        'São Paulo Apóstolo',
        'Sagrado Coração de Jesus',
        'São João Evangelista',
        'São José',
        'Santa Edwiges',
        'São Sebastião',
        'Santa Luzia',
        'Nossa Senhora da Conceição',
    ];

    public function run(): void
    {
        foreach ($this->churches as $church) {
            Church::firstOrCreate([
                'name' => $church
            ]);
        }
    }
}
