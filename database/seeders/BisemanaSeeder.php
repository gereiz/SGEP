<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class BisemanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ['inicio'=>'2022-05-09', 'fim'=> '2022-05-22'],
            ['inicio'=>'2022-05-23', 'fim'=> '2022-06-05'],
            ['inicio'=>'2022-06-06', 'fim'=> '2022-06-19'],
            ['inicio'=>'2022-06-20', 'fim'=> '2022-07-03'],
            ['inicio'=>'2022-07-04', 'fim'=> '2022-07-17'],
            ['inicio'=>'2022-07-18', 'fim'=> '2022-07-31'],
            ['inicio'=>'2022-08-01', 'fim'=> '2022-08-14'],
            ['inicio'=>'2022-08-15', 'fim'=> '2022-08-28'],
            ['inicio'=>'2022-08-29', 'fim'=> '2022-09-11'],
            ['inicio'=>'2022-09-12', 'fim'=> '2022-09-25'],
            ['inicio'=>'2022-09-26', 'fim'=> '2022-10-09'],
            ['inicio'=>'2022-10-10', 'fim'=> '2022-10-23'],
            ['inicio'=>'2022-10-24', 'fim'=> '2022-11-06'],
            ['inicio'=>'2022-11-07', 'fim'=> '2022-11-20'],
            ['inicio'=>'2022-11-21', 'fim'=> '2022-12-04'],
            ['inicio'=>'2022-12-05', 'fim'=> '2022-12-18'],
            ['inicio'=>'2022-12-19', 'fim'=> '2023-01-01'],
            
        ];

        DB::table('bisemanas')->insert($data);
    }
}
