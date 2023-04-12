<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\TempatKursus;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\RekapBon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cabang;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;
use App\Models\PenjualanDetail;


class TempatKursusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tempat-kursus-list|tempat-kursus-create|tempat-kursus-edit|tempat-kursus-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:tempat-kursus-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tempat-kursus-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tempat-kursus-delete', ['only' => ['destroy']]);
    }


    public function kategoriAll()
    {
        return Kategori::orderBy('nama_kategori', 'ASC')->get();
    }

    public function index()
    {
        $tempatkursus = TempatKursus::with('kategori')->latest()->get();
        return view('tempatkursus.index', compact('tempatkursus'), [
            "title" => "List Tempat Kursus"
        ]);

    }

    public function create()
    {
        //get kategori
        $kategori = $this->kategoriAll();

        return view('tempatkursus.create', compact('kategori'), [
            "title" => "Tambah Tempat Kursus"
        ]);
    }

    public function edit($id)
    {
        $tempatkursus = TempatKursus::with('pelanggan', 'cabang')->where('id_tempat_kursus', $id)->first();
        $program = DB::table('tempat_kursus')
            ->join('program', 'tempat_kursus.id_tempat_kursus', '=', 'program.id_tempat_kursus')
            ->select('tempat_kursus.*', 'program.*')
            ->where('program.id_tempat_kursus', $id)
            ->get();
        return view('tempatkursus.edit', compact('tempatkursus', 'program'), [
            "title" => "Edit Data Tempat Kursus"
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

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            /** delete record table penjualan_detail */
            $penjualandetail = DB::table('penjualan_detail')->where('id_penjualan', $id)->get();
            foreach ($penjualandetail as $id_penjualan_detail) {
                $stokproduk = DB::table('produk')->where('id_produk', $id_penjualan_detail->id_produk)->select('stok')->first();

                if ($stokproduk != null) {
                    $stokproduk = $stokproduk->stok;

                    $stokupdate = $stokproduk + $id_penjualan_detail->qty;
                    $update = [
                        'stok' => $stokupdate,
                        'updated_at' => Carbon::now(),
                        'updated_by' => "batal jual - " . auth()->user()->name,
                    ];

                    Produk::where('id_produk', $id_penjualan_detail->id_produk)->update($update);
                }
                DB::table('penjualan_detail')->where('id_penjualan_detail', $id_penjualan_detail->id_penjualan_detail)->delete();
            }

            $penjualan = Penjualan::where('id_penjualan', $id)->first();
            $rekap_bon = RekapBon::where('id_penjualan', $id)->first();
            if ($penjualan->jenis_transaksi == "Bon" && $rekap_bon != null) {
                $id_rekap_bon = $rekap_bon->id_bon;

                DB::table('rekap_bayar_bon')->where('id_bon', $id_rekap_bon)->delete();
                /** delete record table rekap_bon */
                RekapBon::destroy($id_rekap_bon);
            }
            /** delete record table penjualan */
            Penjualan::destroy($id);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('fail', 'Gagal menghapus data. Silahkan coba lagi');
        }
    }


    function format_hari_tanggal($waktu)
    {
        $hari_array = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );
        $hr = date('w', strtotime($waktu));
        $hari = $hari_array[$hr];
        $tanggal = date('j', strtotime($waktu));
        $bulan_array = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];
        $tahun = date('Y', strtotime($waktu));
        $jam = date('H:i:s', strtotime($waktu));

        //untuk menampilkan hari, tanggal bulan tahun jam
        //return "$hari, $tanggal $bulan $tahun $jam";

        //untuk menampilkan hari, tanggal bulan tahun
        return "$hari, $tanggal $bulan $tahun";
    }

    public function selesai($id)
    {
        $penjualan = Penjualan::where('id_penjualan', $id)->first();

        return view('penjualan.selesai', compact('penjualan'), [
            "title" => "Transaksi Penjualan"
        ]);
    }

    public function notaKecil($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'cabang')->where('id_penjualan', $id)->first();
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', $id)
            ->get();

        $tot_item = $detail->sum('qty');

        return view('penjualan.nota_kecil', compact('penjualan', 'detail', 'tot_item'));
    }

    public function notaBesar($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'cabang')->where('id_penjualan', $id)->first();
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', $id)
            ->get();

        return view('penjualan.nota_besar', compact('penjualan', 'detail'));
    }
}
