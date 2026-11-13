<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard - {{ config('app.name', 'CV Generator') }}</title>

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
<body class="h-full bg-mesh">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-brand-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-slate-800">CV Generator</span>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <span class="text-sm text-slate-600 hidden sm:block">
                        Halo, <span class="font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 hover:text-red-600 hover:border-red-300 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Flash Message -->
        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700" id="flash-success">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
            <button onclick="document.getElementById('flash-success').remove()" class="ml-auto text-green-400 hover:text-green-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        @endif

        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Selamat Datang, {{ Auth::user()->name }}! 👋
            </h1>
            <p class="mt-2 text-slate-500 text-sm sm:text-base">
                Kelola dan lihat CV profesional Anda dari dashboard ini.
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Card: CV Preview -->
            <div class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-lg hover:border-brand-200 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                        <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-green-600 bg-green-50 px-2.5 py-1 rounded-full">Aktif</span>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-1">Lihat CV</h3>
                <p class="text-sm text-slate-500 mb-4">Preview CV profesional Anda dalam format yang siap cetak.</p>
                <a href="{{ route('cv.preview') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-brand-600 hover:text-brand-700 transition-colors">
                    Buka Preview
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>

            <!-- Card: Quick Actions -->
            <div class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-lg hover:border-brand-200 transition-all duration-300 group sm:col-span-2 lg:col-span-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-1">Aksi Cepat</h3>
                <p class="text-sm text-slate-500 mb-4">Pintasan untuk fitur yang sering digunakan.</p>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('cv.preview') }}" class="flex items-center gap-3 px-3 py-2.5 bg-slate-50 rounded-lg hover:bg-brand-50 hover:text-brand-700 text-sm text-slate-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download CV (PDF)
                    </a>
                    <a href="{{ route('cv.preview') }}" class="flex items-center gap-3 px-3 py-2.5 bg-slate-50 rounded-lg hover:bg-brand-50 hover:text-brand-700 text-sm text-slate-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Data CV
                    </a>
                </div>
            </div>

            <!-- Card: Profile Info -->
            <div class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-lg hover:border-brand-200 transition-all duration-300 group">
                <h3 class="text-lg font-semibold text-slate-800 mb-1">Profil Saya</h3>
                @php $dp = Auth::user()->dataPersonal; @endphp
                @if($dp)
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $dp->nama }}
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ $dp->email }}
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $dp->nomor_telepon }}
                    </div>
                    @if($dp->linkedin)
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        {{ $dp->linkedin }}
                    </div>
                    @endif
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $dp->kota }}, {{ $dp->provinsi }}, {{ $dp->negara }}
                    </div>
                </div>
                @else
                <div class="flex flex-col items-center justify-center py-4 text-center">
                    <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-slate-400">Data personal belum diisi.</p>
                    <p class="text-xs text-slate-400 mt-1">Klik tombol di bawah untuk mengisi.</p>
                </div>
                @endif
                <div class="border-t border-slate-100 mt-5 pt-4">
                    <a href="{{ route('data-personal.edit') }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 14H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Data Personal
                    </a>
                </div>
            </div>
        </div>

        <!-- CV Preview Card -->
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <h2 class="text-lg font-semibold text-slate-800">Ringkasan CV</h2>
                </div>
                <a href="{{ route('cv.preview') }}" class="text-sm text-brand-600 hover:text-brand-700 font-medium transition-colors">
                    Lihat Selengkapnya →
                </a>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left: Basic Info -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-brand-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-800 text-lg">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-lg p-4">
                            <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Informasi Akun</h4>
                            <div class="space-y-2.5">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Nama</span>
                                    <span class="font-medium text-slate-800">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Email</span>
                                    <span class="font-medium text-slate-800">{{ Auth::user()->email }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Bergabung</span>
                                    <span class="font-medium text-slate-800">{{ Auth::user()->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Tips -->
                    <div class="space-y-4">
                        <div class="bg-gradient-to-br from-brand-50 to-indigo-50 rounded-lg p-5 border border-brand-100">
                            <h4 class="font-semibold text-brand-800 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                Tips CV Profesional
                            </h4>
                            <ul class="space-y-2 text-sm text-brand-700">
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-brand-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Gunakan kata kerja aktif untuk menjelaskan pengalaman
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-brand-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Sesuaikan CV dengan posisi yang dilamar
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-brand-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Cantumkan pencapaian terukur (angka/persentase)
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-brand-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Pastikan CV tidak lebih dari 2 halaman
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="border-t border-slate-200 pt-6 text-center">
            <p class="text-sm text-slate-400">
                &copy; {{ date('Y') }} CV Generator. Dibuat dengan ❤️ menggunakan Laravel.
            </p>
        </div>
    </footer>

</body>
</html>
