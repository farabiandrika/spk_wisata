<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('kriteria')->insert([
            'nama' => 'biaya masuk',
            'bobot' => 1,
            'benefit' => 0,
            'ternormalisasi' => 0.15,
        ]);
        // 2
        DB::table('kriteria')->insert([
            'nama' => 'jarak dari bandara',
            'bobot' => 2,
            'benefit' => 1,
            'ternormalisasi' => 0.25,
        ]);
        // 3
        DB::table('kriteria')->insert([
            'nama' => 'popularitas',
            'bobot' => 3,
            'benefit' => 1,
            'ternormalisasi' => 0.2,
        ]);
        // 4
        DB::table('kriteria')->insert([
            'nama' => 'keamanan',
            'bobot' => 4,
            'benefit' => 1,
            'ternormalisasi' => 0.25,
        ]);
        // 5
        DB::table('kriteria')->insert([
            'nama' => 'sarana dan fasilitas',
            'bobot' => 4,
            'benefit' => 1,
            'ternormalisasi' => 0.15,
        ]);
    }
}
