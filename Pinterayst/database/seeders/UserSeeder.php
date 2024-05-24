<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'user_name' => "admin",
            'user_password' => bcrypt("admin"),
            'user_url' => "images/profile1.jpg",
            'user_email' => "admin@gmail.com",
            'user_role' => "admin",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'user_name' => "ryan",
            'user_password' => bcrypt("ryan"),
            'user_url' => "images/profile.jpg",
            'user_email' => "wantouwray@gmail.com",
            'user_role' => "user",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        User::factory(40)->create();
    }
}
