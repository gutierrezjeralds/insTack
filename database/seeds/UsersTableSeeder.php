<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "role_id"       => "1",
                "first_name"    => "Jerald",
                "last_name"     => "Gutierrez",
                "email"         => "jerald1617@gmail.com",
                "username"      => "jeraldSeña",
                "gender"        => "1",
                "birthday"      => Carbon::createFromFormat('Y-m-d', '1994-09-16')->toDateString(),
                "password"      => bcrypt('123456'),
                "created_at"    => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at"    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "role_id"       => "1",
                "first_name"    => "Sheila",
                "last_name"     => "Bathan",
                "email"         => "bathan.sy@gmail.com",
                "username"      => "sheilaBathan",
                "gender"        => "2",
                "birthday"      => Carbon::createFromFormat('Y-m-d', '1995-08-18')->toDateString(),
                "password"      => bcrypt('123456'),
                "created_at"    => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at"    => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        DB::table('users')->insert($users);
    }
}
