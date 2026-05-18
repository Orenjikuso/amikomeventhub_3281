@extends('layouts.app')

@section('title', 'AmikomEventHub - Temukan Event Seru!')

@section('content')
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <span
                class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">#1
                Event Platform</span>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
            </h1>
            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan
                Midtrans.
            </p>
            <div class="flex gap-4">
                <a href="#events"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                    Mulai Jelajah
                </a>
                <a href="#"
                    class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                    Cara Pesan
                </a>
            </div>
        </div>
        <div class="flex-1 relative">
            <div
                class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <img src="{{ asset('assets/concert.png') }}" alt="Concert"
                class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

            <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                        <p class="font-bold">Pembayaran Aman via Midtrans</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section id="events" class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>
            <div class="flex gap-2">
                <button class="p-3 border rounded-xl hover:bg-white hover:shadow-md transition">Semua Kategori</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($events as $event)
            <div
                class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden aspect-[3/4]">
                    <img src="{{ $event->poster_url }}" alt="{{ $event->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                        {{ $event->category->name ?? 'Umum' }}</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">{{ $event->title }}</h3>
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $event->date->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t">
                        <span class="text-2xl font-black text-indigo-600">
                            @if($event->price > 0)
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            @else
                                Gratis
                            @endif
                        </span>
                        <a href="{{ route('events.show', $event->id) }}"
                            class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">Lihat
                            Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <div class="w-20 h-20 mx-auto mb-6 bg-indigo-100 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Event</h3>
                <p class="text-slate-500">Event seru akan segera hadir. Stay tuned!</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Kategori Section (Soal 4) -->
    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold mb-2">Kategori Event</h2>
            <p class="text-slate-500 font-medium">Temukan event sesuai minatmu</p>
        </div>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach($categories as $category)
            <a href="#events"
                class="group px-6 py-3 bg-white border-2 border-slate-100 rounded-2xl hover:border-indigo-600 hover:bg-indigo-50 transition-all duration-200 flex items-center gap-3">
                <svg class="w-5 h-5 text-indigo-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <span class="font-bold text-slate-700 group-hover:text-indigo-600 transition">{{ $category->name }}</span>
                <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-0.5 rounded-full font-bold">{{ $category->events_count }}</span>
            </a>
            @endforeach
        </div>
    </section>

    <!-- Partner Section (Soal 4) -->
    @if($partners->count() > 0)
    <section class="py-20 mt-8 bg-gradient-to-b from-white via-indigo-50/40 to-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <div class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-100/80 rounded-full mb-5">
                    <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-indigo-700 text-sm font-bold">Mitra Terpercaya</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-3">Partner & Sponsor</h2>
                <p class="text-slate-500 font-medium max-w-md mx-auto">Berkolaborasi bersama mitra terbaik untuk event berkualitas</p>
            </div>

            <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-10">
                @foreach($partners as $partner)
                <a href="#" class="group flex flex-col items-center gap-3 transition-all duration-300 hover:-translate-y-1">
                    @if($partner->logo_display_url)
                        <div class="h-16 w-28 flex items-center justify-center">
                            <img src="{{ $partner->logo_display_url }}" alt="{{ $partner->name }}"
                                class="max-h-14 max-w-full object-contain grayscale opacity-40 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500">
                        </div>
                    @else
                        <div class="h-16 w-28 rounded-2xl bg-slate-100 group-hover:bg-indigo-100 flex items-center justify-center transition-all duration-300">
                            <span class="text-slate-400 group-hover:text-indigo-600 font-black text-2xl transition-colors duration-300">{{ strtoupper(substr($partner->name, 0, 2)) }}</span>
                        </div>
                    @endif
                    <span class="text-xs font-bold text-slate-400 group-hover:text-indigo-600 uppercase tracking-wider transition-colors duration-300">{{ $partner->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
