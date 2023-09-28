<?php

namespace App\Http\Controllers;

use App\Models\KategoriBesar;
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

        $kategori = Kategori::with('kategoribesar')->latest()->get();

        return view('kategori.index', compact('kategori'), [
            "title" => "List Kategori"
        ]);
    }

    public function kategoribesarAll()
    {
        return KategoriBesar::orderBy('nama_kategori_besar', 'ASC')->get();
    }

    public function create()
    {
        //get kategori besar
        $kategoribesar = $this->kategoribesarAll();

        return view('kategori.create', compact('kategoribesar'), [
            "title" => "Tambah Kategori Baru"
        ]);
    }

    public function edit($id)
    {
        //get kategori besar
        $kategoribesar = $this->kategoribesarAll();

        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori', 'kategoribesar'), [
            "title" => "Edit Kategori"
        ]);
    }

    public function store(Request $request)
    {
        try {
            Kategori::create([
                'id_kategori_besar' => $request->id_kategori_besar,
                'nama_kategori' => $request->nama_kategori,
                'persen_populer' => $request->persen_populer,
                'persen_umum' => $request->persen_umum,
                'persen_unik' => $request->persen_unik,
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
                'id_kategori_besar' => $request->id_kategori_besar,
                'nama_kategori' => $request->nama_kategori,
                'persen_populer' => $request->persen_populer,
                'persen_unik' => $request->persen_unik,
                'persen_umum' => $request->persen_umum,
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
