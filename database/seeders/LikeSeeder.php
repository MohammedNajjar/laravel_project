<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 50) as $index)
        {
            DB::table('likes')->insert([
                'tweet_id' => rand(1,50),
                'user_id' => rand(1,50)
            ]);
        }
    }
}
