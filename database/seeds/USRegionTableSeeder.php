<?php

use Illuminate\Database\Seeder;

class USRegionTableSeeder extends Seeder {

    public function run() {
        $file = storage_path('app/us_states.csv');
        $filedata = \Excel::load($file, function($reader) {
            
        })->get();
        $rows = $filedata->toArray();
        
        DB::table('usa_states')->delete();
        DB::table('usa_states')->insert($rows);
//        DB::table('regions')->insert([
//            'country' => 'IN',
//            'state' => 'GJ',
//            'state_fullname' => 'Gujarat',
//            'type' => 'state',
//        ]);
    }

}
