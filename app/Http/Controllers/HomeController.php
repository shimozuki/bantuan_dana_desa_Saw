<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $alternatif = Alternatif::count();
        $kriteriacount = Kriteria::count();

        // Ambil data perangkingan dari model
        $kriteriaData = Kriteria::with('crips')->get();
        $penilaian = Penilaian::with('crips', 'alternatif')->get();

        $minMax = [];
        foreach ($kriteriaData as $kriteria) {
            foreach ($penilaian as $nilai) {
                if ($kriteria->id == $nilai->crips->kriteria_id) {
                    $minMax[$kriteria->id][] = $nilai->crips->bobot;
                }
            }
        }

        // Normalisasi
        $normalisasi = [];
        foreach ($penilaian as $nilai) {
            foreach ($kriteriaData as $kriteria) {
                if ($kriteria->id == $nilai->crips->kriteria_id) {
                    if ($kriteria->attribut == 'Benefit') {
                        $normalisasi[$nilai->alternatif->nama_alternatif][$kriteria->id] =
                            $nilai->crips->bobot / max($minMax[$kriteria->id]);
                    } elseif ($kriteria->attribut == 'Cost') {
                        $normalisasi[$nilai->alternatif->nama_alternatif][$kriteria->id] =
                            min($minMax[$kriteria->id]) / $nilai->crips->bobot;
                    }
                }
            }
        }

        // Perangkingan
        $rank = [];
        foreach ($normalisasi as $nama => $nilai) {
            foreach ($kriteriaData as $kriteria) {
                $rank[$nama][] = $nilai[$kriteria->id] * $kriteria->bobot;
            }
        }

        $ranking = [];
        foreach ($rank as $nama => $nilai) {
            $ranking[$nama] = array_sum($nilai);
        }

        $jumlahLayak = 0;
        $jumlahTidakLayak = 0;

        foreach ($ranking as $total) {
            if ($total > 0.6) {
                $jumlahLayak++;
            } elseif ($total > 0.5) {
                $jumlahTidakLayak++;
            }
        }

        return view('admin.home', compact('alternatif', 'kriteriacount', 'jumlahLayak', 'jumlahTidakLayak'));
    }
}
