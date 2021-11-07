<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Ekstrakulikuler;
use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PagesController extends Controller
{
    public function home() {
        return view('pages.home');
    }

    public function dataUser() {
        return view('pages.admin.data_user');
    }

    public function dataKriteria() {
        return view('pages.admin.data_kriteria');
    }

    public function dataAlternatif() {
        return view('pages.admin.data_alternatif');
    }

    public function biodata() {
        return view('pages.user.biodata');
    }

    public function wisata() {
        $wisatas = Alternatif::all();
        $kriterias = Kriteria::with('subKriterias')->get();

        if (empty($kriterias)) {
            Alert::error('Kriteria masih kosong', 'Gagal memilih wisata kriteria masih kosong');
            return redirect()->back();
        }

        return view('pages.user.wisata', compact(['kriterias','wisatas']));
    }
}
