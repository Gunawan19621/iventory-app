<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pabrik;
use App\Models\SuratJalan;
use Illuminate\Http\Request;

class LaporanPerbulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'active' => 'menu-laporan-perbulan'
        ];
        return view('pages.dashboard_admin.laporan.laporan_perbulan.index', $data);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        // Mengambil tanggal awal dan akhir dari request
        $dateStart = $request->date_start;
        $dateEnd = $request->date_end;

        // Inisialisasi query untuk data Surat Jalan
        $query = SuratJalan::orderBy('id', 'desc');

        // Jika terdapat filter tanggal awal dan akhir, tambahkan kondisi ke query
        if ($dateStart && $dateEnd) {
            $query->whereBetween('tgl_sj', [$dateStart, $dateEnd]);
        }

        // Eksekusi query untuk mendapatkan data Surat Jalan
        $suratJalan = $query->get();

        // Format data dan kirim ke DataTables
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
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
