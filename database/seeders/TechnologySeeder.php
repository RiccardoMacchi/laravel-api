<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Technology;
use App\Functions\Helper;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Front End', 'Back End', 'Full Stack', 'Database', 'API', 'UI/UX', 'DevOps', 'Version Control', 'Cloud Computing'];

        foreach ($data as $tech) {
            $new_tech = new Technology();
            $new_tech->name = $tech;
            $new_tech->slug = Helper::generateSlug($new_tech->name, Technology::class);
            // dump($new_tech);
            $new_tech->save();
        }

    }
}
