<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\user\ValidasiCreateUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'active' => 'menu-user'
        ];
        return view('pages.dashboard_admin.manajemen_user.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'role' => Role::all(),
            'active' => 'menu-user'
        ];
        return view('pages.dashboard_admin.manajemen_user.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidasiCreateUser $request)
    {
        try {
            $validatedData = $request->except('_token');
            $validatedData['password'] = bcrypt($request->input('password')); // Enkripsi password
            user::create($validatedData);
            return redirect()->route('dashboard.user.index')->with('success', 'Data User berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data User Gagal Ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'user' => User::findOrFail($id),
            'role' => Role::all(),
            'active' => 'menu-user'
        ];
        return view('pages.dashboard_admin.manajemen_user.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->except('_token', '_method'));
            return redirect()->route('dashboard.user.index')->with('success', 'Data user berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data user gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd('destroy');
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('success', 'Data user berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data user gagal dihapus');
        }
    }

    // Datatables Users
    public function data()
    {
        $user = User::orderBy('id', 'desc')->get();

        return datatables()
            ->of($user)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                return '
                <div class="btn-group">
                    <a href="' . route('dashboard.user.edit', $user->id) . '" class="btn btn-sm btn-info btn-flat mr-1"><i class="fa fa-edit"></i></a>
                    <form action="' . route('dashboard.user.destroy', $user->id) . '" method="POST" class="d-inline">
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