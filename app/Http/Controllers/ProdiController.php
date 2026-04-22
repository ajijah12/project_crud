<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi; // Memanggil Asisten Gudang Prodi
use Illuminate\Support\Facades\Validator; // Alat pengecek bahan

class ProdiController extends Controller
{
    // 1. TUGAS MENAMPILKAN DATA (GET)
    public function index()
    {
        $prodi = Prodi::all();

        return response()->json([
            'status' => 'success',
            'data' => $prodi
        ], 200);
    }

    // 2. TUGAS MENAMBAH DATA BARU (POST)
    public function store(Request $request)
    {
        // Koki mengecek kelengkapan form dari Postman
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required',
            'singkatan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        // Koki menyuruh Model menyimpan ke database
        $prodi = Prodi::create([
            'nama_prodi' => $request->nama_prodi,
            'singkatan' => $request->singkatan
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Prodi berhasil ditambahkan',
            'data' => $prodi
        ], 201);
    }

    // 3. TUGAS MENGEDIT DATA LAMA (PUT)
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required',
            'singkatan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        // Koki mencari prodi mana yang mau diedit berdasarkan ID
        $prodi = Prodi::find($id);

        if (!$prodi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data prodi tidak ditemukan'
            ], 404);
        }

        // Koki melakukan update
        $prodi->update([
            'nama_prodi' => $request->nama_prodi,
            'singkatan' => $request->singkatan
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Prodi berhasil diupdate',
            'data' => $prodi
        ], 200);
    }

    // 4. TUGAS MENGHAPUS DATA (DELETE)
    public function destroy($id)
    {
        $prodi = Prodi::find($id);

        if (!$prodi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data prodi tidak ditemukan'
            ], 404);
        }

        // Hancurkan data! (Tidak butuh try-catch lagi karena kita pakai Cascade sebelumnya)
        $prodi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Prodi berhasil dihapus'
        ], 200);
    }
}
