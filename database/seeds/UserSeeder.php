<?php

use App\Role;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
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
        // User::truncate();
        // DB::table('role_user')->truncate();
        $faker = Faker::create();

        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => $faker->name,
            'email' => 'admin@email.com',
            'password' => Hash::make('password')
        ]);

        $author = User::create([
            'name' => $faker->name,
            'email' => 'author@email.com',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'name' => $faker->name,
            'email' => 'user@email.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
    }
}
