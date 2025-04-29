<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ServiceCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    //    $user = User::create([
    //         'name' => 'Admin Account',
    //         'phone_number'=>'0720882595',
    //         'email' => 'admin@gmail.com',
    //         'password'=> bcrypt('password'),
    //     ]);

    //     $user->assignRole('admin');


    $service = ServiceCategory::create([
        'name'=>'Wedding Photography',
        'description'=>'Wedding Photography',
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now(),
    ]);

    }
}
