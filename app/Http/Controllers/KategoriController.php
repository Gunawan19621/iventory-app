<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'active' => 'menu-kategori'
        ];
        return view('pages.dashboard_admin.master_data_barang.kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'active' => 'menu-kategori'
        ];
        return view('pages.dashboard_admin.master_data_barang.kategori.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_kategori' => 'required',
            ]);

            // Get the latest Kategori ID from the database
            $latestKategori = Kategori::latest()->first();

            // Extract the numeric part of the kode_kategori and increment it by 1
            $nextId = ($latestKategori) ? intval(substr($latestKategori->kode_kategori, 1)) + 1 : 1;

            // Format the next ID with leading zeros and prepend 'K'
            $kode_kategori = 'K' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

            // Merge with validated data
            $validatedData['kode_kategori'] = $kode_kategori;

            Kategori::create($validatedData);
            return redirect()->route('dashboard.kategori.index')->with('success', 'Data Kategori berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Kategori Gagal Ditambah.');
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
        $data = [
            'kategori' => Kategori::findOrFail($id),
            'active' => 'menu-kategori'
        ];
        return view('pages.dashboard_admin.master_data_barang.kategori.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->update($request->except('_token', '_method'));
            return redirect()->route('dashboard.kategori.index')->with('success', 'Data Kategori berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Kategori gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();
            return redirect()->back()->with('success', 'Data Kategori berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Kategori gagal dihapus');
        }
    }

    // Datatables Kategori
    public function data()
    {
        $kategori = Kategori::orderBy('id', 'desc')->get();

        return datatables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return '
                <div class="btn-group">
                    <a href="' . route('dashboard.kategori.edit', $kategori->id) . '" class="btn btn-sm btn-info btn-flat mr-1"><i class="fa fa-edit"></i></a>
                    <form action="' . route('dashboard.kategori.destroy', $kategori->id) . '" method="POST" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger btn-flat btn-delete"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
