<?php

use Illuminate\Database\Seeder;

class StationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stations')->insert([
            [
                'station_name_th' => 'ห้องตรวจอายุรกรรม'
            ], [
                'station_name_th' => 'ห้องตรวจกุมาร(เด็ก)'
            ], [
                'station_name_th' => 'ห้องตรวจศัลยกรรม'
            ]
        ]);
    }
}
