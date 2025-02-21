<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registerPage(Request $request) {
        return view('register');
    }

    public function loginPage() {
        return view('login');
    }

    public function register(Request $request) {
        $credentials = $request->validate([
            'full_name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'email:dns'], //masih bisa selain @gmail.com
            'password' => ['required', 'string', 'min:6', 'max:12'],
            'number' => ['required', 'regex:/^08[0-9]{8,13}$/'],
        ], [
            'full_name.required' => 'Nama Lengkap wajib diisi.',
            'full_name.min' => 'Nama Lengkap minimal 3 karakter.',
            'full_name.max' => 'Nama Lengkap maksimal 40 karakter.',
    
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus menggunakan format yang benar (@gmail.com).',
            'email.dns' => 'Email harus menggunakan format yang benar (@gmail.com).',
    
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.max' => 'Password maksimal 12 karakter.',
    
            'number.required' => 'Nomor Handphone wajib diisi.',
            'number.regex' => 'Nomor Handphone harus diawali dengan 08 dan memiliki panjang yang valid.',
        ]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'number' => $request->number,
            'role' => 'user',
        ]);

        if(Auth::attempt($credentials)) {
            $request -> session() -> regenerate();
            return redirect('/');
        }

        return back()->withErrors($credentials)->withInput();
    }

    public function loginValidation(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ], [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
    ]);

    //cari apakah email ada
    $user = User::where('email', $request->email)->first();

    //bila tidak
    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak ditemukan.'])->withInput();
    }

    //bila ada email tapi password salah
    if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return back()->withErrors(['password' => 'Password salah.'])->withInput();
    }

    $request->session()->regenerate();
    return redirect('/main');
}

    public function logout(Request $request) { //1
        Auth::logout();
        $request->session()->invalidate(); //buat matiin session
        $request->session()->regenerateToken(); //redirect token buat login
        return redirect ('/'); //return ke main?
    }
}
