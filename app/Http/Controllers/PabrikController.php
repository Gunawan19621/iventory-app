<?php

namespace App\Http\Controllers;

use App\Models\Pabrik;
use Illuminate\Http\Request;

class PabrikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'active' => 'menu-pabrik'
        ];
        return view('pages.dashboard_admin.data_pabrik.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'active' => 'menu-pabrik'
        ];
        return view('pages.dashboard_admin.data_pabrik.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_pabrik' => 'required',
            ]);
            Pabrik::create($validatedData);
            return redirect()->route('dashboard.pabrik.index')->with('success', 'Data Pabrik berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Pabrik Gagal Ditambah.');
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
            'active' => 'menu-pabrik',
            'pabrik' => Pabrik::findOrFail($id)
        ];
        return view('pages.dashboard_admin.data_pabrik.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pabrik = Pabrik::findOrFail($id);
            $pabrik->update($request->except('_token', '_method'));
            return redirect()->route('dashboard.pabrik.index')->with('success', 'Data Pabrik berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Pabrik gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pabrik = Pabrik::findOrFail($id);
            $pabrik->delete();
            return redirect()->back()->with('success', 'Data pabrik berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data pabrik gagal dihapus');
        }
    }

    // Datatables Pabrik
    public function data()
    {
        $pabrik = Pabrik::orderBy('id', 'desc')->get();

        return datatables()
            ->of($pabrik)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pabrik) {
                return '
                <div class="btn-group">
                    <a href="' . route('dashboard.pabrik.edit', $pabrik->id) . '" class="btn btn-sm btn-info btn-flat mr-1"><i class="fa fa-edit"></i></a>
                    <form action="' . route('dashboard.pabrik.destroy', $pabrik->id) . '" method="POST" class="d-inline">
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