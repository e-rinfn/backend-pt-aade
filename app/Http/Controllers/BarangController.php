<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return Barang::all();
    }

    public function show($id)
    {
        return Barang::findOrFail($id);
    }

    public function store(Request $request)
    {
        $barang = new Barang;
        $barang->nama = $request->nama;
        $barang->deskripsi = $request->deskripsi;
        $barang->stok = $request->stok;
        $barang->save();

        return response()->json($barang, 201);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->nama = $request->nama;
        $barang->deskripsi = $request->deskripsi;
        $barang->stok = $request->stok;
        $barang->save();

        return response()->json($barang, 200);
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json(null, 204);
    }
}

