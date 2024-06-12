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
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $peminjaman = Peminjaman::create($request->all());

        return response()->json($peminjaman, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());

        return response()->json($peminjaman, 200);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return response()->json(null, 204);
    }
}
