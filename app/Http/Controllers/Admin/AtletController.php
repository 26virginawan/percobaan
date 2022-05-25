<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Atlet;
use App\Models\Spp;
use App\Models\Petugas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\AtletDataTable;

class AtletController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-atlet'])->only(['index', 'show']);
        $this->middleware(['permission:create-atlet'])->only([
            'create',
            'store',
        ]);
        $this->middleware(['permission:update-atlet'])->only([
            'edit',
            'update',
        ]);
        $this->middleware(['permission:delete-atlet'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AtletDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        $siswa = Atlet::all();
        $spp = Spp::all();
        $kelas = Kelas::all();

        return view('admin.atlet.index', compact('siswa', 'spp', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required',
            'name' => 'required|unique:users',
            'nisn' => 'required|unique:siswa',
            'tgl_registrasi' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'bb' => 'required',
            'tb' => 'required',
            'no_telepon' => 'required',
            'tingkat_sabuk' => 'required',
            'kelas' => 'required',
        ]);

        if ($validator->passes()) {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'username' => Str::lower($request->name),
                    'password' => Hash::make('rahasia'),
                ]);

                $user->assignRole('atlet');

                Atlet::create([
                    'user_id' => $user->id,
                    'kode_atlet' => 'ATLT' . Str::upper(Str::random(5)),
                    'foto' => $request->foto,
                    'name' => $request->name,
                    'nisn' => $request->nisn,
                    'tgl_registrasi' => $request->tgl_registrasi,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'bb' => $request->bb,
                    'tb' => $request->tb,
                    'no_telepon' => $request->no_telepon,
                    'tingkat_sabuk' => $request->tingkat_sabuk,
                    'kelas' => $request->kelas,
                ]);
            });

            return response()->json(['message' => 'Data berhasil disimpan!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Atlet::with(['spp'])->findOrFail($id);
        return response()->json(['data' => $siswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required',
            'name' => 'required|unique:users',
            'tgl_registrasi' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'bb' => 'required',
            'tb' => 'required',
            'no_telepon' => 'required',
            'tingkat_sabuk' => 'required',
            'kelas' => 'required',
        ]);

        if ($validator->passes()) {
            Atlet::findOrFail($id)->update([
                'foto' => $request->foto,
                'name' => $request->name,
                'tgl_registrasi' => $request->tgl_registrasi,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'bb' => $request->bb,
                'tb' => $request->tb,
                'no_telepon' => $request->no_telepon,
                'tingkat_sabuk' => $request->tingkat_sabuk,
                'kelas' => $request->kelas,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Atlet::findOrFail($id);
        User::findOrFail($siswa->user_id)->delete();
        $siswa->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}