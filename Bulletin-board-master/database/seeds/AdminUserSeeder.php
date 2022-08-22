<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
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
            'username'=>'admin1',
            'email'=>'1111@gmail.com',
            'password'=>Hash::make('11111111'),
            'admin_role'=>'1'
        ]);
    }
}
