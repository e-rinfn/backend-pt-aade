<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function index()
    {
        return Peminjaman::all();
    }

    public function show($id)
    {
        return Peminjaman::findOrFail($id);
    }


    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'no_hp' => 'required|string|max:255',
            'nama_peminjam' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Membuat data baru
        $peminjaman = Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'no_hp' => $request->no_hp,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status,
        ]);

        // Redirect atau respon sesuai kebutuhan
        return response()->json(['message' => 'Peminjaman berhasil ditambahkan', 'data' => $peminjaman], 201);
    }

    public function update(Request $request, $id)
    {
        // Buat validasi manual menggunakan Validator facade
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Periksa apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Temukan data Peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Perbarui data Peminjaman dengan data validasi yang diterima
        $peminjaman->update($request->all());

        // Kembalikan response JSON
        return response()->json($peminjaman, 200);
    }

    public function destroy($id)
    {
        // Temukan data Peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Hapus data Peminjaman
        $peminjaman->delete();

        // Kembalikan response JSON dengan pesan sukses
        return response()->json([
            'message' => 'Peminjaman berhasil dihapus'
        ], 200);
    }
}
