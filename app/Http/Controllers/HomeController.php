<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\TempatKursus;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserController $userController)
    {
        $this->middleware('auth');
        $this->userController = $userController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private $userController;

    public function index()
    {
        $userrole = $this->userController->getUserRole()->role_id;

        if ($userrole == 1) {
            $unverified = User::whereNull('email_verified_at')->count();

            return view('home', compact('unverified', 'userrole'), [
                "title" => "Dashboard"
            ]);
        }

        $userid = $this->userController->getUserId();

        $tempatkursus = TempatKursus::where('id_user', $userid)
            ->with('program')
            ->select('id_tempat_kursus', 'nama_tempat_kursus', 'id_user')
            ->withCount('program')
            ->get();
            
        return view('home', compact('userrole', 'tempatkursus'), [
            "title" => "Dashboard"
        ]);
    }


    public function userindex()
    {

        $kategori = Kategori::latest()->get();

        return view('welcome', compact('kategori'), [
            "title" => "Dashboard"
        ]);
    }
}
