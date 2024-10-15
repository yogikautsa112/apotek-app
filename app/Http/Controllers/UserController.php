<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan semua user yang ada.
     */
    public function index(Request $request)
    {
        $users = User::where('name', 'LIKE', '%' . $request->search . "%")->orderBy("name", 'ASC')->simplePaginate(2); // Ambil semua data user dari database
        return view('pages.admin.index', compact('users')); // Kirim data user ke view
    }

    /**
     * Menampilkan halaman home.
     */
    public function home()
    {
        return view(view: 'home'); // Tampilkan halaman home
    }

    /**
     * Menampilkan halaman login.
     */
    public function loginPage()
    {
        // Tampilkan halaman login
        return view('login');
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
            'password' => Hash::make($request->password), // Password disimpan langsung (bahaya, perlu dienkripsi)
            'role' => $request->role,
            'email_verified_at' => now(),
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
            $dataUpdate['password'] = Hash::make($request->password);
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
