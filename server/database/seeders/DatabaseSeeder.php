<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Brand::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Product::factory(20)->create();
        $users = \App\Models\User::factory(8)->create();
        $roles = \App\Models\Role::factory(3)->create();

        // Associate roles with users
        $users->each(function ($user) use ($roles) {
            // $user->roles()->attach($roles->random(), ['additional_column' => 'value']);
            $user->roles()->attach($roles->random());
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
