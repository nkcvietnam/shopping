<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_users')->insert([
            'user_name' => 'Andy',
            'email' => 'andy@gmail.com',
            'phone' => '0985 865 457',
            'birthday' => '1988-11-11',
            'role_id' => 1,
            'password' => bcrypt('123'),
            'address' => 'Vinh Phuc - Viet Nam'
        ]);
    }
}
