<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    // 1. TUGAS MENAMPILKAN DATA (GET)
    public function index()
    {
        $mahasiswa = Mahasiswa::all();

        return response()->json([
            'status' => 'success',
            'data' => $mahasiswa
        ], 200);
    }

    // 2. TUGAS MENAMBAH DATA BARU (POST)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswa', // nim tidak boleh kembar
            'nama_lengkap' => 'required',
            'prodi_id' => 'required|numeric' // prodi_id wajib diisi dengan angka
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'prodi_id' => $request->prodi_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mahasiswa berhasil ditambahkan',
            'data' => $mahasiswa
        ], 201);
    }

    // 3. TUGAS MENGEDIT DATA LAMA (PUT)
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama_lengkap' => 'required',
            'prodi_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'prodi_id' => $request->prodi_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mahasiswa berhasil diupdate',
            'data' => $mahasiswa
        ], 200);
    }

    // 4. TUGAS MENGHAPUS DATA (DELETE)
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete(); // Langsung hapus 
        return response()->json(['status' => 'success', 'message' => 'Mahasiswa berhasil dihapus'], 200);
    }
}
