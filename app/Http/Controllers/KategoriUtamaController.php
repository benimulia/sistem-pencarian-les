<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;
use App\Models\KategoriUtama;
use App\Models\KategoriBesar;
use App\Models\Kategori;

class KategoriUtamaController extends Controller
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

        $kategori = KategoriUtama::latest()->get();

        return view('kategoriutama.index', compact('kategori'), [
            "title" => "List Kategori Utama"
        ]);
    }

    public function create()
    {
        return view('kategoriutama.create', [
            "title" => "Tambah Kategori Baru"
        ]);
    }

    public function edit($id)
    {
        $kategori = KategoriUtama::find($id);
        return view('kategoriutama.edit', compact('kategori'), [
            "title" => "Edit Kategori Utama"
        ]);
    }

    public function store(Request $request)
    {
        try {
            Kategoriutama::create([
                'nama_kategori_utama' => $request->nama_kategori_utama,
            ]);
            return redirect()->route('kategoriutama.index')->with('success', 'Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('kategoriutama.create')->with('fail', 'Gagal menyimpan data. Silahkan coba lagi');
        }
    }

    public function update($id, Request $request)
    {
        try {
            DB::table('kategori_utama')->where('id_kategori_utama', $id)->update([
                'nama_kategori_utama' => $request->nama_kategori_utama,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('kategoriutama.index')->with('success', 'Berhasil mengedit data');
        } catch (Exception $e) {
            return redirect()->route('kategoriutama.edit')->with('fail', 'Gagal mengedit data. Silahkan coba lagi');
        }
    }

    public function destroy($id)
    {
        $kategori = KategoriUtama::find($id);

        // Pengecekan apakah ada kategori yang terhubung dengan kategori besar yang akan dihapus
        $kategoriTerhubung = KategoriBesar::where('id_kategori_utama', $id)->exists();

        if ($kategoriTerhubung) {
            return redirect()->route('kategoriutama.index')->with('fail', 'Gagal menghapus data. Terdapat kategori terhubung dengan kategori utama ini.');
        }

        try {
            $kategori->delete();
            return redirect()->route('kategoriutama.index')->with('success', 'Berhasil menghapus data');
        } catch (Exception $e) {
            return redirect()->route('kategoriutama.index')->with('fail', 'Gagal menghapus data. Silahkan coba lagi');
        }
    }
}
