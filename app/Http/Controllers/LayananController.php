<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * Menampilkan semua data layanan.
     */
    public function index()
    {
        $data = Layanan::orderBy('id', 'desc')->get();

        return view('admin.layanan', compact('data'));
    }

    /**
     * Menampilkan daftar layanan untuk customer.
     */
    public function customer()
    {
        $data = DB::table('layanan')
            ->orderBy('id', 'desc')
            ->get();

        return view('customer.layanan', compact('data'));
    }

    /**
     * Menyimpan layanan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required',
            'harga' => 'required|numeric',
            'desc'  => 'required',
        ]);

        DB::table('layanan')->insert([
            'nama'       => $request->nama,
            'harga'      => $request->harga,
            'desc'       => $request->desc,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Data layanan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail layanan.
     */
    public function show($id)
    {
        $data = Layanan::findOrFail($id);

        return view('admin.layanan_detail', compact('data'));
    }

    /**
     * Memperbarui data layanan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'  => 'required',
            'harga' => 'required|numeric',
            'desc'  => 'required',
        ]);

        DB::table('layanan')
            ->where('id', $id)
            ->update([
                'nama'       => $request->nama,
                'harga'      => $request->harga,
                'desc'       => $request->desc,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Data layanan berhasil diperbarui.');
    }

    /**
     * Menghapus data layanan.
     */
    public function destroy($id)
    {
        DB::table('layanan')
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Data layanan berhasil dihapus.');
    }
}