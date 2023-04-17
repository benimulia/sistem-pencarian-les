<?php

namespace App\Http\Controllers;

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

class ProgramController extends Controller
{
    private $userController;

    public function __construct(UserController $userController)
    {
        $this->middleware('permission:program-list|program-create|program-edit|program-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:program-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:program-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:program-delete', ['only' => ['destroy']]);

        $this->userController = $userController;
    }

    public function index()
    {

        $userrole = $this->userController->getUserRole()->role_id;
        $userid = $this->userController->getUserRole()->model_id;
        
        //check superadmin atau bukan
        if($userrole != 1){                        
            $program = Program::with('tempatkursus')->where('id_user','=',$userid)->latest()->get();
        }else{
            $program = Program::with('tempatkursus')->latest()->get();
        }

        return view('program.index', compact('program'), [
            "title" => "List Program"
        ]);

    }

    public function create()
    {
        $userrole = $this->userController->getUserRole()->role_id;
        $userid = $this->userController->getUserRole()->model_id;

        //get user
        $users = $this->userController->userAll();

        //check superadmin atau bukan
        if($userrole != 1){                        
            $tempatkursus = TempatKursus::where('id_user','=',$userid)->latest()->get();
        }else{
            $tempatkursus = TempatKursus::latest()->get();
        }

        return view('program.create', compact('tempatkursus','userrole','users'), [
            "title" => "Tambah Program"
        ]);
    }

    public function edit($id)
    {
        $program = Program::find($id);

        $userrole = $this->userController->getUserRole()->role_id;
        $userid = $this->userController->getUserRole()->model_id;

        //check superadmin atau bukan
        if($userrole != 1){                        
            $tempatkursus = TempatKursus::where('id_user','=',$userid)->latest()->get();
        }else{
            $tempatkursus = TempatKursus::latest()->get();
        }

        return view('program.edit', compact('tempatkursus','userrole','program'), [
            "title" => "Edit Tempat Kursus"
        ]);
    }

    public function store(Request $request) 
    {
        try {
            if ($request->foto_program != null) {
                $extensionfotoutama = $request->foto_program->getClientOriginalExtension();

                $nameImageUtama = $request->nama_tempat_kursus . "-" . time() . "." . $extensionfotoutama;
                $request->foto_program->move(public_path() . '/gambar/tempatkursus/foto-program', $nameImageUtama);
            } else {
                $nameImageUtama = null;
            }
        } catch (Exception $e) {
            return redirect()->route('program.index')->with('fail', 'Gagal construct data. Silahkan coba lagi');
        }

        try {
            Program::create([
                'id_tempat_kursus' => $request->id_tempat_kursus,
                'id_user' => $request->id_user,
                'nama_program' => $request->nama_program,
                'deskripsi_program' => $request->deskripsi_program,
                'foto_program' => $nameImageUtama,
            ]);
            return redirect()->route('program.index')->with('success', 'Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('program.create')->with('fail', 'Gagal menyimpan data. Silahkan coba lagi');
        }
    }

    public function update($id, Request $request)
    {
        $program = Program::find($id);
        $fotoutama = $program->foto_program;

        // jika request mengandung foto baru maka hapus dan bikin format nama baru
        try {
            if ($request->foto_program != null) {
                $extensionfotoutama = $request->foto_program->getClientOriginalExtension();
                
                $file = public_path('/gambar/tempatkursus/foto-program/') . $fotoutama;
                if (file_exists($file)) {
                    unlink($file);
                }
                // format nama foto + upload foto
                $nameImageUtama = $request->nama_tempat_kursus . "-" . time() . "." . $extensionfotoutama;
                $request->foto_program->move(public_path() . '/gambar/tempatkursus/foto-program', $nameImageUtama);
            } else {
                // jika tidak ttp gunakan data dari db foto lama utk namane
                $nameImageUtama = $program->foto_program;
            }
        } catch (Exception $e) {
            return redirect()->route('program.edit', ['id' => $program->id_program])->with('fail', 'Gagal construct data. Silahkan coba lagi');
        }
        
        try {
            DB::table('program')->where('id_program', $id)->update([
                'id_tempat_kursus' => $request->id_tempat_kursus,
                'nama_program' => $request->nama_program,
                'deskripsi_program' => $request->deskripsi_program,
                'foto_program' => $nameImageUtama,                
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('program.index')->with('success', 'Berhasil mengedit data');
        } catch (Exception $e) {
            return redirect()->route('program.edit')->with('fail', 'Gagal mengedit data. Silahkan coba lagi');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $program = Program::find($id);
            $fotoutama = $program->foto_program;

            //delete foto
            $file = public_path('/gambar/tempatkursus/foto-program/') . $fotoutama;
            if (file_exists($file)) {
                unlink($file);
            }

            //hapus program
            Program::destroy($id);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('fail', 'Gagal menghapus data. Silahkan coba lagi');
        }
    }
}
