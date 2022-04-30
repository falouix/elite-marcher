<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       /*  User::factory()
        ->create(
          [
            'email' => 'test@gmail.coom',
            'user_type' => 'lawyer',

          ]
        );
      User::factory()
        ->create(
          [
            'email' => 'test2@gmail.coom',
            'user_type' => 'lawyer',
          ]
        ); */
  
      User::factory()
        ->count(30000)
        ->create([
            'user_type' => 'ِchairman',
        ]);
    }
}
