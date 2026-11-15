<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kelola Template Header & Repeater - {{ config('app.name', 'CV Generator') }}</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .bg-mesh {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 10% 20%, rgba(59, 130, 246, 0.08) 0px, transparent 50%),
                radial-gradient(at 80% 10%, rgba(99, 102, 241, 0.06) 0px, transparent 50%),
                radial-gradient(at 50% 80%, rgba(59, 130, 246, 0.04) 0px, transparent 50%);
        }
    </style>
</head>
<body class="h-full bg-mesh text-slate-800 antialiased">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo & Nav Links -->
                <div class="flex items-center gap-6">
                    <a href="{{ Route::has('dashboard') ? route('dashboard') : url('/') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-brand-600 to-indigo-600 rounded-lg flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-slate-800">CV Generator</span>
                    </a>

                    <div class="hidden md:flex items-center gap-1 border-l border-slate-200 pl-6">
                        <a href="{{ Route::has('dashboard') ? route('dashboard') : url('/dashboard') }}" class="px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-slate-900 rounded-lg hover:bg-slate-100 transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ Route::has('cv.preview') ? route('cv.preview') : url('/cv') }}" class="px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-slate-900 rounded-lg hover:bg-slate-100 transition-colors">
                            Preview CV
                        </a>
                        <span class="px-3 py-1.5 text-sm font-semibold text-brand-700 bg-brand-50 rounded-lg">
                            Template Header Sections
                        </span>
                    </div>
                </div>

                <!-- User Profile & Action -->
                <div class="flex items-center gap-3">
                    @auth
                        <span class="text-sm text-slate-600 hidden sm:inline-block">
                            Halo, <span class="font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                        </span>
                    @endauth

                    <a href="{{ Route::has('dashboard') ? route('dashboard') : url('/dashboard') }}" class="inline-flex items-center gap-2 px-3.5 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span class="hidden sm:inline">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Flash Messages -->
        @if(session('success'))
            <div id="flash-success" class="mb-6 flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800 shadow-sm transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
                <button onclick="document.getElementById('flash-success').remove()" class="text-emerald-500 hover:text-emerald-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div id="flash-error" class="mb-6 flex items-center justify-between p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 shadow-sm transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">{{ session('error') }}</p>
                    </div>
                </div>
                <button onclick="document.getElementById('flash-error').remove()" class="text-red-500 hover:text-red-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm">
                <div class="flex items-center gap-2 font-semibold text-red-800 mb-2">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Periksa kembali data input formulir:
                </div>
                <ul class="list-disc list-inside text-red-700 space-y-1 ml-6">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-100 text-brand-800 border border-brand-200">
                        Header & Repeater Builder
                    </span>
                    <span class="text-xs text-slate-500">CV Generator Settings</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Konfigurasi Template Header</h1>
                <p class="mt-1 text-slate-500 text-sm">
                    Kelola bagian section (seperti Pendidikan, Pengalaman, Keahlian) dan definisikan repeater fields dinamis untuk format CV.
                </p>
            </div>

            <div class="flex items-center gap-2.5">
                <button type="button" onclick="focusBuilderForm()" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-700 hover:to-indigo-700 rounded-xl shadow-sm shadow-brand-500/20 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Section Baru
                </button>
            </div>
        </div>

        @php
            // Fallback variable untuk list sections agar view bisa langsung dirender baik dari controller maupun standalone
            $sections = $templateHeaderSections ?? $sections ?? collect([]);
            $totalSections = $sections->count();
            $repeaterSections = $sections->where('type', 'repeater')->count();
            $totalRepeaterFields = $sections->sum(function($sec) {
                return $sec->repeaterFields ? $sec->repeaterFields->count() : 0;
            });
            $standardSections = $totalSections - $repeaterSections;
        @endphp

        <!-- Metrics Overview Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Total Sections -->
            <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:border-slate-300 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Section</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-slate-900">{{ $totalSections }}</span>
                    <span class="text-xs text-slate-500">Kategori header</span>
                </div>
            </div>

            <!-- Repeater Sections -->
            <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:border-slate-300 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tipe Repeater</span>
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-slate-900">{{ $repeaterSections }}</span>
                    <span class="text-xs text-indigo-600 font-medium">Berisi sub-kolom</span>
                </div>
            </div>

            <!-- Total Repeater Fields -->
            <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:border-slate-300 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Sub-Fields</span>
                    <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-slate-900">{{ $totalRepeaterFields }}</span>
                    <span class="text-xs text-purple-600 font-medium">Kolom terdefinisi</span>
                </div>
            </div>

            <!-- Static / Text Sections -->
            <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:border-slate-300 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tipe Standar</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-slate-900">{{ $standardSections }}</span>
                    <span class="text-xs text-slate-500">Text/Textarea/List</span>
                </div>
            </div>
        </div>

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- LEFT COLUMN: Section & Repeater Builder Form (5 Cols) -->
            <div class="lg:col-span-5" id="form-builder-card">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden sticky top-24">
                    <!-- Card Top Header -->
                    <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-indigo-50/40 border-b border-slate-200 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div id="form-icon-container" class="w-10 h-10 bg-brand-100 text-brand-600 rounded-xl flex items-center justify-center font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <div>
                                <h2 id="form-title" class="text-base font-bold text-slate-900">Buat Section Baru</h2>
                                <p id="form-subtitle" class="text-xs text-slate-500">Isi atribut section & repeater field</p>
                            </div>
                        </div>

                        <!-- Reset / Cancel Button -->
                        <button type="button" onclick="resetFormBuilder()" id="btn-cancel-edit" class="hidden text-xs font-medium text-slate-500 hover:text-red-600 bg-white border border-slate-200 hover:border-red-200 px-2.5 py-1.5 rounded-lg transition-colors">
                            Batal Edit
                        </button>
                    </div>

                    <!-- Builder Form -->
                    <form id="section-form" action="{{ Route::has('template-header.store') ? route('template-header.store') : url('/template-header') }}" method="POST" class="p-6 space-y-6">
                        @csrf
                        <input type="hidden" name="_method" id="form-http-method" value="POST">
                        <input type="hidden" name="id_template_header" id="input-id-template-header" value="">

                        <!-- Title Input -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-800 mb-1.5">
                                Judul Section (Title) <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}"
                                   placeholder="Contoh: Riwayat Pendidikan, Pengalaman Kerja..."
                                   required
                                   class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors @error('title') border-red-300 @enderror">
                            <p class="text-xs text-slate-400 mt-1">Nama heading yang akan tampil pada lembar CV pelamar.</p>
                            @error('title')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Section Type Selector -->
                        <div>
                            <label for="type" class="block text-sm font-semibold text-slate-800 mb-1.5">
                                Tipe Konten Section <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="type"
                                        name="type"
                                        required
                                        onchange="handleSectionTypeChange(this.value)"
                                        class="w-full appearance-none px-3.5 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors pr-10 @error('type') border-red-300 @enderror">
                                    <option value="repeater" {{ old('type', 'repeater') == 'repeater' ? 'selected' : '' }}>
                                        🔄 Repeater (Tabel/Daftar Multi-Kolom Dinamis)
                                    </option>
                                    <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>
                                        🔤 Text (Single Line Input)
                                    </option>
                                    <option value="textarea" {{ old('type') == 'textarea' ? 'selected' : '' }}>
                                        📝 Textarea (Multi-Line Paragraph)
                                    </option>
                                    <option value="list" {{ old('type') == 'list' ? 'selected' : '' }}>
                                        📋 List (Daftar Bullet Points)
                                    </option>
                                    <option value="richtext" {{ old('type') == 'richtext' ? 'selected' : '' }}>
                                        ✨ Richtext (Format HTML / WYSIWYG)
                                    </option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Dynamic Helper Description based on Type -->
                            <div id="type-description-box" class="mt-2 p-3 bg-brand-50/60 border border-brand-100 rounded-xl text-xs text-brand-800 flex items-start gap-2">
                                <svg class="w-4 h-4 text-brand-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span id="type-description-text">
                                    Tipe <strong>Repeater</strong> memungkinkan user menambahkan banyak baris entri dengan sub-field kustom (misal: Instansi, Posisi, Periode).
                                </span>
                            </div>
                        </div>

                        <!-- REPEATER BUILDER AREA (Visible when type == 'repeater') -->
                        <div id="repeater-builder-section" class="pt-2 border-t border-slate-200">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-1.5">
                                        Sub-Fields Repeater
                                        <span id="fields-counter" class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full font-semibold">
                                            0 Field
                                        </span>
                                    </h3>
                                    <p class="text-xs text-slate-500">Tentukan kolom yang akan diisi berulang kali.</p>
                                </div>

                                <button type="button"
                                        onclick="addRepeaterFieldRow()"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-brand-700 bg-brand-50 hover:bg-brand-100 border border-brand-200 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Field
                                </button>
                            </div>

                            <!-- Quick Presets Dropdown / Buttons -->
                            <div class="mb-4 p-3 bg-slate-50 border border-slate-200 rounded-xl">
                                <span class="block text-xs font-semibold text-slate-600 mb-2">⚡ Rekomendasi Preset Cepat:</span>
                                <div class="flex flex-wrap gap-1.5">
                                    <button type="button" onclick="applyPreset('pendidikan')" class="px-2.5 py-1 text-xs font-medium bg-white hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200 hover:border-indigo-200 rounded-lg transition-colors shadow-2xs">
                                        🎓 Pendidikan
                                    </button>
                                    <button type="button" onclick="applyPreset('pengalaman')" class="px-2.5 py-1 text-xs font-medium bg-white hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200 hover:border-indigo-200 rounded-lg transition-colors shadow-2xs">
                                        💼 Pengalaman Kerja
                                    </button>
                                    <button type="button" onclick="applyPreset('organisasi')" class="px-2.5 py-1 text-xs font-medium bg-white hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200 hover:border-indigo-200 rounded-lg transition-colors shadow-2xs">
                                        👥 Organisasi
                                    </button>
                                    <button type="button" onclick="applyPreset('sertifikasi')" class="px-2.5 py-1 text-xs font-medium bg-white hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200 hover:border-indigo-200 rounded-lg transition-colors shadow-2xs">
                                        📜 Sertifikasi
                                    </button>
                                </div>
                            </div>

                            <!-- Container of Dynamic Repeater Field Rows -->
                            <div id="repeater-fields-container" class="space-y-3">
                                <!-- Repeater row items dynamically injected here -->
                            </div>

                            <!-- Empty Field Notice -->
                            <div id="empty-fields-alert" class="text-center py-6 px-4 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50/50">
                                <svg class="w-8 h-8 mx-auto text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-xs text-slate-500 font-medium">Belum ada sub-field repeater ditambahkan.</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Klik tombol "+ Tambah Field" atau pilih salah satu preset di atas.</p>
                            </div>
                        </div>

                        <!-- Submit and Actions -->
                        <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
                            <button type="button" onclick="resetFormBuilder()" class="px-4 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                                Reset
                            </button>
                            <button type="submit" id="btn-submit-form" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-700 hover:to-indigo-700 rounded-xl shadow-sm shadow-brand-500/25 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span id="submit-text">Simpan Section</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT COLUMN: Section List & Visual Preview (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">

                <!-- Search, Filter & Controls -->
                <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                    <div class="relative flex-1">
                        <input type="text"
                               id="search-input"
                               onkeyup="filterSectionsList()"
                               placeholder="Cari judul section atau nama field..."
                               class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:bg-white transition-all">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <select id="filter-type" onchange="filterSectionsList()" class="text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-brand-500">
                            <option value="all">Semua Tipe</option>
                            <option value="repeater">Repeater</option>
                            <option value="text">Text</option>
                            <option value="textarea">Textarea</option>
                            <option value="list">List</option>
                            <option value="richtext">Richtext</option>
                        </select>
                    </div>
                </div>

                <!-- Sections List Container -->
                <div class="space-y-4" id="sections-container">
                    @forelse($sections as $section)
                        <div class="section-card bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden"
                             data-title="{{ strtolower($section->title) }}"
                             data-type="{{ $section->type }}"
                             data-id="{{ $section->id_template_header }}"
                             data-json="{{ json_encode([
                                 'id_template_header' => $section->id_template_header,
                                 'title' => $section->title,
                                 'type' => $section->type,
                                 'repeater_fields' => $section->repeaterFields ?? []
                             ]) }}">

                            <!-- Section Header Bar -->
                            <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-gradient-to-r from-white to-slate-50/50">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 
                                        @if($section->type == 'repeater') bg-indigo-50 text-indigo-600
                                        @elseif($section->type == 'textarea') bg-amber-50 text-amber-600
                                        @elseif($section->type == 'richtext') bg-purple-50 text-purple-600
                                        @elseif($section->type == 'list') bg-teal-50 text-teal-600
                                        @else bg-blue-50 text-blue-600 @endif">
                                        
                                        @if($section->type == 'repeater')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        @elseif($section->type == 'textarea' || $section->type == 'richtext')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                            </svg>
                                        @elseif($section->type == 'list')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        @endif
                                    </div>

                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h3 class="text-base font-bold text-slate-900">{{ $section->title }}</h3>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold tracking-wide uppercase
                                                @if($section->type == 'repeater') bg-indigo-100 text-indigo-700
                                                @elseif($section->type == 'textarea') bg-amber-100 text-amber-700
                                                @elseif($section->type == 'richtext') bg-purple-100 text-purple-700
                                                @elseif($section->type == 'list') bg-teal-100 text-teal-700
                                                @else bg-blue-100 text-blue-700 @endif">
                                                {{ $section->type }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-slate-400 mt-0.5">ID: #{{ $section->id_template_header }} &bull; Dibuat {{ $section->created_at?->diffForHumans() ?? 'baru saja' }}</p>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2 self-end sm:self-auto">
                                    <!-- Preview Button -->
                                    <button type="button" 
                                            onclick="openLivePreviewModal({{ $section->id_template_header }})" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg transition-colors shadow-2xs"
                                            title="Pratinjau tampilan form input CV">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Pratinjau
                                    </button>

                                    <!-- Edit Button -->
                                    <button type="button"
                                            onclick="loadSectionToEdit({{ $section->id_template_header }})"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-brand-700 bg-brand-50 hover:bg-brand-100 border border-brand-200 rounded-lg transition-colors"
                                            title="Edit data section & repeater fields">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button"
                                            onclick="confirmDeleteSection({{ $section->id_template_header }}, '{{ addslashes($section->title) }}')"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-red-600 bg-white hover:bg-red-50 border border-slate-200 hover:border-red-200 rounded-lg transition-colors"
                                            title="Hapus section">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Section Details Body -->
                            <div class="p-5">
                                @if($section->type == 'repeater')
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                                Repeater Sub-Fields ({{ $section->repeaterFields ? $section->repeaterFields->count() : 0 }})
                                            </span>
                                            <span class="text-[11px] text-slate-400">Tersusun dinamis untuk CV</span>
                                        </div>

                                        @if($section->repeaterFields && $section->repeaterFields->count() > 0)
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
                                                @foreach($section->repeaterFields as $field)
                                                    <div class="flex items-center justify-between p-2.5 bg-slate-50 border border-slate-200/80 rounded-xl hover:bg-slate-100/60 transition-colors">
                                                        <div class="min-w-0 pr-2">
                                                            <div class="text-xs font-semibold text-slate-800 truncate">{{ $field->label }}</div>
                                                            <div class="text-[11px] font-mono text-slate-400 truncate">{{ $field->name }}</div>
                                                        </div>
                                                        <span class="shrink-0 inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-medium 
                                                            @if($field->type == 'date') bg-blue-100 text-blue-700
                                                            @elseif($field->type == 'number') bg-emerald-100 text-emerald-700
                                                            @elseif($field->type == 'email' || $field->type == 'url') bg-cyan-100 text-cyan-700
                                                            @elseif($field->type == 'textarea' || $field->type == 'richtext') bg-purple-100 text-purple-700
                                                            @else bg-slate-200 text-slate-700 @endif">
                                                            {{ $field->type }}
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="p-3 bg-amber-50/60 border border-amber-200 rounded-xl text-xs text-amber-700 flex items-center gap-2">
                                                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                                <span>Section ini bertipe repeater tapi belum memiliki sub-field. Klik <strong>Edit</strong> untuk menambahkan kolom.</span>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="p-3 bg-slate-50 border border-slate-200/80 rounded-xl flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-400 shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="text-xs text-slate-600">
                                            @if($section->type == 'textarea')
                                                Section ini akan menyediakan area input teks multi-paragraf bebas (misal: ringkasan profil, visi misi).
                                            @elseif($section->type == 'richtext')
                                                Section ini mendukung styling rich-text seperti bold, italic, dan bullet formatting.
                                            @elseif($section->type == 'list')
                                                Section ini menyediakan daftar item berurutan/bullet points sederhana (misal: poin keahlian singkat).
                                            @else
                                                Section ini menyediakan satu baris input teks standar (single text input).
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <!-- Empty State -->
                        <div id="main-empty-state" class="bg-white rounded-2xl border-2 border-dashed border-slate-200 p-8 sm:p-12 text-center">
                            <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto text-brand-600 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-slate-900">Belum Ada Section Template</h3>
                            <p class="text-slate-500 text-xs sm:text-sm max-w-md mx-auto mt-1 mb-6">
                                Anda belum menambahkan template header section. Mulai dengan membuat section bertipe Repeater seperti Pendidikan atau Pengalaman Kerja pada form di sebelah kiri.
                            </p>
                            <button type="button" onclick="focusBuilderForm()" class="inline-flex items-center gap-2 px-4 py-2.5 text-xs sm:text-sm font-semibold text-white bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-700 hover:to-indigo-700 rounded-xl shadow-sm shadow-brand-500/20 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Buat Section Pertama Anda
                            </button>
                        </div>
                    @endforelse
                </div>

                <!-- No Filter Result Notice (Hidden by default) -->
                <div id="no-search-results" class="hidden bg-white rounded-2xl border border-slate-200 p-8 text-center">
                    <p class="text-sm font-semibold text-slate-700">Tidak ada section yang cocok dengan pencarian.</p>
                    <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci lain atau pilih "Semua Tipe".</p>
                </div>

            </div>
        </div>

    </main>

    <!-- LIVE PREVIEW MODAL (Simulasi Form Pengisian CV oleh Pengguna) -->
    <div id="preview-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-2xl w-full overflow-hidden transition-all transform duration-200">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/60 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-brand-100 text-brand-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 id="preview-modal-title" class="text-base font-bold text-slate-900">Simulasi Tampilan Form CV</h3>
                        <p id="preview-modal-subtitle" class="text-xs text-slate-500">Begini tampilan interaktif ketika pengguna mengisi CV</p>
                    </div>
                </div>

                <button type="button" onclick="closePreviewModal()" class="text-slate-400 hover:text-slate-600 rounded-lg p-1.5 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Content Simulation -->
            <div id="preview-modal-body" class="p-6 max-h-[70vh] overflow-y-auto space-y-4">
                <!-- Dynamically populated via JS -->
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
                <span class="text-xs text-slate-400">Pratinjau input form responsif</span>
                <button type="button" onclick="closePreviewModal()" class="px-4 py-2 text-xs sm:text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-100 transition-colors">
                    Tutup Pratinjau
                </button>
            </div>
        </div>
    </div>

    <!-- DELETE CONFIRMATION MODAL -->
    <div id="delete-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-md w-full p-6 text-center">
            <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>

            <h3 class="text-lg font-bold text-slate-900">Hapus Section Template?</h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-2 mb-6">
                Apakah Anda yakin ingin menghapus section <strong id="delete-section-title" class="text-slate-800"></strong>? Semua sub-fields repeater di dalamnya juga akan ikut terhapus secara permanen.
            </p>

            <form id="delete-form" action="" method="POST" class="flex items-center justify-center gap-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-sm transition-colors">
                    Ya, Hapus Section
                </button>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC & DYNAMIC REPEATER BUILDER -->
    <script>
        let fieldIndex = 0;

        // Tipe repeater field yang tersedia
        const repeaterFieldTypes = [
            { value: 'text', label: 'Text (Satu Baris)' },
            { value: 'textarea', label: 'Textarea (Paragraf)' },
            { value: 'date', label: 'Date (Tanggal/Tahun)' },
            { value: 'number', label: 'Number (Angka/IPK)' },
            { value: 'email', label: 'Email' },
            { value: 'url', label: 'URL / Link Web' },
            { value: 'richtext', label: 'Richtext' }
        ];

        // Deskripsi bantuan untuk masing-masing tipe section
        const typeDescriptions = {
            'repeater': 'Tipe <strong>Repeater</strong> memungkinkan user menambahkan banyak baris entri dengan sub-field kustom (misal: Instansi, Posisi, Periode).',
            'text': 'Tipe <strong>Text</strong> menyediakan single input teks standar untuk judul atau informasi ringkas.',
            'textarea': 'Tipe <strong>Textarea</strong> menyediakan input multi-baris untuk deskripsi panjang atau paragraf naratif.',
            'list': 'Tipe <strong>List</strong> memungkinkan pengguna mengisi daftar poin-poin terurut (bullet points).',
            'richtext': 'Tipe <strong>Richtext</strong> menyediakan area penulisan dengan formatting seperti tebal, miring, dan list.'
        };

        // Preset data untuk memudahkan pengisian cepat
        const presets = {
            'pendidikan': {
                title: 'Riwayat Pendidikan',
                type: 'repeater',
                fields: [
                    { label: 'Nama Sekolah / Universitas', name: 'institution_name', type: 'text' },
                    { label: 'Gelar / Jurusan', name: 'degree_major', type: 'text' },
                    { label: 'Tahun Mulai', name: 'start_date', type: 'date' },
                    { label: 'Tahun Kelulusan', name: 'end_date', type: 'date' },
                    { label: 'Nilai Akhir / IPK', name: 'gpa', type: 'number' },
                    { label: 'Deskripsi / Aktivitas', name: 'description', type: 'textarea' }
                ]
            },
            'pengalaman': {
                title: 'Pengalaman Kerja',
                type: 'repeater',
                fields: [
                    { label: 'Nama Perusahaan / Organisasi', name: 'company_name', type: 'text' },
                    { label: 'Posisi / Jabatan', name: 'job_title', type: 'text' },
                    { label: 'Tanggal Mulai', name: 'start_date', type: 'date' },
                    { label: 'Tanggal Selesai', name: 'end_date', type: 'date' },
                    { label: 'Lokasi Perusahaan', name: 'location', type: 'text' },
                    { label: 'Uraian Tugas & Prestasi', name: 'responsibilities', type: 'textarea' }
                ]
            },
            'organisasi': {
                title: 'Pengalaman Organisasi',
                type: 'repeater',
                fields: [
                    { label: 'Nama Organisasi', name: 'organization_name', type: 'text' },
                    { label: 'Peran / Jabatan', name: 'role', type: 'text' },
                    { label: 'Periode Aktif', name: 'period', type: 'text' },
                    { label: 'Deskripsi Kontribusi', name: 'contribution', type: 'textarea' }
                ]
            },
            'sertifikasi': {
                title: 'Lisensi & Sertifikasi',
                type: 'repeater',
                fields: [
                    { label: 'Nama Sertifikat', name: 'certificate_name', type: 'text' },
                    { label: 'Lembaga Penerbit', name: 'issuing_organization', type: 'text' },
                    { label: 'Tahun Terbit', name: 'issue_date', type: 'date' },
                    { label: 'URL Kredensial', name: 'credential_url', type: 'url' }
                ]
            }
        };

        // Event listener saat DOM siap
        document.addEventListener('DOMContentLoaded', function () {
            // Jika container kosong dan tipe repeater aktif, tambahkan 1 field default
            const currentType = document.getElementById('type').value;
            handleSectionTypeChange(currentType);

            // Jika belum ada row sama sekali pada saat buka baru
            const container = document.getElementById('repeater-fields-container');
            if (currentType === 'repeater' && container.children.length === 0) {
                addRepeaterFieldRow('Nama Entri / Instansi', 'entry_name', 'text');
            }
        });

        // Handler perubahan tipe section
        function handleSectionTypeChange(selectedType) {
            const repeaterSection = document.getElementById('repeater-builder-section');
            const descText = document.getElementById('type-description-text');

            if (typeDescriptions[selectedType]) {
                descText.innerHTML = typeDescriptions[selectedType];
            }

            if (selectedType === 'repeater') {
                repeaterSection.classList.remove('hidden');
            } else {
                repeaterSection.classList.add('hidden');
            }
        }

        // Tambah baris repeater field
        function addRepeaterFieldRow(labelVal = '', nameVal = '', typeVal = 'text') {
            const container = document.getElementById('repeater-fields-container');
            const alertEmpty = document.getElementById('empty-fields-alert');
            const idx = fieldIndex++;

            const row = document.createElement('div');
            row.id = `repeater-row-${idx}`;
            row.className = 'repeater-field-row p-3.5 bg-slate-50 border border-slate-200 rounded-xl space-y-3 transition-all hover:border-slate-300';

            // Generate options untuk tipe field
            const optionsHtml = repeaterFieldTypes.map(t =>
                `<option value="${t.value}" ${t.value === typeVal ? 'selected' : ''}>${t.label}</option>`
            ).join('');

            row.innerHTML = `
                <div class="flex items-center justify-between pb-2 border-b border-slate-200/60">
                    <span class="text-xs font-bold text-slate-700 flex items-center gap-1.5">
                        <span class="w-5 h-5 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-[10px] font-bold row-number">
                            ${container.children.length + 1}
                        </span>
                        Field Sub-Kolom
                    </span>
                    <button type="button" onclick="removeRepeaterFieldRow(${idx})" class="text-slate-400 hover:text-red-600 p-1 rounded-md transition-colors" title="Hapus field ini">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-2.5">
                    <!-- Label Field -->
                    <div class="sm:col-span-5">
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Label Tampilan <span class="text-red-500">*</span></label>
                        <input type="text"
                               name="repeater_fields[${idx}][label]"
                               value="${escapeHtml(labelVal)}"
                               placeholder="e.g. Nama Universitas"
                               onkeyup="autoGenerateFieldName(this, ${idx})"
                               required
                               class="w-full px-2.5 py-1.5 bg-white border border-slate-300 rounded-lg text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-brand-500">
                    </div>

                    <!-- Name / Variable Key -->
                    <div class="sm:col-span-4">
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Field Name (Key) <span class="text-red-500">*</span></label>
                        <input type="text"
                               id="field-name-input-${idx}"
                               name="repeater_fields[${idx}][name]"
                               value="${escapeHtml(nameVal)}"
                               placeholder="e.g. university_name"
                               required
                               class="w-full px-2.5 py-1.5 bg-white border border-slate-300 rounded-lg text-xs font-mono text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-brand-500">
                    </div>

                    <!-- Type Field -->
                    <div class="sm:col-span-3">
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Tipe Data</label>
                        <select name="repeater_fields[${idx}][type]"
                                class="w-full px-2 py-1.5 bg-white border border-slate-300 rounded-lg text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-brand-500">
                            ${optionsHtml}
                        </select>
                    </div>
                </div>
            `;

            container.appendChild(row);
            alertEmpty.classList.add('hidden');
            updateFieldsCounter();
            updateRowNumbers();
        }

        // Hapus baris repeater field
        function removeRepeaterFieldRow(idx) {
            const row = document.getElementById(`repeater-row-${idx}`);
            if (row) {
                row.remove();
            }
            const container = document.getElementById('repeater-fields-container');
            const alertEmpty = document.getElementById('empty-fields-alert');
            if (container.children.length === 0) {
                alertEmpty.classList.remove('hidden');
            }
            updateFieldsCounter();
            updateRowNumbers();
        }

        // Update counter dan urutan nomor baris
        function updateFieldsCounter() {
            const count = document.getElementById('repeater-fields-container').children.length;
            document.getElementById('fields-counter').innerText = `${count} Field`;
        }

        function updateRowNumbers() {
            const container = document.getElementById('repeater-fields-container');
            const rows = container.querySelectorAll('.repeater-field-row');
            rows.forEach((row, i) => {
                const badge = row.querySelector('.row-number');
                if (badge) badge.innerText = i + 1;
            });
        }

        // Auto generate field name (snake_case) dari label
        function autoGenerateFieldName(inputElement, idx) {
            const nameInput = document.getElementById(`field-name-input-${idx}`);
            // Hanya auto-slug jika user belum mengetik manual di field name atau value masih kosong/identik
            const slug = inputElement.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s_]/g, '')
                .replace(/\s+/g, '_');
            nameInput.value = slug;
        }

        // Terapkan preset siap pakai
        function applyPreset(presetKey) {
            const preset = presets[presetKey];
            if (!preset) return;

            document.getElementById('title').value = preset.title;
            document.getElementById('type').value = preset.type;
            handleSectionTypeChange(preset.type);

            // Bersihkan fields sekarang
            const container = document.getElementById('repeater-fields-container');
            container.innerHTML = '';
            fieldIndex = 0;

            // Tambahkan field preset
            preset.fields.forEach(f => {
                addRepeaterFieldRow(f.label, f.name, f.type);
            });
        }

        // Reset form ke mode buat baru
        function resetFormBuilder() {
            const form = document.getElementById('section-form');
            form.reset();
            document.getElementById('input-id-template-header').value = '';
            document.getElementById('form-http-method').value = 'POST';

            // Reset UI Header Form
            document.getElementById('form-title').innerText = 'Buat Section Baru';
            document.getElementById('form-subtitle').innerText = 'Isi atribut section & repeater field';
            document.getElementById('submit-text').innerText = 'Simpan Section';
            document.getElementById('btn-cancel-edit').classList.add('hidden');
            document.getElementById('form-icon-container').className = 'w-10 h-10 bg-brand-100 text-brand-600 rounded-xl flex items-center justify-center font-semibold';

            // Set default action URL
            form.action = "{{ Route::has('template-header.store') ? route('template-header.store') : url('/template-header') }}";

            // Bersihkan repeater container & isi default
            const container = document.getElementById('repeater-fields-container');
            container.innerHTML = '';
            fieldIndex = 0;
            handleSectionTypeChange('repeater');
            addRepeaterFieldRow('Nama Entri / Instansi', 'entry_name', 'text');
        }

        // Load data section ke form untuk diedit
        function loadSectionToEdit(id) {
            const card = document.querySelector(`.section-card[data-id="${id}"]`);
            if (!card) return;

            const data = JSON.parse(card.getAttribute('data-json'));
            if (!data) return;

            // Switch to Edit UI
            document.getElementById('form-title').innerText = 'Edit Section #' + data.id_template_header;
            document.getElementById('form-subtitle').innerText = 'Perbarui judul atau konfigurasi field';
            document.getElementById('submit-text').innerText = 'Perbarui Section';
            document.getElementById('btn-cancel-edit').classList.remove('hidden');
            document.getElementById('form-icon-container').className = 'w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center font-semibold';

            // Populate form values
            document.getElementById('input-id-template-header').value = data.id_template_header;
            document.getElementById('title').value = data.title;
            document.getElementById('type').value = data.type;
            document.getElementById('form-http-method').value = 'PUT';

            // Update form action url
            const form = document.getElementById('section-form');
            form.action = "{{ url('/template-header') }}/" + data.id_template_header;

            handleSectionTypeChange(data.type);

            // Populate repeater fields jika ada
            const container = document.getElementById('repeater-fields-container');
            container.innerHTML = '';
            fieldIndex = 0;

            if (data.type === 'repeater' && data.repeater_fields && data.repeater_fields.length > 0) {
                data.repeater_fields.forEach(f => {
                    addRepeaterFieldRow(f.label, f.name, f.type);
                });
            } else if (data.type === 'repeater') {
                document.getElementById('empty-fields-alert').classList.remove('hidden');
                updateFieldsCounter();
            }

            focusBuilderForm();
        }

        // Fokus scroll ke card builder form
        function focusBuilderForm() {
            const card = document.getElementById('form-builder-card');
            card.scrollIntoView({ behavior: 'smooth', block: 'start' });
            document.getElementById('title').focus();
        }

        // Filter / Search section list
        function filterSectionsList() {
            const query = document.getElementById('search-input').value.toLowerCase().trim();
            const typeFilter = document.getElementById('filter-type').value;
            const cards = document.querySelectorAll('.section-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const title = card.getAttribute('data-title');
                const type = card.getAttribute('data-type');
                const jsonText = card.getAttribute('data-json').toLowerCase();

                const matchesQuery = !query || title.includes(query) || jsonText.includes(query);
                const matchesType = (typeFilter === 'all') || (type === typeFilter);

                if (matchesQuery && matchesType) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            const noResult = document.getElementById('no-search-results');
            if (visibleCount === 0 && cards.length > 0) {
                noResult.classList.remove('hidden');
            } else {
                noResult.classList.add('hidden');
            }
        }

        // Live Preview Modal
        function openLivePreviewModal(id) {
            const card = document.querySelector(`.section-card[data-id="${id}"]`);
            if (!card) return;

            const data = JSON.parse(card.getAttribute('data-json'));
            if (!data) return;

            document.getElementById('preview-modal-title').innerText = `Simulasi Form: ${data.title}`;
            document.getElementById('preview-modal-subtitle').innerText = `Tipe Section: ${data.type.toUpperCase()}`;

            const modalBody = document.getElementById('preview-modal-body');
            modalBody.innerHTML = '';

            let contentHtml = '';

            if (data.type === 'repeater') {
                const fields = data.repeater_fields || [];
                contentHtml = `
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white">
                        <div class="p-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                            <h4 class="text-sm font-bold text-slate-900">${escapeHtml(data.title)}</h4>
                            <span class="text-xs text-indigo-600 font-semibold bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-100">+ Tambah Entri Baris</span>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="p-4 bg-slate-50/70 border border-slate-200 rounded-xl space-y-3">
                                <div class="flex items-center justify-between text-xs font-semibold text-slate-500 pb-2 border-b border-slate-200">
                                    <span>Entri #1</span>
                                    <span class="text-slate-400 font-normal">Contoh Isian</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                `;

                if (fields.length === 0) {
                    contentHtml += `
                        <div class="col-span-2 text-center py-4 text-xs text-slate-400">
                            (Belum ada repeater field yang ditentukan pada section ini)
                        </div>
                    `;
                } else {
                    fields.forEach(f => {
                        let inputElement = '';
                        if (f.type === 'textarea' || f.type === 'richtext') {
                            inputElement = `<textarea disabled placeholder="Masukkan ${escapeHtml(f.label)}..." class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-xs h-16 resize-none"></textarea>`;
                        } else if (f.type === 'date') {
                            inputElement = `<input type="date" disabled class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-xs">`;
                        } else if (f.type === 'number') {
                            inputElement = `<input type="number" disabled placeholder="0" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-xs">`;
                        } else {
                            inputElement = `<input type="text" disabled placeholder="Isi ${escapeHtml(f.label)}..." class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-xs">`;
                        }

                        const colSpan = (f.type === 'textarea' || f.type === 'richtext') ? 'sm:col-span-2' : '';

                        contentHtml += `
                            <div class="${colSpan}">
                                <label class="block text-xs font-medium text-slate-700 mb-1">${escapeHtml(f.label)}</label>
                                ${inputElement}
                            </div>
                        `;
                    });
                }

                contentHtml += `
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else if (data.type === 'textarea' || data.type === 'richtext') {
                contentHtml = `
                    <div class="bg-white p-4 border border-slate-200 rounded-xl space-y-2">
                        <label class="block text-sm font-semibold text-slate-800">${escapeHtml(data.title)}</label>
                        <textarea disabled rows="4" placeholder="Pengguna akan menulis paragraf deskripsi di sini..." class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg text-xs resize-none"></textarea>
                    </div>
                `;
            } else if (data.type === 'list') {
                contentHtml = `
                    <div class="bg-white p-4 border border-slate-200 rounded-xl space-y-2">
                        <label class="block text-sm font-semibold text-slate-800">${escapeHtml(data.title)}</label>
                        <div class="space-y-2">
                            <input type="text" disabled value="Item 1 (Contoh: Node.js & Express)" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-xs">
                            <input type="text" disabled value="Item 2 (Contoh: Laravel Framework)" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-xs">
                        </div>
                    </div>
                `;
            } else {
                contentHtml = `
                    <div class="bg-white p-4 border border-slate-200 rounded-xl space-y-2">
                        <label class="block text-sm font-semibold text-slate-800">${escapeHtml(data.title)}</label>
                        <input type="text" disabled placeholder="Teks satu baris..." class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-xs">
                    </div>
                `;
            }

            modalBody.innerHTML = contentHtml;
            document.getElementById('preview-modal').classList.remove('hidden');
        }

        function closePreviewModal() {
            document.getElementById('preview-modal').classList.add('hidden');
        }

        // Delete Confirmation Modal
        function confirmDeleteSection(id, title) {
            document.getElementById('delete-section-title').innerText = `"${title}"`;
            const deleteForm = document.getElementById('delete-form');
            deleteForm.action = "{{ url('/template-header') }}/" + id;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }

        // Helper escape HTML
        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }
    </script>
</body>
</html>

