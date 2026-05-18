@extends('layouts.admin')
@section('title', 'Manajemen Kategori - Admin')
@section('page_title', 'Manajemen Kategori')
@section('page_subtitle', 'Kelola kategori event Anda di sini.')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div class="flex items-center gap-3">
        <div class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-bold">
            {{ $categories->count() }} Kategori
        </div>
    </div>
    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
        class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 active:scale-95 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Kategori
    </button>
</div>

<div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-slate-50 to-slate-100/50">
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest w-16">No</th>
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest">Nama Kategori</th>
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest">Slug</th>
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest">Jumlah Event</th>
                    <th class="px-6 py-4 text-slate-400 uppercase text-[10px] font-black tracking-widest text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @php
                    $colors = ['indigo', 'emerald', 'amber', 'purple', 'rose', 'cyan', 'orange', 'teal'];
                @endphp
                @forelse($categories as $index => $category)
                <tr class="hover:bg-indigo-50/30 transition-colors duration-200 group">
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-500 text-sm font-bold group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">
                            {{ $index + 1 }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            @php $color = $colors[$index % count($colors)]; @endphp
                            <div class="w-10 h-10 bg-{{ $color }}-100 text-{{ $color }}-600 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <p class="font-bold text-slate-800">{{ $category->name }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="font-mono text-sm text-slate-500 bg-slate-100 px-3 py-1 rounded-lg">{{ $category->slug }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <span class="font-bold text-indigo-600">{{ $category->events_count }} Event</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-200 hover:shadow-lg hover:shadow-indigo-200"
                                title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <p class="text-slate-400 font-medium">Belum ada kategori.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Kategori --}}
<div id="modal-tambah" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-lg rounded-[2rem] overflow-hidden shadow-2xl">
        <div class="p-8 border-b flex justify-between items-center">
            <h3 class="text-xl font-black">Tambah Kategori Baru</h3>
            <button onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                class="p-2 hover:bg-slate-100 rounded-full transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-8">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Kategori</label>
                    <input type="text" name="name" placeholder="Contoh: Seminar, Konser, Workshop..."
                        class="w-full px-5 py-4 bg-slate-50/80 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white outline-none transition-all font-medium placeholder:text-slate-300" required>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                        class="flex-1 py-4 border-2 border-slate-200 rounded-2xl font-bold hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Kategori --}}
<div id="modal-edit" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-lg rounded-[2rem] overflow-hidden shadow-2xl">
        <div class="p-8 border-b flex justify-between items-center">
            <h3 class="text-xl font-black">Edit Kategori</h3>
            <button onclick="document.getElementById('modal-edit').classList.add('hidden')"
                class="p-2 hover:bg-slate-100 rounded-full transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-8">
            <form id="edit-form" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Kategori</label>
                    <input type="text" name="name" id="edit-name"
                        class="w-full px-5 py-4 bg-slate-50/80 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white outline-none transition-all font-medium" required>
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

@if(session('error'))
<script>alert("{{ session('error') }}")</script>
@endif

<script>
function openEditModal(id, name) {
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-form').action = '/admin/categories/' + id;
    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endsection
