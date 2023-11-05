<?php

namespace App\Http\Controllers;


use App\Models\User;
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
        $unverified = User::whereNull('email_verified_at')->count();

        return view('home',compact('unverified'), [
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
