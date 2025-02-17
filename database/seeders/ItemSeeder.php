<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Functions\Helper;
use App\Models\Type;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Percorso del file CSV
        $filePath = public_path('csv/items.csv');

        // Controlla se il file esiste
        if (!file_exists($filePath)) {
            $this->command->error("Il file CSV non esiste in {$filePath}");
            return;
        }

        // Legge il contenuto del file CSV
        $csvData = array_map('str_getcsv', file($filePath));

        // Estrai la prima riga come intestazioni
        $headers = array_map('trim', $csvData[0]);
        unset($csvData[0]); // Rimuovi le intestazioni dai dati

        // Cicla attraverso ogni riga del CSV
        $items = [];
        foreach ($csvData as $row) {
            $row = array_combine($headers, $row); // Combina i dati con le intestazioni

            // Aggiungi i dati alla lista dei progetti
            $items[] = [
                'title' => $row['title'],
                'git_link' => $row['git_link'],
                'project_link' => $row['project_link'] ?? null,
                'repo_name' => $row['repo_name'],
                'img_path' => $row['img_path'],
                'original_img_name' => $row['original_img_name'],
                'date' => date('Y-m-d', strtotime($row['date'])),
                'short_description' => $row['short_description'],
                'description' => $row['description'],
                'slug' => $row['slug'],
                'type_id' => (int) $row['type_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Inserisce i dati nella tabella 'items'
        DB::table('items')->insert($items);

        $this->command->info("I dati dal file CSV sono stati caricati con successo nella tabella 'items'.");
    }
}
