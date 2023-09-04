<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $pass = Hash::make('12345');

        $users = [
            [
                'email' => 'admin@mail.com',
                'password' => $pass,
                'password_confirm' => $pass,
                'user_type' => 'A',
                'is_active' => true,
                'is_verified' => true,
            ],
            [
                'email' => 'member@mail.com',
                'password' => $pass,
                'password_confirm' => $pass,
                'user_type' => 'M',
                'is_active' => true,
                'is_verified' => true,
            ]
        ];

        foreach ($users as $user) {
            $user_has_exist = DB::table('users')->where('email', '=', $user['email'])->exists();

            if (!$user_has_exist) {
                DB::table('users')->insert($user);
            }
        }
    }
}
