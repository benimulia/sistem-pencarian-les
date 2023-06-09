<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;

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
        return view('home', [
            "title" => "Dashboard"
        ]);
    }

    public function userindex()
    {

        $kategori = Kategori::latest()->get();

        return view('welcome',compact('kategori'), [
            "title" => "Dashboard"
        ]);
    }



}
