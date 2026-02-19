<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DB操作に必要
use Illuminate\Support\Facades\Hash; // パスワードHash化

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'kiho',
                'email' => 'kiho@example.com',
                'password' => Hash::make('password123'), // ハッシュ化
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'karin',
                'email' => 'karin@example.com',
                'password' => Hash::make('password123'), // ハッシュ化
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
