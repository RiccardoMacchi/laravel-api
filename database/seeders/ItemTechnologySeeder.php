<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Technology;
use App\Models\Item;

class ItemTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 300; $i++) {
            // Estrazione item random
            $item = Item::inRandomOrder()->first();

            // Estrazione technology ID random
            $tech_id = Technology::inRandomOrder()->first()->id;

            // Aggiungiamo la relazione tra un elemento e l'id dell altro elemento della tabella in relazione
            $item->technologies()->attach($tech_id);

        }
    }
}
