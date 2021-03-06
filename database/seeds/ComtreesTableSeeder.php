<?php

use Illuminate\Database\Seeder;

class ComtreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comtrees')->insert([
            'id' => 1,
            'name' => 'Company1',
            'amount' => 25,
            'total_amount' => 53,
            'parent' => 1
        ]);
        DB::table('comtrees')->insert([
            'id' => 2,
            'name' => 'Company2',
            'amount' => 13,
            'total_amount' => 18,
            'parent' => 1
        ]);
        DB::table('comtrees')->insert([
            'id' => 3,
            'name' => 'Company3',
            'amount' => 5,
            'total_amount' => 5,
            'parent' => 2
        ]);
        DB::table('comtrees')->insert([
            'id' => 4,
            'name' => 'Company4',
            'amount' => 10,
            'total_amount' => 10,
            'parent' => 1
        ]);
    }
}
