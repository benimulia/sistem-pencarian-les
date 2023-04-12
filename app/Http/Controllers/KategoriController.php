<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;
use App\Models\Kategori;

class KategoriController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:kategori-list|kategori-create|kategori-edit|kategori-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:kategori-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kategori-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kategori-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        
        $kategori = Kategori::with('tempatkursus')->latest()->get();

        return view('kategori.index', compact('kategori'), [
            "title" => "List Kategori"
        ]);
    }

    public function create()
    {
        return view('kategori.create', [
            "title" => "Tambah Kategori Baru"
        ]);
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'), [
            "title" => "Edit Kategori"
        ]);
    }

    public function store(Request $request) 
    {
        try {
            Kategori::create([
                'nama_kategori' => $request->nama_kategori,
            ]);
            return redirect()->route('kategori.index')->with('success', 'Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('kategori.create')->with('fail', 'Gagal menyimpan data. Silahkan coba lagi');
        }
    }

    public function update($id, Request $request)
    {
        try {
            DB::table('kategori')->where('id_kategori', $id)->update([
                'nama_kategori' => $request->nama_kategori,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('kategori.index')->with('success', 'Berhasil mengedit data');
        } catch (Exception $e) {
            return redirect()->route('kategori.edit')->with('fail', 'Gagal mengedit data. Silahkan coba lagi');
        }
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        try {
            $kategori->delete();
            return redirect()->route('kategori.index')->with('success', 'Berhasil menghapus data');
        } catch (Exception $e) {
            return redirect()->route('kategori.index')->with('fail', 'Gagal menghapus data. Silahkan coba lagi');
        }
    }
}
