<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'active' => 'menu-role'
        ];
        return view('pages.dashboard_admin.manajemen_user.role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'active' => 'menu-role'
        ];
        return view('pages.dashboard_admin.manajemen_user.role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('store');
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'description' => 'required',
            ]);
            Role::create($validatedData);
            return redirect()->route('dashboard.role.index')->with('success', 'Data Role berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Role Gagal Ditambah.');
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
            'role' => Role::find($id),
            'active' => 'menu-role'
        ];
        return view('pages.dashboard_admin.manajemen_user.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->update($request->except('_token', '_method'));
            return redirect()->route('dashboard.role.index')->with('success', 'Data Role berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Role gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return redirect()->back()->with('success', 'Data Role berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Role gagal dihapus');
        }
    }

    // Datatables Role
    public function data()
    {
        $role = Role::orderBy('id', 'desc')->get();

        return datatables()
            ->of($role)
            ->addIndexColumn()
            ->addColumn('aksi', function ($role) {
                return '
                <div class="btn-group">
                    <a href="' . route('dashboard.role.edit', $role->id) . '" class="btn btn-sm btn-info btn-flat mr-1"><i class="fa fa-edit"></i></a>
                    <form action="' . route('dashboard.role.destroy', $role->id) . '" method="POST" class="d-inline">
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