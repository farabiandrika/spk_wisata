<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PerhitunganController extends Controller
{
    public function hitung(Request $request) {
        try {
            // Mengambil data Alternatif dan Kriteria
            $alternatifs = Alternatif::all();
            $kriterias = Kriteria::all();

            // Konversi Bentuk Inputan sehingga menjadi group
            $data = [];
            foreach ($alternatifs as $keyEks => $alternatif) {
                foreach ($kriterias as $keyKrit => $kriteria) {
                    $data[$keyEks][$keyKrit] = $request[$alternatif->id.'_pilihan_'.$kriteria->id];
                }
            }

            // Normalisasi Kriteria
            $normalisasiKriteria = self::normalisasiKriteria($kriterias);

            // Normalisasi Pilihan
            $normalisasiPilihan = self::normalisasiPilihan($data, $kriterias);

            // Perhitungan SAW (Alternatif * Normalisasi Kriteria)
            $countSAW = [];
            for ($i=0; $i < count($normalisasiPilihan); $i++) { 
                for ($j=0; $j < count($normalisasiPilihan[$i]); $j++) { 
                    $countSAW[$i][$j] = $normalisasiPilihan[$i][$j] * $normalisasiKriteria[$j];
                }
            }

            // Penjumlahan Hasil SAW
            $count_result = [];
            for ($i=0; $i < count($countSAW); $i++) { 
                $temp = 0;
                for ($j=0; $j < count($countSAW[$i]); $j++) { 
                    $temp += $countSAW[$i][$j];
                }
                $count_result[$i] = $temp;
            }

            // return response()->json($countSAW, Response::HTTP_OK);

            // Penggabungan
            $result = collect();
            foreach ($alternatifs as $key => $alternatif) {
                $temp = [];
                $temp['id'] = $alternatif->id;
                $temp['nama'] = $alternatif->nama;
                $temp['hasil'] = round($count_result[$key],2);
                $temp['perhitungan'] = $countSAW[$key];
                $result->push($temp);
            }

            $sorted = $result->sortByDesc('hasil');

            $response = [
                'message' => 'Calculation Completed',
                'data' => $sorted->values()->all(),
                'jumlah_kriteria' => count($kriterias)
            ];
            
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed '.$e,
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    private static function normalisasiKriteria($kriterias) {
        $data = [];
        $totalBobot = 0;
        foreach ($kriterias as $key => $kriteria) {
            $totalBobot += $kriteria->bobot;
        }

        foreach ($kriterias as $key => $kriteria) {
            $data[$key] = round($kriteria->bobot/$totalBobot,3);
        }

        return $data;
    }

    private static function normalisasiPilihan($data, $kriterias) {
        // Mencari Pembagi
        $newData = [];
        $pembagi = [];
        $costOrBenefit = [];
        $ternormalisasi = [];
        foreach ($kriterias as $i => $kriteria) {
            $newData[$i] = [];
            foreach ($data as $j => $d) {
                $newData[$i][$j] = $d[$i];
            }   

            if ($kriteria->benefit === 1) {
                $pembagi[$i] = max($newData[$i]);
                $costOrBenefit[$i] = 1;
            } else {
                $pembagi[$i] = min($newData[$i]);
                $costOrBenefit[$i] = 0;
            }
        }

        // Normalisasi Pilihan
        foreach ($data as $i => $d) {
            for ($j=0; $j < count($d); $j++) { 
                if ($costOrBenefit[$j] === 1) {
                    // Benefit
                    $ternormalisasi[$i][$j] = $d[$j]/$pembagi[$j];
                } else {
                    // Cost
                    $ternormalisasi[$i][$j] = $pembagi[$j]/$d[$j];
                }
            }
        }

        return $ternormalisasi;
    }
}
