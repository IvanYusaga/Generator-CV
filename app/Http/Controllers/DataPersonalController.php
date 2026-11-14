<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPersonal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataPersonalController extends Controller
{
    /**
     * Tampilkan form edit data personal.
     */
    public function edit()
    {
        $dataPersonal = Auth::user()->dataPersonal;

        return view('edit-data-personal', compact('dataPersonal'));
    }

    /**
     * Simpan/update data personal.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'email'         => 'required|email|max:255',
            'linkedin'      => 'nullable|string|max:255',
            'kota'          => 'required|string|max:255',
            'provinsi'      => 'required|string|max:255',
            'negara'        => 'required|string|max:255',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus berupa PNG, JPG, atau JPEG.',
            'foto.max'   => 'Ukuran foto maksimal 2 MB.',
        ]);

        $dataPersonal = Auth::user()->dataPersonal;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($dataPersonal && $dataPersonal->foto && Storage::disk('public')->exists($dataPersonal->foto)) {
                Storage::disk('public')->delete($dataPersonal->foto);
            }

            $path = $request->file('foto')->store('foto_personal', 'public');
            $validated['foto'] = $path;
        }

        DataPersonal::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return redirect()->route('dashboard')->with('success', 'Data personal berhasil diperbarui!');
    }
}


