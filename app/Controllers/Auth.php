<?php

namespace App\Controllers;

use App\Models\UserModel; // Memanggil Model yang sudah kita buat
use CodeIgniter\Controller;

class Auth extends BaseController
{
    // Fungsi untuk menampilkan halaman form registrasi
    public function register()
    {
        return view('auth/register');
    }

    // Fungsi untuk memproses data dari form saat tombol "Daftar" diklik
    public function processRegister()
    {
        // 1. Aturan Validasi (Mitigasi Risiko Data Sampah / Tidak Valid)
        $rules = [
            'fullname' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama lengkap minimal 3 karakter.'
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique'   => 'Email ini sudah terdaftar. Gunakan email lain.'
                ]
            ],
            'password' => [
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required'   => 'Password wajib diisi.',
                    'min_length' => 'Password minimal harus 8 karakter untuk keamanan.'
                ]
            ],
            'role' => [
                'rules'  => 'required|in_list[klien,freelancer]',
                'errors' => [
                    'required' => 'Peran (Role) wajib dipilih.',
                    'in_list'  => 'Peran yang dipilih tidak valid.'
                ]
            ]
        ];

        // 2. Jalankan Validasi
        if (!$this->validate($rules)) {
            // Jika gagal, kembalikan user ke form beserta data lama dan pesan error-nya
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Jika Validasi Lolos, Siapkan Model
        $userModel = new UserModel();

        // 4. Simpan ke Database
        // Menggunakan password_hash() adalah standar wajib keamanan PHP modern
        $userModel->save([
            'fullname'      => $this->request->getPost('fullname'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'          => $this->request->getPost('role'),
            'status'        => 'active' // Kita set 'active' dulu agar nanti mudah saat testing Login
        ]);

        // 5. Arahkan ke halaman login (yang akan kita buat nanti) dengan pesan sukses
        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Fungsi untuk menampilkan halaman form login
    public function login()
    {
        return view('auth/login');
    }

    // Fungsi untuk memproses pengecekan email dan password
    public function processLogin()
    {
        $userModel = new \App\Models\UserModel();
        
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan email
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Jika email ditemukan, cocokkan password-nya
            if (password_verify($password, $user['password_hash'])) {
                
                // Jika password benar, buat sesi (Session) agar user tetap login
                $sessionData = [
                    'id'        => $user['id'],
                    'fullname'  => $user['fullname'],
                    'role'      => $user['role'],
                    'logged_in' => true
                ];
                session()->set($sessionData);

                // =========================================================
                // LOGIKA BARU: Arahkan ke halaman berdasarkan Role (Peran)
                // =========================================================
                if ($user['role'] === 'admin') {
                    // Jika Admin, masuk ke Pusat Kendali (God View)
                    return redirect()->to('/admin')->with('success', 'Selamat datang, Admin!');
                } elseif ($user['role'] === 'freelancer') {
                    // Jika Freelancer, masuk ke Dashboard Ruang Kerja
                    return redirect()->to('/dashboard')->with('success', 'Selamat datang kembali!');
                } else {
                    // Jika Klien, masuk ke Katalog
                    return redirect()->to('/dashboard')->with('success', 'Selamat datang!');
                }
                
            } else {
                // Jika password salah
                return redirect()->back()->with('error', 'Password yang Anda masukkan salah.');
            }
        } else {
            // Jika email tidak terdaftar
            return redirect()->back()->with('error', 'Email tidak ditemukan. Silakan daftar terlebih dahulu.');
        }
    }

    // Fungsi untuk keluar (logout)
    public function logout()
    {
        // Hancurkan semua data sesi pengguna
        session()->destroy();
        
        // Arahkan kembali ke halaman login
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout.');
    }

    public function editProfile() {
        $userModel = new \App\Models\UserModel();
        $data['user'] = $userModel->find(session()->get('id'));
        return view('auth/edit_profile', $data);
    }

    public function updateProfile() {
        $userModel = new \App\Models\UserModel();
        
        $userModel->update(session()->get('id'), [
            'whatsapp'      => $this->request->getPost('whatsapp'),
            'instagram'     => $this->request->getPost('instagram'),
            // Kita gunakan null coalescing (??) untuk mencocokkan input form 'portfolio' pada panel
            'portfolio_url' => $this->request->getPost('portfolio') ?? $this->request->getPost('portfolio_url'),
        ]);
        
        // =========================================================
        // LOGIKA BARU: Redirect ke /panel agar tetap di halaman profil
        // =========================================================
        return redirect()->to('/panel')->with('success', 'Profil berhasil diperbarui!');
    }
}