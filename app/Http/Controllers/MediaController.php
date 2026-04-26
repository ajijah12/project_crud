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
        //
        $Media = Media::all();
        return response()->json($Media);
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
    public function store(Request $request) //menambahkan data
    {
        //validasi form
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'kategori_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'judul_penelitian' => 'required',
            'tahun_terbit' => 'required',
            'link_media' => 'required',
            'gambar_cover' => 'required',
            'file_url' => 'required'
        ]);

        //cek jika ada error validasi for
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        //menyimpan data ke database
        $Media = new Media();
        $Media->fill($request->all());
        $simpan = $Media->save();
        
        if ($simpan) {
            return response()->json([
                'status' => 'success',
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'error' => 'gagal menyimpan data'
            ], 422);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'kategori_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'judul_penelitian' => 'required',
            'tahun_terbit' => 'required',
            'link_media' => 'required',
            'gambar_cover' => 'required',
        ]);
        //cek jika ada error validasi for
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        //cari data berdasarkan id
        $Media = Media::find($id);

        //jika data tidak ditemukan
        if (!$Media) {
            return response()->json([
                'status' => 'error',
                'error' => 'data tidak ditemukan'
            ], 422);
        }

        //update data ke database
        $Media->fill($request->all());
        $simpan = $Media->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'error' => 'gagal menyimpan data'
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        //cari data berdasarkan id
        $Media = Media::find($id);

        //jika data tidak ditemukan
        if (!$Media) {
            return response()->json([
                'status' => 'error',
                'error' => 'data tidak ditemukan'
            ], 422);
        }

        $hapus = $Media->delete();
        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil dihapus'
            ], 201);

        } else {
            return response()->json([
                'status' => 'error',
                'error' => 'gagal menghapus data'
            ], 422);
        }
    }
}