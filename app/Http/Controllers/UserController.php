<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan semua user yang ada.
     */
    public function index()
    {
        $users = User::all(); // Ambil semua data user dari database
        return view('pages.admin.index', compact('users')); // Kirim data user ke view
    }

    /**
     * Menampilkan halaman home.
     */
    public function home()
    {
        return view('home'); // Tampilkan halaman home
    }

    /**
     * Menampilkan halaman login.
     */
    public function loginPage()
    {
        return view('pages.login'); // Tampilkan halaman login
    }

    /**
     * Proses login user.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'], // Validasi email
            'password' => ['required'], // Validasi password
        ]);

        if (Auth::attempt($credentials)) { // Cek apakah email & password cocok
            $request->session()->regenerate(); // Regenerasi session biar lebih aman
            return redirect()->intended('home')->with('success', 'Login berhasil!'); // Redirect ke home kalau login sukses
        }

        // Balikin pesan error kalau login gagal
        return back()->withErrors([
            'email' => 'Salah bang email atau password nya!',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan halaman registrasi.
     */
    public function regisPage()
    {
        return view('pages.register'); // Tampilkan halaman register
    }

    /**
     * Proses registrasi user baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'], // Validasi nama
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Validasi email
            'password' => ['required', 'min:8'], // Validasi password
        ]);

        // Simpan user baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
            'role' => 'kasir', // Role default 'kasir'
        ]);

        if ($user) {
            Auth::login($user); // Auto login setelah registrasi berhasil
            return redirect()->route('login')->with('success', 'Registration successful!');
        } else {
            return back()->with('error', 'Registration failed. Please try again.');
        }
    }

    /**
     * Menampilkan form untuk tambah user baru.
     */
    public function create()
    {
        return view('pages.admin.add'); // Tampilkan form tambah user
    }

    /**
     * Proses simpan user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', // Nama harus diisi
            'email' => 'required', // Email harus diisi
            'password' => 'required|min:8', // Password minimal 8 karakter
            'role' => 'required', // Role harus diisi
        ], [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role harus diisi',
        ]);

        // Simpan user ke database
        $proses = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Password disimpan langsung (bahaya, perlu dienkripsi)
            'role' => $request->role,
        ]);

        if ($proses) {
            return redirect()->route('menage')->with('success', 'Data kasir berhasil disimpan!');
        } else {
            return redirect()->back()->with('failed', 'Data kasir gagal disimpan!');
        }
    }

    /**
     * Menampilkan form edit user.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id); // Ambil data user berdasarkan ID
        return view('pages.admin.edit', compact('user')); // Kirim data user ke form edit
    }

    /**
     * Proses update data user.
     */
    public function update(Request $request, string $id)
    {

        // Ambil user dari database
        $user = User::find($id);

        $request->validate([
            'name' => 'nullable', // Nama opsional
            'email' => 'nullable', // Email opsional
            'password' => 'nullable|min:8', // Password opsional, tapi minimal 8 karakter
            'role' => 'nullable|string', // Role opsional
        ], [
            'password.min' => 'Password minimal 8 karakter',
        ]);

        // Update data user
        $dataUpdate = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika password diisi, maka lakukan enkripsi dan tambahkan ke array update
        if ($request->filled('password')) {
            $dataUpdate['password'] = bcrypt($request->password);
        }

        // Proses update data
        $proses = $user->update($dataUpdate);

        if ($proses) {
            return redirect()->route('menage')->with('success', 'Data kasir berhasil diubah!');
        } else {
            return redirect()->back()->with('failed', 'Data kasir gagal diubah!');
        }
    }


    /**
     * Proses hapus user dari database.
     */
    public function destroy($id)
    {
        $proses = User::where('id', $id)->delete(); // Hapus user berdasarkan ID
        if ($proses) {
            return redirect()->route('menage')->with('success', 'Data kasir berhasil dihapus!');
        } else {
            return redirect()->route('menage')->with('failed', 'Data kasir gagal dihapus!');
        }
    }
}
