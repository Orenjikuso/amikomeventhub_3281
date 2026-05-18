<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();

        // Soal 3: Search/Filter
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $partners = $query->latest()->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'nullable|url|max:500',
            'logo_file' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'logo_url' => $request->logo_url,
        ];

        // Prioritas: file upload > URL
        if ($request->hasFile('logo_file')) {
            $data['logo_path'] = $request->file('logo_file')->store('logos', 'public');
            $data['logo_url'] = null; // Clear URL jika upload file
        }

        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner baru berhasil ditambahkan.');
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'nullable|url|max:500',
            'logo_file' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'logo_url' => $request->logo_url,
        ];

        if ($request->hasFile('logo_file')) {
            // Hapus logo lama jika ada
            if ($partner->logo_path && Storage::disk('public')->exists($partner->logo_path)) {
                Storage::disk('public')->delete($partner->logo_path);
            }
            $data['logo_path'] = $request->file('logo_file')->store('logos', 'public');
            $data['logo_url'] = null;
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui.');
    }

    public function destroy(Partner $partner)
    {
        // Hapus file logo jika ada
        if ($partner->logo_path && Storage::disk('public')->exists($partner->logo_path)) {
            Storage::disk('public')->delete($partner->logo_path);
        }

        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus.');
    }
}
