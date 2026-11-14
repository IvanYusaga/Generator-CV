<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Edit Data Personal - {{ config('app.name', 'CV Generator') }}</title>

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
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-brand-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-slate-800">CV Generator</span>
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <span class="text-sm text-slate-600 hidden sm:block">
                        Halo, <span class="font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                    </span>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Edit Data Personal</h1>
            <p class="mt-2 text-slate-500 text-sm sm:text-base">
                Perbarui informasi personal Anda yang akan ditampilkan di CV.
            </p>
        </div>

        <!-- Validation Errors -->
        @if($errors->any())
        <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 rounded-xl">
            <div class="flex items-center gap-2 text-sm font-medium text-red-700 mb-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Terdapat kesalahan pada input Anda:
            </div>
            <ul class="list-disc list-inside text-sm text-red-600 space-y-1 ml-7">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-800">Informasi Personal</h2>
                        <p class="text-xs text-slate-500">Field bertanda <span class="text-red-500">*</span> wajib diisi</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('data-personal.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Foto Profil -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Foto Profil
                            <span class="text-slate-400 font-normal">(opsional)</span>
                        </label>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-5 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                            <!-- Preview Foto -->
                            <div class="relative w-24 h-24 rounded-full overflow-hidden border-2 border-slate-200 bg-white flex items-center justify-center shrink-0 shadow-sm">
                                <img id="preview-image" 
                                     src="{{ !empty($dataPersonal?->foto) ? asset('storage/' . $dataPersonal->foto) : '' }}" 
                                     alt="Preview Foto" 
                                     class="w-full h-full object-cover {{ !empty($dataPersonal?->foto) ? '' : 'hidden' }}"
                                     onerror="this.classList.add('hidden'); document.getElementById('preview-placeholder')?.classList.remove('hidden');">
                                
                                <div id="preview-placeholder" class="text-center p-2 {{ !empty($dataPersonal?->foto) ? 'hidden' : '' }}">
                                    <svg class="mx-auto h-9 w-9 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Upload Button & Keterangan -->
                            <div class="flex-1 space-y-2 text-center sm:text-left">
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3">
                                    <label for="foto" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50 rounded-lg border border-indigo-200 shadow-sm transition-colors">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Pilih Foto</span>
                                    </label>
                                    <input type="file" id="foto" name="foto" accept=".png, .jpg, .jpeg" class="hidden">
                                    <span id="file-name" class="text-xs text-slate-500 truncate max-w-xs">
                                        {{ !empty($dataPersonal?->foto) ? 'Foto tersimpan' : 'Belum ada foto dipilih' }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500">Maks. 2 MB dengan format PNG, JPG, atau JPEG.</p>
                                @error('foto')
                                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Nama -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama"
                               value="{{ old('nama', $dataPersonal->nama ?? '') }}"
                               placeholder="Masukkan nama lengkap"
                               class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors @error('nama') border-red-400 ring-1 ring-red-400 @enderror"
                               required>
                        @error('nama')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', $dataPersonal->email ?? Auth::user()->email) }}"
                               placeholder="contoh@email.com"
                               class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors @error('email') border-red-400 ring-1 ring-red-400 @enderror"
                               required>
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nomor_telepon" name="nomor_telepon"
                               value="{{ old('nomor_telepon', $dataPersonal->nomor_telepon ?? '') }}"
                               placeholder="+62xxxxxxxxxx"
                               class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors @error('nomor_telepon') border-red-400 ring-1 ring-red-400 @enderror"
                               required>
                        @error('nomor_telepon')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- LinkedIn -->
                    <div class="md:col-span-2">
                        <label for="linkedin" class="block text-sm font-medium text-slate-700 mb-1.5">
                            LinkedIn
                            <span class="text-slate-400 font-normal">(opsional)</span>
                        </label>
                        <input type="text" id="linkedin" name="linkedin"
                               value="{{ old('linkedin', $dataPersonal->linkedin ?? '') }}"
                               placeholder="https://linkedin.com/in/username"
                               class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors @error('linkedin') border-red-400 ring-1 ring-red-400 @enderror">
                        @error('linkedin')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kota -->
                    <div>
                        <label for="kota" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Kota <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kota" name="kota"
                               value="{{ old('kota', $dataPersonal->kota ?? '') }}"
                               placeholder="Masukkan kota"
                               class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors @error('kota') border-red-400 ring-1 ring-red-400 @enderror"
                               required>
                        @error('kota')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Provinsi -->
                    <div>
                        <label for="provinsi" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Provinsi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="provinsi" name="provinsi"
                               value="{{ old('provinsi', $dataPersonal->provinsi ?? '') }}"
                               placeholder="Masukkan provinsi"
                               class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors @error('provinsi') border-red-400 ring-1 ring-red-400 @enderror"
                               required>
                        @error('provinsi')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Negara -->
                    <div class="md:col-span-2">
                        <label for="negara" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Negara <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="negara" name="negara"
                               value="{{ old('negara', $dataPersonal->negara ?? 'Indonesia') }}"
                               placeholder="Masukkan negara"
                               class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors @error('negara') border-red-400 ring-1 ring-red-400 @enderror"
                               required>
                        @error('negara')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200">
                    <a href="{{ route('dashboard') }}"
                       class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </main>

    <!-- Footer -->
    <footer class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="border-t border-slate-200 pt-6 text-center">
            <p class="text-sm text-slate-400">
                &copy; {{ date('Y') }} CV Generator. Dibuat dengan ❤️ menggunakan Laravel.
            </p>
        </div>
    </footer>

    <script>
        const fotoInput = document.getElementById('foto');
        const previewImage = document.getElementById('preview-image');
        const previewPlaceholder = document.getElementById('preview-placeholder');
        const fileName = document.getElementById('file-name');

        if (fotoInput) {
            fotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validasi tipe file
                    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Format file tidak didukung! Harap unggah file PNG, JPG, atau JPEG.');
                        this.value = '';
                        return;
                    }

                    // Validasi ukuran sisi klien (maksimal 2MB = 2 * 1024 * 1024 bytes)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file maksimal 2 MB!');
                        this.value = '';
                        return;
                    }

                    fileName.textContent = file.name;
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        previewImage.classList.remove('hidden');
                        if (previewPlaceholder) {
                            previewPlaceholder.classList.add('hidden');
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</body>
</html>

