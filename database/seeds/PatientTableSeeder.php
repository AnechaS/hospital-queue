<?php

use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            'firstname' => 'อลัน',
            'lastname' => 'วอคเกอร์',
            'hn' => '001',
            'dob' => '1995-09-19',
            'age' => '23',
            'gender' => 1,
            'card_id' => '0000000000001',
            'user_id' => 1,
        ]);
    }
}
