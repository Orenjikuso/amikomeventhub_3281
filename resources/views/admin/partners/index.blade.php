@extends('layouts.admin')
@section('title', 'Manajemen Partner - Admin')
@section('page_title', 'Manajemen Partner')
@section('page_subtitle', 'Kelola partner dan sponsor event Anda di sini.')

@section('content')
<div class="mb-6 flex justify-between items-center flex-wrap gap-4">
    {{-- Search (Soal 3) --}}
    <form action="{{ route('admin.partners.index') }}" method="GET" class="flex items-center gap-3">
        <div class="relative">
            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari partner..."
                class="pl-12 pr-5 py-3 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium w-72">
        </div>
        <button type="submit" class="px-5 py-3 bg-indigo-100 text-indigo-700 rounded-2xl font-bold hover:bg-indigo-200 transition">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.partners.index') }}" class="px-4 py-3 text-slate-500 hover:text-slate-700 font-medium transition">Reset</a>
        @endif
    </form>

    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
        class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 active:scale-95 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Partner
    </button>
</div>

@if(request('search'))
<div class="mb-4 px-4 py-3 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-medium">
    Menampilkan hasil pencarian untuk "<strong>{{ request('search') }}</strong>" — {{ $partners->count() }} data ditemukan
</div>
@endif

<div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-slate-50 to-slate-100/50">
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest w-16">No</th>
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest">Logo</th>
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest">Nama Partner</th>
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest">Sumber Logo</th>
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($partners as $index => $partner)
                <tr class="hover:bg-indigo-50/30 transition-colors duration-200 group">
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-500 text-sm font-bold group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">
                            {{ $index + 1 }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        @if($partner->logo_display_url)
                            <img src="{{ $partner->logo_display_url }}" alt="{{ $partner->name }}" class="w-12 h-12 rounded-xl object-contain bg-slate-50 border border-slate-100 p-1">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                <span class="text-indigo-600 font-black text-lg">{{ strtoupper(substr($partner->name, 0, 1)) }}</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        <p class="font-bold text-slate-800">{{ $partner->name }}</p>
                    </td>
                    <td class="px-6 py-5">
                        @if($partner->logo_path)
                            <span class="inline-flex items-center gap-1.5 text-xs bg-green-50 text-green-700 px-3 py-1 rounded-lg font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                File Upload
                            </span>
                        @elseif($partner->logo_url)
                            <span class="inline-flex items-center gap-1.5 text-xs bg-blue-50 text-blue-700 px-3 py-1 rounded-lg font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                URL Eksternal
                            </span>
                        @else
                            <span class="text-slate-400 text-sm italic">Belum ada logo</span>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openEditModal({{ $partner->id }}, '{{ addslashes($partner->name) }}', '{{ addslashes($partner->logo_url) }}')"
                                class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-200 hover:shadow-lg hover:shadow-indigo-200"
                                title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2.5 bg-rose-50 text-rose-500 rounded-xl hover:bg-rose-600 hover:text-white transition-all duration-200 hover:shadow-lg hover:shadow-rose-200"
                                    title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <p class="text-slate-400 font-medium">Belum ada partner.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Partner --}}
<div id="modal-tambah" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-lg rounded-[2rem] overflow-hidden shadow-2xl">
        <div class="p-8 border-b flex justify-between items-center">
            <h3 class="text-xl font-black">Tambah Partner Baru</h3>
            <button onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                class="p-2 hover:bg-slate-100 rounded-full transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-8">
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Partner</label>
                    <input type="text" name="name" placeholder="Contoh: Google, Microsoft, Tokopedia..."
                        class="w-full px-5 py-4 bg-slate-50/80 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white outline-none transition-all font-medium placeholder:text-slate-300" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Upload Logo (Opsional)</label>
                    <input type="file" name="logo_file" accept="image/*"
                        class="w-full px-5 py-4 bg-slate-50/80 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-medium">
                    <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, SVG, WebP. Maks 2MB</p>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Atau URL Logo</label>
                    <input type="url" name="logo_url" placeholder="https://example.com/logo.png"
                        class="w-full px-5 py-4 bg-slate-50/80 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white outline-none transition-all font-medium placeholder:text-slate-300">
                    <p class="text-xs text-slate-400 mt-1">File upload akan diprioritaskan jika keduanya diisi</p>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                        class="flex-1 py-4 border-2 border-slate-200 rounded-2xl font-bold hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all">
                        Simpan Partner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Partner --}}
<div id="modal-edit" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-lg rounded-[2rem] overflow-hidden shadow-2xl">
        <div class="p-8 border-b flex justify-between items-center">
            <h3 class="text-xl font-black">Edit Partner</h3>
            <button onclick="document.getElementById('modal-edit').classList.add('hidden')"
                class="p-2 hover:bg-slate-100 rounded-full transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-8">
            <form id="edit-form" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Partner</label>
                    <input type="text" name="name" id="edit-name"
                        class="w-full px-5 py-4 bg-slate-50/80 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white outline-none transition-all font-medium" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Upload Logo Baru (Opsional)</label>
                    <input type="file" name="logo_file" accept="image/*"
                        class="w-full px-5 py-4 bg-slate-50/80 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-medium">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Atau URL Logo</label>
                    <input type="url" name="logo_url" id="edit-logo-url"
                        class="w-full px-5 py-4 bg-slate-50/80 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white outline-none transition-all font-medium">
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="flex-1 py-4 border-2 border-slate-200 rounded-2xl font-bold hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(id, name, logoUrl) {
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-logo-url').value = logoUrl || '';
    document.getElementById('edit-form').action = '/admin/partners/' + id;
    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endsection
