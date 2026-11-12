<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        // Jika pengguna sudah login, alihkan langsung ke pratinjau CV
        if (Auth::check()) {
            return redirect()->route('cv.preview');
        }

        return view('auth.login');
    }

    /**
     * Menangani proses otentikasi login.
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email yang dimasukkan tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Cek rate limiting (pencegahan brute-force)
        $this->ensureIsNotRateLimited($request);

        $remember = $request->boolean('remember');

        // Percobaan login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            RateLimiter::clear($this->throttleKey($request));

            $userName = Auth::user()->name ?? 'Pengguna';

            return redirect()->intended(route('cv.preview'))
                ->with('success', "Selamat datang kembali, {$userName}!");
        }

        // Catat kegagalan untuk rate limiting
        RateLimiter::hit($this->throttleKey($request), 60);

        throw ValidationException::withMessages([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
        ]);
    }

    /**
     * Menangani proses keluar (logout).
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Anda telah berhasil keluar dari sistem.');
    }

    /**
     * Mendapatkan identifier throttle untuk request saat ini.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
    }

    /**
     * Memastikan request tidak melampaui batas percobaan login (maksimal 5 kali percobaan).
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        $key = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik.",
            ]);
        }
    }
}

