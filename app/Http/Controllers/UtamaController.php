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
    {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategori = Kategori::latest()->take(3)->get();
        $kursuspopuler = TempatKursus::with('kategori')->orderBy('jumlah_pengunjung','ASC')->take(6)->get();

        return view('utama.index',compact('kategori','kursuspopuler'));
    }

    public function kategori($id)
    {
        $kategori = Kategori::find($id);
        $tempatkursus = TempatKursus::where('id_kategori','=',$id)->orderBy('jumlah_pengunjung','ASC')->get();

        return view('utama.kategori',compact('tempatkursus','kategori'));
    }


}
