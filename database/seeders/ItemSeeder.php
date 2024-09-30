<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Functions\Helper;
use App\Models\Type;

use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 200; $i++){
            $new_item = new Item();
            $new_item->title = $faker->word();
            $new_item->git_link = $faker->word();
            $new_item->lenguages = $faker->word();
            $new_item->date = $faker->dateTime();
            $new_item->description = $faker->paragraph();
            $new_item->slug = Helper::generateSlug($new_item->title, Item::class);
            // dump($new_item);
            // Estraiamo randomaticamente un elemento dalla tabella types e prendiamo il primo elemento e di quello l'ID
            $new_item->type_id = Type::inRandomOrder()->first()->id;
            $new_item->save();
        }
    }
}
