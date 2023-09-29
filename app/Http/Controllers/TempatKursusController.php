<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\TempatKursus;
use App\Models\Program;

use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cabang;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;



class TempatKursusController extends Controller
{
    private $userController;

    public function __construct(UserController $userController)
    {
        $this->middleware('permission:tempat-kursus-list|tempat-kursus-create|tempat-kursus-edit|tempat-kursus-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:tempat-kursus-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tempat-kursus-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tempat-kursus-delete', ['only' => ['destroy']]);

        $this->userController = $userController;
    }


    public function kategoriAll()
    {
        return Kategori::orderBy('nama_kategori', 'ASC')->get();
    }

    public function index()
    {
        $userrole = $this->userController->getUserRole()->role_id;
        $userid = $this->userController->getUserRole()->model_id;

        // Check apakah user adalah superadmin atau bukan
        if ($userrole != 1) {
            $tempatkursus = TempatKursus::with('kategori')->where('id_user', '=', $userid)->latest()->get();
        } else {
            $tempatkursus = TempatKursus::with('kategori')->latest()->get();
        }

        return view('tempatkursus.index', compact('tempatkursus'), [
            "title" => "List Tempat Kursus"
        ]);
    }

    public function create()
    {
        // Mendapatkan semua kategori yang tersedia
        $kategori = $this->kategoriAll();

        // Mendapatkan semua user (jika diperlukan)
        $users = $this->userController->userAll();

        // Mendapatkan peran pengguna (jika diperlukan)
        $userrole = $this->userController->getUserRole()->role_id;

        return view('tempatkursus.create', compact('kategori', 'userrole', 'users'), [
            "title" => "Tambah Tempat Kursus"
        ]);
    }


    public function edit($id)
    {
        // Mendapatkan semua kategori yang tersedia
        $kategori = $this->kategoriAll();

        // Mendapatkan tempat kursus yang akan diedit beserta kategori-kategorinya
        $tempatkursus = TempatKursus::with('kategori')->find($id);

        return view('tempatkursus.edit', compact('tempatkursus', 'kategori'), [
            "title" => "Edit Tempat Kursus"
        ]);
    }


    public function store(Request $request)
    {
        try {
            if ($request->foto_utama != null) {
                $extensionfotoutama = $request->foto_utama->getClientOriginalExtension();

                $nameImageUtama = $request->nama_tempat_kursus . "-" . time() . "." . $extensionfotoutama;
                $request->foto_utama->move(public_path() . '/gambar/tempatkursus/foto-utama', $nameImageUtama);
            } else {
                $nameImageUtama = null;
            }

            // Membuat tempat kursus
            $tempatkursus = TempatKursus::create([
                'id_user' => $request->id_user,
                'nama_tempat_kursus' => $request->nama_tempat_kursus,
                'no_telp' => $request->no_telp,
                'foto_utama' => $nameImageUtama,
                'alamat' => $request->alamat,
                'latitude' => $request->lat,
                'longitude' => $request->lng,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
            ]);

            // Attach kategori-kategori yang dipilih
            // Attach kategori-kategori yang dipilih
            if ($request->has('id_kategori')) {
                foreach ($request->id_kategori as $kategoriId) {
                    $tempatkursus->kategori()->attach($kategoriId);
                }
            }

            return redirect()->route('tempatkursus.index')->with('success', 'Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('tempatkursus.index')->with('fail', 'Gagal construct data. Silahkan coba lagi');
        }
    }

    public function update($id, Request $request)
    {
        $tempatkursus = TempatKursus::find($id);
        $fotoutama = $tempatkursus->foto_utama;

        try {
            if ($request->foto_utama != null) {
                $extensionfotoutama = $request->foto_utama->getClientOriginalExtension();

                $file = public_path('/gambar/tempatkursus/foto-utama/') . $fotoutama;
                if (file_exists($file)) {
                    unlink($file);
                }
                // format nama foto + upload foto
                $nameImageUtama = $request->nama_tempat_kursus . "-" . time() . "." . $extensionfotoutama;
                $request->foto_utama->move(public_path() . '/gambar/tempatkursus/foto-utama', $nameImageUtama);
            } else {
                // jika tidak ttp gunakan data dari db foto lama utk namane
                $nameImageUtama = $tempatkursus->foto_utama;
            }

            // Mengupdate tempat kursus
            $tempatkursus->update([
                'nama_tempat_kursus' => $request->nama_tempat_kursus,
                'alamat' => $request->alamat,
                'latitude' => $request->lat,
                'longitude' => $request->lng,
                'no_telp' => $request->no_telp,
                'foto_utama' => $nameImageUtama,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
            ]);

            // Menyinkronkan kategori-kategori yang dipilih
            $tempatkursus->kategori()->sync($request->id_kategori);

            return redirect()->route('tempatkursus.index')->with('success', 'Berhasil mengedit data');
        } catch (Exception $e) {
            return redirect()->route('tempatkursus.edit', ['id' => $tempatkursus->id_tempat_kursus])->with('fail', 'Gagal construct data. Silahkan coba lagi');
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $tempatkursus = TempatKursus::find($id);
            $fotoutama = $tempatkursus->foto_utama;

            //delete foto
            $file = public_path('/gambar/tempatkursus/foto-utama/') . $fotoutama;
            if (file_exists($file)) {
                unlink($file);
            }

            /** delete foto program */
            $program = DB::table('program')->where('id_tempat_kursus', $id)->get();
            foreach ($program as $result) {
                //delete foto
                $fotoprogram = public_path('/gambar/tempatkursus/foto-program/') . $result->foto_program;
                if (file_exists($fotoprogram)) {
                    unlink($fotoprogram);
                }
            }

            //hapus program
            Program::where('id_tempat_kursus', $id)->delete();

            //hapus tempat kursus
            TempatKursus::destroy($id);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('fail', 'Gagal menghapus data. Silahkan coba lagi');
        }
    }



}