<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nama = [
            'Rumah adat tradisional Nias-Tumori',
            'Pantai Hoya',
            'Museum Pusaka Nias',
            'Gua Togindrawa',
            'Taman Ya’ahowu',
            'Air Terjum Humogo',
            '1001 Nusa Lima',
            'Pantai Malaga',
            'Taman Doa Bunda Maria',
            'Muara Indah'
        ];

        foreach ($nama as $key => $n) {
            DB::table('alternatif')->insert([
                'nama' => $n,
            ]);
        }
    }
}
