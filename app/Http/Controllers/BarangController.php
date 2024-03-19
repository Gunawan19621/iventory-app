<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\barang\ValidasiCreateBarang;
use PDF;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'active' => 'menu-barang'
        ];
        return view('pages.dashboard_admin.master_data_barang.barang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'kategori' => Kategori::all(),
            'active' => 'menu-barang'
        ];
        return view('pages.dashboard_admin.master_data_barang.barang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidasiCreateBarang $request)
    {
        try {
            $validatedData = $request->validated(); // Mengambil data yang telah divalidasi

            // Handle foto_barang upload if provided
            if ($request->hasFile('foto_barang')) {
                $randomFileName = Str::random(20); // Generate a random file name with length of 20 characters
                $fotoPath = $request->file('foto_barang')->storeAs('public/barang_foto', $randomFileName);
                $validatedData['foto_barang'] = str_replace('public/', '', $fotoPath);
            }

            Barang::create($validatedData);

            return redirect()->route('dashboard.barang.index')->with('success', 'Data Barang berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Data Barang Gagal Ditambah. ' . $th->getMessage());
        }
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
        $barang = Barang::findOrFail($id);

        // Lakukan join antara tabel Barang dan Kategori berdasarkan kolom kode_kategori
        $barangWithKategori = Barang::join('kategoris', 'barangs.kode_kategori', '=', 'kategoris.kode_kategori')
            ->where('barangs.id', $id)
            ->select('barangs.*', 'kategoris.nama_kategori')
            ->first();

        $kategori = Kategori::all();

        $data = [
            'barang' => $barangWithKategori,
            'kategori' => $kategori,
            'active' => 'menu-barang'
        ];

        return view('pages.dashboard_admin.master_data_barang.barang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $barang = Barang::findOrFail($id);

            $validatedData = $request->validate([
                'nama_barang' => 'required',
                'kode_kategori' => 'required',
                'foto_barang' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi jenis file gambar
            ]);

            // Handle foto_barang upload if provided
            if ($request->hasFile('foto_barang')) {
                // Generate a random file name with length of 20 characters
                $randomFileName = Str::random(20);

                // Store the new photo and update the foto_barang field
                $fotoPath = $request->file('foto_barang')->storeAs('public/barang_foto', $randomFileName);
                $validatedData['foto_barang'] = str_replace('public/', '', $fotoPath);

                // If there's an existing photo, delete it
                if ($barang->foto_barang) {
                    Storage::delete('public/' . $barang->foto_barang);
                }
            }

            // Update the record
            $barang->update($validatedData);

            return redirect()->route('dashboard.barang.index')->with('success', 'Data Barang berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Barang Gagal Diperbarui.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $barang = Barang::findOrFail($id);
            $barang->delete();
            return redirect()->back()->with('success', 'Data Barang berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Barang gagal dihapus');
        }
    }

    // Datatables Barang
    public function data()
    {
        $barang = Barang::orderBy('id', 'desc')->get();

        return datatables()
            ->of($barang)
            ->addIndexColumn()
            ->addColumn('foto_barang', function ($barang) {
                return '<img src="' . asset('storage/' . $barang->foto_barang) . '" alt="' . $barang->nama_barang . '" width="100">';
            })
            ->addColumn('aksi', function ($barang) {
                return '
                <div class="btn-group">
                    <a href="' . route('dashboard.barang.edit', $barang->id) . '" class="btn btn-sm btn-info btn-flat mr-1"><i class="fa fa-edit"></i></a>
                    <form action="' . route('dashboard.barang.destroy', $barang->id) . '" method="POST" class="d-inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-sm btn-danger btn-flat btn-delete mr-1"><i class="fa fa-trash"></i></button>
                    </form>
                    <a href="' . route('dashboard.barangcetakpdf.cetakpdf', $barang->id) . '" target="_blank" class="btn btn-sm btn-warning btn-flat mr-1"><i class="fas fa-print"></i></a>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'foto_barang'])
            ->make(true);
    }

    public function cetakPdf($id)
    {
        $barang = Barang::findOrFail($id);
        $pdf = PDF::loadView('pages.dashboard_admin.master_data_barang.barang.label_barang', compact('barang'));
        return $pdf->stream('barang.pdf');
    }
}
