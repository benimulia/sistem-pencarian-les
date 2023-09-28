<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;
use App\Models\KategoriBesar;
use App\Models\Kategori;
use App\Models\KategoriUtama;

class KategoriBesarController extends Controller
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

        $kategori = KategoriBesar::with('kategoriutama')->latest()->get();

        return view('kategoribesar.index', compact('kategori'), [
            "title" => "List Kategori Besar"
        ]);
    }

    public function kategoriutamaAll()
    {
        return KategoriUtama::orderBy('nama_kategori_utama', 'ASC')->get();
    }

    public function create()
    {
        //get kategori utama
        $kategoriutama = $this->kategoriutamaAll();

        return view('kategoribesar.create', compact('kategoriutama'),  [
            "title" => "Tambah Kategori Baru"
        ]);
    }

    public function edit($id)
    {
        //get kategori utama
        $kategoriutama = $this->kategoriutamaAll();

        $kategori = KategoriBesar::find($id);
        return view('kategoribesar.edit', compact('kategori', 'kategoriutama'), [
            "title" => "Edit Kategori Besar"
        ]);
    }

    public function store(Request $request)
    {
        try {
            KategoriBesar::create([
                'id_kategori_utama' => $request->id_kategori_utama,
                'nama_kategori_besar' => $request->nama_kategori_besar,
            ]);
            return redirect()->route('kategoribesar.index')->with('success', 'Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('kategoribesar.create')->with('fail', 'Gagal menyimpan data. Silahkan coba lagi');
        }
    }

    public function update($id, Request $request)
    {
        try {
            DB::table('kategori_besar')->where('id_kategori_besar', $id)->update([
                'id_kategori_utama' => $request->id_kategori_utama,
                'nama_kategori_besar' => $request->nama_kategori_besar,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('kategoribesar.index')->with('success', 'Berhasil mengedit data');
        } catch (Exception $e) {
            return redirect()->route('kategoribesar.edit')->with('fail', 'Gagal mengedit data. Silahkan coba lagi');
        }
    }

    public function destroy($id)
    {
        $kategori = KategoriBesar::find($id);

        // Pengecekan apakah ada kategori yang terhubung dengan kategori besar yang akan dihapus
        $kategoriTerhubung = Kategori::where('id_kategori_besar', $id)->exists();

        if ($kategoriTerhubung) {
            return redirect()->route('kategoribesar.index')->with('fail', 'Gagal menghapus data. Terdapat kategori terhubung dengan kategori besar ini.');
        }

        try {
            $kategori->delete();
            return redirect()->route('kategoribesar.index')->with('success', 'Berhasil menghapus data');
        } catch (Exception $e) {
            return redirect()->route('kategoribesar.index')->with('fail', 'Gagal menghapus data. Silahkan coba lagi');
        }
    }
}
