<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('follows')->insert([
            'following_id' => 1,  // フォローした人のID
            'followed_id' => 2,   // フォローされた人のID
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
