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
        $unverified = User::whereNull('email_verified_at')->count();

        return view('home', compact('unverified','userrole'), [
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
