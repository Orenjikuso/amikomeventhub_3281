@extends('layouts.admin')
@section('title', 'Manajemen Kategori - Admin')
@section('page-title', 'Manajemen Kategori')
@section('page-description', 'Kelola kategori event Anda di sini.')

@section('header-actions')
    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
        class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Kategori
    </button>
@endsection

@section('content')
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <!-- Search & Filter Bar -->
        <div class="px-8 py-6 bg-slate-50/50 border-b flex gap-4 items-center">
            <input type="text" placeholder="Cari nama kategori..."
                class="flex-1 px-5 py-3 rounded-xl border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            <select class="px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none text-sm font-bold">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Nonaktif</option>
            </select>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4 w-16">No</th>
                        <th class="px-8 py-4">Nama Kategori</th>
                        <th class="px-8 py-4">Slug</th>
                        <th class="px-8 py-4">Jumlah Event</th>
                        <th class="px-8 py-4">Status</th>
                        <th class="px-8 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-t">
                    <!-- Kategori 1 -->
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-6 font-bold text-slate-400">1</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                        </path>
                                    </svg>
                                </div>
                                <p class="font-black text-slate-800">Konser</p>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-mono text-sm text-slate-500 bg-slate-100 px-3 py-1 rounded-lg">konser</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-bold text-indigo-600">5 Event</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase ring-1 ring-green-200">Aktif</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex gap-2">
                                <button
                                    class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button
                                    class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition"
                                    title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Kategori 2 -->
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-6 font-bold text-slate-400">2</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                </div>
                                <p class="font-black text-slate-800">Seminar</p>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-mono text-sm text-slate-500 bg-slate-100 px-3 py-1 rounded-lg">seminar</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-bold text-indigo-600">3 Event</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase ring-1 ring-green-200">Aktif</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex gap-2">
                                <button
                                    class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button
                                    class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition"
                                    title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Kategori 3 -->
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-6 font-bold text-slate-400">3</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="font-black text-slate-800">Workshop</p>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-mono text-sm text-slate-500 bg-slate-100 px-3 py-1 rounded-lg">workshop</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-bold text-indigo-600">2 Event</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase ring-1 ring-green-200">Aktif</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex gap-2">
                                <button
                                    class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button
                                    class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition"
                                    title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Kategori 4 -->
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-6 font-bold text-slate-400">4</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                    </svg>
                                </div>
                                <p class="font-black text-slate-800">Hackathon</p>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-mono text-sm text-slate-500 bg-slate-100 px-3 py-1 rounded-lg">hackathon</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-bold text-indigo-600">1 Event</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold uppercase ring-1 ring-slate-200">Nonaktif</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex gap-2">
                                <button
                                    class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button
                                    class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition"
                                    title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer / Pagination -->
        <div class="px-8 py-6 bg-slate-50/50 border-t flex justify-between items-center">
            <p class="text-sm text-slate-500 font-medium">Menampilkan 4 kategori</p>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl shadow-md text-sm font-bold">1</button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
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
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Kategori</label>
                        <input type="text" placeholder="Contoh: Seminar, Konser, Workshop..."
                            class="w-full px-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Deskripsi (Opsional)</label>
                        <textarea rows="3" placeholder="Deskripsi singkat tentang kategori..."
                            class="w-full px-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium resize-none"></textarea>
                    </div>
                    <div class="flex gap-4 pt-4">
                        <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                            class="flex-1 py-4 border-2 border-slate-200 rounded-2xl font-bold hover:bg-slate-50 transition">
                            Batal
                        </button>
                        <button type="button"
                            class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all">
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
