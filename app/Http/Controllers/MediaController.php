<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    //1. TUGAS MENAMPILKAN DATA (GET)
    public function index()
    {
        $media = Media::all();

        return response()->json([
            'status' => 'success',
            'data' => $media
        ], 200);
    }

    // 2. TUGAS MENAMBAH DATA BARU (POST)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required|numeric',
            'kategori_id' => 'required|numeric',
            'judul' => 'required',
            'deskripsi' => 'required', // text boleh divalidasi dengan required saja
            'judul_penelitian' => 'required',
            'tahun_terbit' => 'required',
            'link_media' => 'required',
            'gambar_cover' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        // JALAN PINTAS SAKTI: Langsung masukkan semua request!
        // Ini aman karena kita sudah mendaftarkan $fillable di file Media.php
        $media = Media::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Media berhasil ditambahkan',
            'data' => $media
        ], 201);
    }

    // 3. TUGAS MENGEDIT DATA LAMA (PUT)
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required|numeric',
            'kategori_id' => 'required|numeric',
            'judul' => 'required',
            'deskripsi' => 'required',
            'judul_penelitian' => 'required',
            'tahun_terbit' => 'required',
            'link_media' => 'required',
            'gambar_cover' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data media tidak ditemukan'
            ], 404);
        }

        // Jalan pintas sakti untuk update
        $media->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Media berhasil diupdate',
            'data' => $media
        ], 200);
    }

    // 4. TUGAS MENGHAPUS DATA (DELETE)
    public function destroy($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data media tidak ditemukan'
            ], 404);
        }

        // Media adalah tabel paling ujung (tidak ada yang bergantung padanya),
        // jadi sangat aman dihapus langsung tanpa takut error database.
        $media->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Media berhasil dihapus'
        ], 200);
    }
}
