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
        
        //check superadmin atau bukan
        if($userrole != 1){            
            $tempatkursus = TempatKursus::with('kategori')->where('id_user','=',$userid)->latest()->get();
        }else{
            $tempatkursus = TempatKursus::with('kategori')->latest()->get();
        }
                
        return view('tempatkursus.index', compact('tempatkursus'), [
            "title" => "List Tempat Kursus"
        ]);
    }

    public function create()
    {
        //get kategori
        $kategori = $this->kategoriAll();

        //get user
        $users = $this->userController->userAll();

        //get userrole
        $userrole = $this->userController->getUserRole()->role_id;

        return view('tempatkursus.create', compact('kategori', 'userrole', 'users'), [
            "title" => "Tambah Tempat Kursus"
        ]);
    }

    public function edit($id)
    {
        $kategori = $this->kategoriAll();
        $tempatkursus = TempatKursus::with('kategori')->find($id);
        return view('tempatkursus.edit', compact('tempatkursus','kategori'), [
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
        } catch (Exception $e) {
            return redirect()->route('tempatkursus.index')->with('fail', 'Gagal construct data. Silahkan coba lagi');
        }

        try {
            TempatKursus::create([
                'id_user' => $request->id_user,
                'id_kategori' => $request->id_kategori,
                'nama_tempat_kursus' => $request->nama_tempat_kursus,
                'no_telp' => $request->no_telp,
                'foto_utama' => $nameImageUtama,
                'alamat' => $request->alamat,
            ]);
            return redirect()->route('tempatkursus.index')->with('success', 'Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('tempatkursus.create')->with('fail', 'Gagal menyimpan data. Silahkan coba lagi');
        }
    }

    public function update($id, Request $request)
    {
        $tempatkursus = TempatKursus::find($id);
        $fotoutama = $tempatkursus->foto_utama;

        // jika request mengandung foto baru maka hapus dan bikin format nama baru
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
        } catch (Exception $e) {
            return redirect()->route('tempatkursus.edit', ['id' => $tempatkursus->id_tempat_kursus])->with('fail', 'Gagal construct data. Silahkan coba lagi');
        }
        
        try {
            DB::table('tempat_kursus')->where('id_tempat_kursus', $id)->update([
                'nama_tempat_kursus' => $request->nama_tempat_kursus,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'foto_utama' => $nameImageUtama,                
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('tempatkursus.index')->with('success', 'Berhasil mengedit data');
        } catch (Exception $e) {
            return redirect()->route('tempatkursus.edit')->with('fail', 'Gagal mengedit data. Silahkan coba lagi');
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
            Program::where('id_tempat_kursus',$id)->delete();

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
