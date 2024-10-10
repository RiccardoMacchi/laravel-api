<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Item;
use App\Models\Framework;

class FrameworksItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 0; $i++) {
            $item = Item::inRandomOrder()->first();

            $framework_id = Framework::inRandomOrder()->first()->id;

            $item->frameworks()->attach($framework_id);
        }
    }
}
