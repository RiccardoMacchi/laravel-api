<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Item;
use App\Models\Framework;
use Illuminate\Support\Facades\DB;

class FrameworksItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Path al file CSV
        $filePath = public_path('csv/framework_item.csv');

        // Verifica se il file esiste
        if (file_exists($filePath)) {
            // Ottieni il contenuto del file CSV
            $csvData = array_map('str_getcsv', file($filePath));

            // Elimina la prima riga (intestazioni)
            array_shift($csvData);

            // Inserisci i dati nella tabella pivot
            foreach ($csvData as $row) {
                // Assicurati che ogni riga contenga il framework_id e item_id
                if (isset($row[0]) && isset($row[1])) {
                    DB::table('framework_item')->insert([
                        'framework_id' => $row[0],
                        'item_id' => $row[1],
                    ]);
                }
            }

            $this->command->info("Tabella 'framework_item' popolata con successo!");
        } else {
            $this->command->error("Il file CSV non esiste nella directory specificata!");
        }
    }
}
