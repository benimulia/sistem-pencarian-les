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
    public function index()
    {
        $kategori = Kategori::latest()->take(3)->get();
        $kursuspopuler = TempatKursus::with('kategori')->orderBy('jumlah_pengunjung', 'ASC')->take(6)->get();

        return view('utama.index', compact('kategori', 'kursuspopuler'));
    }

    public function kategori($id)
    {
        $kategori = Kategori::find($id);
        $tempatkursus = TempatKursus::where('id_kategori', '=', $id)->orderBy('jumlah_pengunjung', 'ASC')->get();

        return view('utama.kategori', compact('tempatkursus', 'kategori'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $kategori = Kategori::all();

        $selected_kategoris = $request->input('kategori', []);
        $selected_lokasis = $request->input('lokasi', []);

        $tempat_kursus = TempatKursus::where('nama_tempat_kursus', 'LIKE', "%$query%");

        if (count($selected_lokasis) > 0) {
            $tempat_kursus = $tempat_kursus->where(function ($query) use ($selected_lokasis) {
                foreach ($selected_lokasis as $lokasi) {
                    $query->orWhere('alamat', 'LIKE', "%$lokasi%");
                }
            });


        }

        if (count($selected_kategoris) > 0) {
            $tempat_kursus = $tempat_kursus->whereIn('id_kategori', $selected_kategoris);
        }

        // Add orderBy 
        $tempat_kursus = $tempat_kursus->orderBy('jumlah_pengunjung', 'desc')->get();

        return view('utama.search', compact('tempat_kursus', 'query', 'kategori', 'selected_kategoris', 'selected_lokasis'));
    }

    public function showTempatKursus($id)
    {
        $tempatkursus = TempatKursus::with('program')->findOrFail($id);

        return view('utama.tempatkursus', compact('tempatkursus'));
    }


}