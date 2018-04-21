<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder {

    public function run() {
        
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin'
        ]);
    }

}
