<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriterias = Kriteria::all();

        $biaya_masuk = [
            ['nama' => '0 - 2000', 'keterangan' => 'Sangat Murah', 'nilai' => 0, 'kriteria_id' => 1],
            ['nama' => '3000 - 5000', 'keterangan' => 'Murah', 'nilai' => 0.25, 'kriteria_id' => 1],
            ['nama' => '6000 - 8000', 'keterangan' => 'Sedang', 'nilai' => 0.5, 'kriteria_id' => 1],
            ['nama' => '9000 - 11000', 'keterangan' => 'Mahal', 'nilai' => 0.75, 'kriteria_id' => 1],
            ['nama' => '12000 - 14000', 'keterangan' => 'Sangat Mahal', 'nilai' => 1, 'kriteria_id' => 1],
        ];

        $jarak_bandara = [
            ['nama' => '1 Km - 10 Km', 'keterangan' => 'Sangat Dekat', 'nilai' => 1, 'kriteria_id' => 2],
            ['nama' => '11 Km - 20 Km', 'keterangan' => 'Dekat', 'nilai' => 0.75, 'kriteria_id' => 2],
            ['nama' => '21 Km - 30 Km', 'keterangan' => 'Sedang', 'nilai' => 0.5, 'kriteria_id' => 2],
            ['nama' => '31 Km - 40 Km', 'keterangan' => 'Jauh', 'nilai' => 0.25, 'kriteria_id' => 2],
            ['nama' => '41 Km - 50 Km', 'keterangan' => 'Sangat Jauh', 'nilai' => 0, 'kriteria_id' => 2],
        ];

        $popularitas = [
            ['nama' => '41 Org - 50 Org', 'keterangan' => 'Sangat Ramai', 'nilai' => 1, 'kriteria_id' => 3],
            ['nama' => '31 Org - 40 Org', 'keterangan' => 'Ramai', 'nilai' => 0.75, 'kriteria_id' => 3],
            ['nama' => '21 Org - 30 Org', 'keterangan' => 'Cukup Ramai', 'nilai' => 0.5, 'kriteria_id' => 3],
            ['nama' => '11 Org - 20 Org', 'keterangan' => 'Kurang Ramai', 'nilai' => 0.25, 'kriteria_id' => 3],
            ['nama' => '1 Org - 10 Org', 'keterangan' => 'Tidak Ramai', 'nilai' => 0, 'kriteria_id' => 3],
        ];

        $keamanan = [
            ['nama' => null, 'keterangan' => 'Sangat Aman', 'nilai' => 1, 'kriteria_id' => 4],
            ['nama' => null, 'keterangan' => 'Aman', 'nilai' => 0.75, 'kriteria_id' => 4],
            ['nama' => null, 'keterangan' => 'Cukup Aman', 'nilai' => 0.5, 'kriteria_id' => 4],
            ['nama' => null, 'keterangan' => 'Tidak Aman', 'nilai' => 0.25, 'kriteria_id' => 4],
            ['nama' => null, 'keterangan' => 'Sangat Tidak Aman', 'nilai' => 0, 'kriteria_id' => 4],
        ];

        $sarana_fasilitas = [
            ['nama' => null, 'keterangan' => 'Sangat Lengkap', 'nilai' => 1, 'kriteria_id' => 5],
            ['nama' => null, 'keterangan' => 'Lengkap', 'nilai' => 0.75, 'kriteria_id' => 5],
            ['nama' => null, 'keterangan' => 'Cukup Lengkap', 'nilai' => 0.5, 'kriteria_id' => 5],
            ['nama' => null, 'keterangan' => 'Tidak Lengkap', 'nilai' => 0.25, 'kriteria_id' => 5],
            ['nama' => null, 'keterangan' => 'Sangat Tidak Lengkap', 'nilai' => 0, 'kriteria_id' => 5],
        ];

        for ($i=0; $i < 5; $i++) { 
            DB::table('sub_kriterias')->insert($biaya_masuk[$i]);
            DB::table('sub_kriterias')->insert($jarak_bandara[$i]);
            DB::table('sub_kriterias')->insert($popularitas[$i]);
            DB::table('sub_kriterias')->insert($keamanan[$i]);
            DB::table('sub_kriterias')->insert($sarana_fasilitas[$i]);
        }

        // $allKriteria = [$subKriteria]
    }
}
