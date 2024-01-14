<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\TempatKursus;

class UtamaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $kategorikursuspopuler = Kategori::orderBy('persen_populer', 'DESC')->take(6)->get();
        $kategorikursusumum = Kategori::orderBy('persen_umum', 'DESC')->take(3)->get();
        // $kategorikursusunik = Kategori::orderBy('persen_unik', 'DESC')->take(3)->get();

        $tempat_kursus = TempatKursus::orderBy('jumlah_pengunjung', 'DESC')->take(12)->get();


        return view('utama.index', compact('kategorikursuspopuler', 'kategorikursusumum', 'tempat_kursus'));
    }

    public function kategori($id)
    {
        $kategori = Kategori::find($id);

        // Mendapatkan nilai maksimum di antara persen_populer, persen_umum, dan persen_unik
        $maksimum = max($kategori->persen_populer, $kategori->persen_umum, $kategori->persen_unik);

        // Menentukan variabel berdasarkan nilai maksimum
        $breadcrumb_kategori = '';

        if ($maksimum == $kategori->persen_populer) {
            $breadcrumb_kategori = 'Populer';
        } elseif ($maksimum == $kategori->persen_umum) {
            $breadcrumb_kategori = 'Umum';
        } elseif ($maksimum == $kategori->persen_unik) {
            $breadcrumb_kategori = 'Unik';
        }

        $tempatkursus = $kategori->tempatkursus()->orderBy('jumlah_pengunjung', 'ASC')->get();

        return view('utama.kategori', compact('tempatkursus', 'kategori', 'breadcrumb_kategori'));
    }


    public function kategoripopuler()
    {
        $namajeniskategori = "populer";
        $jeniskategori = Kategori::orderBy('persen_populer', 'DESC')->where('persen_populer', '>', 0)->get();
        return view('utama.jeniskategori', compact('jeniskategori', 'namajeniskategori'));
    }

    public function kategoriumum()
    {
        $namajeniskategori = "umum";
        $jeniskategori = Kategori::orderBy('persen_umum', 'DESC')->where('persen_umum', '>', 0)->get();
        return view('utama.jeniskategori', compact('jeniskategori', 'namajeniskategori'));
    }

    public function kategoriunik()
    {
        $namajeniskategori = "unik";
        $jeniskategori = Kategori::orderBy('persen_unik', 'DESC')->where('persen_unik', '>', 0)->get();
        return view('utama.jeniskategori', compact('jeniskategori', 'namajeniskategori'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $kategori = Kategori::all();

        $selected_kategoris = $request->input('kategori', []);
        $selected_lokasis = $request->input('lokasi', []);

        // Query 
        $tempat_kursus_query = TempatKursus::select('tempat_kursus.*')
            ->distinct()
            ->join('kategori_tempat_kursus', 'tempat_kursus.id_tempat_kursus', '=', 'kategori_tempat_kursus.tempat_kursus_id')
            ->join('kategori', 'kategori_tempat_kursus.kategori_id', '=', 'kategori.id_kategori')
            ->where('tempat_kursus.nama_tempat_kursus', 'LIKE', "%$query%")
            ->orWhere('kategori.nama_kategori', 'LIKE', "%$query%");

        // Filter berdasarkan kategori
        if (count($selected_kategoris) > 0) {
            $tempat_kursus_query = $tempat_kursus_query->whereHas('kategori', function ($query) use ($selected_kategoris) {
                $query->whereIn('id_kategori', $selected_kategoris);
            });
        }

        // Filter berdasarkan lokasi (alamat)
        if (count($selected_lokasis) > 0) {
            $tempat_kursus_query = $tempat_kursus_query->where(function ($query) use ($selected_lokasis) {
                foreach ($selected_lokasis as $lokasi) {
                    $query->orWhere('alamat', 'LIKE', "%$lokasi%");
                }
            });
        }

        // Eksekusi query
        $tempat_kursus = $tempat_kursus_query->get();

        // Sekarang urutkan berdasarkan jumlah pengunjung
        $tempat_kursus = $tempat_kursus->sortByDesc('jumlah_pengunjung');

        return view('utama.search', compact('tempat_kursus', 'query', 'kategori', 'selected_kategoris', 'selected_lokasis'));
    }



    public function showTempatKursus($id)
    {
        $tempatkursus = TempatKursus::with('program')->findOrFail($id);
        // Tambahkan 1 pada kolom jumlah_pengunjung
        $tempatkursus->increment('jumlah_pengunjung');

        return view('utama.tempatkursus', compact('tempatkursus'));
    }
}
