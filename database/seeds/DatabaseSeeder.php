<?php

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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
            'role' => 'Admin',
        ]);

        DB::table('types')->insert([
            'code' => 'BK',
            'description' => 'Book',
        ]);

        DB::table('branches')->insert([
            'branch_name' => 'LRC GASAN',
            'contact_no' => '09614025574',
            'location' => 'GASAN',
        ]);
    }
}
