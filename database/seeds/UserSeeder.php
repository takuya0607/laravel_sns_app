<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      factory(User::class)->create([
          'name' => 'test1',
          'email' => 'test1@test.com',
          'email_verified_at' => now(),
          'password' => Hash::make('password123'),
      ]);
      factory(User::class)->create([
          'name' => 'test2',
          'email' => 'test2@test.com',
          'email_verified_at' => now(),
          'password' => Hash::make('password123'),
      ]);
      factory(User::class)->create([
          'name' => 'test3',
          'email' => 'test3@test.com',
          'email_verified_at' => now(),
          'password' => Hash::make('password123'),
      ]);
      factory(User::class)->create([
          'name' => 'test4',
          'email' => 'test4@test.com',
          'email_verified_at' => now(),
          'password' => Hash::make('password123'),
      ]);
      factory(User::class)->create([
          'name' => 'test5',
          'email' => 'test5@test.com',
          'email_verified_at' => now(),
          'password' => Hash::make('password123'),
      ]);
    }
}
