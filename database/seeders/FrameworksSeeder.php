<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Framework;
use App\Functions\Helper;

class FrameworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['VueJs','Laravel','Bootstrap'];

        foreach($data as $frame){
            $new_frame = new Framework();
            $new_frame->name = $frame;
            $new_frame->slug = Helper::generateSlug($new_frame->name, Framework::class);
            $new_frame->save();
        }
    }
}
