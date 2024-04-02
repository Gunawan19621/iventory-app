<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pabrik;
use App\Models\ListBarang;
use App\Models\SuratJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPerhariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("index");
        $data = [
            'pabrik' => Pabrik::all(),
            'active' => 'menu-laporan-perhari'
        ];
        return view('pages.dashboard_admin.laporan.laporan_perhari.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     dd("show");
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        dd("edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Get datatable data Surat Jalan
    public function data(Request $request)
    {
        // Mengambil data pabrik dan tanggal dari request
        $pabrikId = $request->pabrik_id;
        $tanggal = $request->tanggal;

        // Inisialisasi query untuk data Surat Jalan
        $query = SuratJalan::orderBy('id', 'desc');

        // Jika tidak ada filter pabrik dan tanggal, ambil data berdasarkan tanggal sekarang
        if (!$pabrikId && !$tanggal) {
            $query->whereDate('created_at', Carbon::today());
        }

        // Jika ada filter pabrik, tambahkan kondisi ke query
        if ($pabrikId) {
            $query->where('id_pabrik', $pabrikId);
        }

        // Jika ada filter tanggal, tambahkan kondisi ke query
        if ($tanggal) {
            $query->whereDate('tgl_sj', $tanggal);
        }

        // Eksekusi query untuk mendapatkan data Surat Jalan
        $suratJalan = $query->get();

        return datatables()
            ->of($suratJalan)
            ->addIndexColumn()
            ->addColumn('tgl_sj', function ($suratJalan) {
                return date('d-m-Y', strtotime($suratJalan->tgl_sj));
            })
            ->addColumn('id_pabrik', function ($suratJalan) {
                return $suratJalan->pabrik->nama_pabrik;
            })
            ->addColumn('id_user', function ($suratJalan) {
                return $suratJalan->user->name;
            })
            ->addColumn('aksi', function ($suratJalan) {
                return '
            <div class="btn-group">
                <a href="' . route('dashboard.laporan-perhari.show', $suratJalan->id) . '" class="btn btn-sm btn-info btn-flat mr-1"><i class="fas fa-info-circle"></i></a>
            </div>
            ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Show Detail dari Surat Jalan
    public function listBarang(string $id)
    {
        $data = [
            'surat_jalan' => SuratJalan::findOrFail($id),
            'id' => $id, // Meneruskan nilai id dari URL ke tampilan
            'active' => 'menu-laporan-perhari'
        ];
        return view('pages.dashboard_admin.laporan.laporan_perhari.detail_surat', $data);
    }

    // Get datatable data List Barang
    public function dataListBarang(Request $request)
    {
        // Ambil id_sj dari request
        $id_sj = $request->id_sj;

        // Query untuk mengambil data-barang berdasarkan id_sj dengan melakukan join
        $query = DB::table('list_barangs')
            ->join('barangs', 'list_barangs.kode_barang', '=', 'barangs.kode_barang')
            ->where('list_barangs.id_sj', $id_sj)
            ->select('barangs.*')
            ->orderBy('barangs.id', 'desc');

        // Mengambil data-barang menggunakan DataTables
        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('foto_barang', function ($query) {
                return '<img src="' . asset('storage/' . $query->foto_barang) . '" alt="' . $query->nama_barang . '" style="width: 70px; height: 70px;">';
            })
            ->rawColumns(['foto_barang'])
            ->make(true);
    }
}
