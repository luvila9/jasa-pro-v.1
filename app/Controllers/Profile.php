<?php
namespace App\Controllers;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $data['user'] = $userModel->find(session()->get('id'));

        return view('profile/edit', $data);
    }

    public function update()
    {
        $userModel = new UserModel();
        $userId = session()->get('id');

        $userModel->update($userId, [
            // Pastikan kolom ini sudah ada di tabel users database Anda
            'whatsapp'  => $this->request->getPost('whatsapp'),
            'instagram' => $this->request->getPost('instagram'),
            'portfolio' => $this->request->getPost('portfolio'),
        ]);

        return redirect()->to('/dashboard')->with('success', 'Profil sosial media berhasil diperbarui!');
    }
}