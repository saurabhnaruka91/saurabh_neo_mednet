<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'role_id' => '1',
            'name' => 'Super Admin',
            'email' => 'saurabh.naruka+sa@neosoftmail.com',
            'is_deleted' => '0',
            'password' => bcrypt('pass@admin'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'User',
            'email' => 'saurabh.naruka+user@neosoftmail.com',
            'is_deleted' => '0',
            'password' => bcrypt('pass@user'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'role_id' => '3',
            'name' => 'Sales',
            'email' => 'saurabh.naruka+sales@neosoftmail.com',
            'is_deleted' => '0',
            'password' => bcrypt('pass@sales'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
