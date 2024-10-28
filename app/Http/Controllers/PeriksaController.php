<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function index()
    {
        $periksa = Periksa::with(['pasien', 'dokter'])->get();
        $pasien = Pasien::all();
        $dokter = Dokter::all();
        return view('page_web.periksa.periksa', compact('periksa', 'pasien', 'dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'obat' => 'required|string',
        ], [
            'pasien_id.required' => 'Pasien harus dipilih',
            'dokter_id.required' => 'Dokter harus dipilih',
            'tgl_periksa.required' => 'Tanggal periksa harus diisi',
            'catatan.required' => 'Catatan harus diisi',
            'obat.required' => 'Obat harus diisi',
        ]);

        Periksa::create($request->all());
        return redirect()->route('periksa.index')->with('success', 'Data pemeriksaan berhasil ditambahkan');
    }

    public function update(Request $request, Periksa $periksa)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'obat' => 'required|string',
        ]);

        $periksa->update($request->all());
        return redirect()->route('periksa.index')->with('success', 'Data pemeriksaan berhasil diperbarui');
    }

    public function destroy(Periksa $periksa)
    {
        $periksa->delete();
        return redirect()->route('periksa.index')->with('success', 'Data pemeriksaan berhasil dihapus');
    }
}