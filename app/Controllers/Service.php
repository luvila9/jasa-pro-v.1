<?php

namespace App\Controllers;

use App\Models\ServiceModel;

class Service extends BaseController
{
    // 1. Menampilkan Form Tambah Jasa
    public function create()
    {
        // Proteksi Lapis Ganda: Hanya Freelancer yang boleh masuk halaman ini
        if (session()->get('role') !== 'freelancer') {
            return redirect()->to('/dashboard')->with('error', 'Hanya Freelancer yang dapat membuat jasa.');
        }

        return view('services/create');
    }

    // 2. Memproses Data dari Form
    public function store()
    {
        // 1. Tambahkan validasi file (Perhatikan 'images' bukan 'image' karena kita menangkap banyak file)
        $rules = [
            'title'       => 'required|min_length[5]',
            'category'    => 'required',
            'price'       => 'required|numeric',
            'delivery_time' => 'required|numeric|greater_than[0]',
            'revisions'     => 'required|numeric|greater_than_equal_to[0]',
            'description' => 'required|min_length[20]',
            'images'      => 'uploaded[images]|max_size[images,2048]|is_image[images]|mime_in[images,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Tangkap BANYAK file gambar
        $files = $this->request->getFileMultiple('images');
        $imageNames = [];

        // 3. Lakukan perulangan untuk menyimpan setiap file yang valid
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName(); // Beri nama acak
                    $file->move(FCPATH . 'uploads/services', $newName); // Pindahkan ke folder public
                    $imageNames[] = $newName; // Masukkan nama file ke keranjang
                }
            }
        }

        // Gabungkan nama-nama file menjadi satu teks dengan pemisah koma
        $imageString = implode(',', $imageNames);

        // 4. Simpan ke database
        $serviceModel = new ServiceModel();
        $serviceModel->save([
            'user_id'     => session()->get('id'),
            'title'       => $this->request->getPost('title'),
            'category'    => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'delivery_time' => $this->request->getPost('delivery_time'),
            'revisions'     => $this->request->getPost('revisions'),
            'image'       => $imageString, // Simpan string gambar gabungan
            'status'      => 'active'
        ]);

        return redirect()->to('/dashboard')->with('success', 'Jasa berhasil dipublikasikan dengan galeri foto!');
    }

    // 3. Menampilkan Form Edit Jasa
    public function edit($id)
    {
        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($id);

        // Proteksi: Pastikan jasa ditemukan dan milik freelancer yang sedang login
        if (!$service || $service['user_id'] !== session()->get('id')) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak atau data tidak ditemukan.');
        }

        $data['service'] = $service;
        return view('services/edit', $data);
    }

    // 4. Memproses Update Data ke Database
    public function update($id)
    {
        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($id);

        // Validasi teks (gambar diabaikan dulu karena opsional saat edit)
        $rules = [
            'title'       => 'required|min_length[5]|max_length[100]',
            'category'    => 'required',
            'delivery_time' => 'required|numeric|greater_than[0]',
            'revisions'     => 'required|numeric|greater_than_equal_to[0]',
            'description' => 'required|min_length[20]',
            'price'       => 'required|numeric|greater_than[0]',
            'status'      => 'required|in_list[active,inactive]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Cek apakah ada file gambar baru yang diunggah
        $files = $this->request->getFileMultiple('images');
        $imageNames = [];

        // Memastikan user benar-benar memilih file (file pertama valid dan tidak error)
        if ($files && $files[0]->isValid()) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/services', $newName);
                    $imageNames[] = $newName;
                }
            }
            $imageString = implode(',', $imageNames);
        } else {
            // Jika tidak ada gambar baru yang dipilih, gunakan data gambar yang lama
            $imageString = $service['image'];
        }

        // Simpan pembaruan ke database
        $serviceModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'delivery_time' => $this->request->getPost('delivery_time'),
            'revisions'     => $this->request->getPost('revisions'),
            'category'    => $this->request->getPost('category'),
            'price'       => $this->request->getPost('price'),
            'status'      => $this->request->getPost('status'),
            'image'       => $imageString
        ]);

        return redirect()->to('/dashboard')->with('success', 'Perubahan jasa berhasil disimpan!');
    }
    // 5. Menampilkan Halaman Detail Jasa
    public function detail($id)
    {
        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($id);

        // Jika jasa tidak ditemukan, kembalikan ke dashboard
        if (!$service) {
            return redirect()->to('/dashboard')->with('error', 'Jasa tidak ditemukan.');
        }

        // Ambil data freelancer pemilik jasa ini
        $userModel = new \App\Models\UserModel();
        $freelancer = $userModel->find($service['user_id']);

        $data = [
            'service'    => $service,
            'freelancer' => $freelancer
        ];

        return view('services/detail', $data);
    }
}