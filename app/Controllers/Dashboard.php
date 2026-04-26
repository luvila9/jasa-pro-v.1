<?php
namespace App\Controllers;

use App\Models\ServiceModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $role = session()->get('role');
        $userId = session()->get('id');
        $serviceModel = new \App\Models\ServiceModel();
        $db = \Config\Database::connect();

        if ($role === 'freelancer') {
            $data['my_services'] = $serviceModel->where('user_id', $userId)->findAll();
            
            $builder = $db->table('orders');
            // PERUBAHAN DI SINI: Menambahkan created_at, status, dan price
            $builder->select('orders.id as order_id, orders.created_at, orders.status, users.fullname as partner_name, services.title as service_title, services.price');
            $builder->join('users', 'users.id = orders.client_id');
            $builder->join('services', 'services.id = orders.service_id');
            $builder->where('orders.freelancer_id', $userId);
            $builder->orderBy('orders.created_at', 'DESC');
            $data['chats'] = $builder->get()->getResultArray();

            return view('dashboard/freelancer', $data);
            
        } else {
            $data['all_services'] = $serviceModel->where('status', 'active')->findAll();
            
            $builder = $db->table('orders');
            // PERUBAHAN DI SINI: Menambahkan created_at, status, dan price
            $builder->select('orders.id as order_id, orders.created_at, orders.status, users.fullname as partner_name, services.title as service_title, services.price');
            $builder->join('users', 'users.id = orders.freelancer_id');
            $builder->join('services', 'services.id = orders.service_id');
            $builder->where('orders.client_id', $userId);
            $builder->orderBy('orders.created_at', 'DESC');
            $data['chats'] = $builder->get()->getResultArray();

            return view('dashboard/klien', $data);
        }
    }
    // Fungsi untuk menampilkan Panel Member
    public function panel()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('id');
        $role = session()->get('role');
        $db = \Config\Database::connect();

        // 1. Ambil Data User untuk Form Profil
        $data['user'] = $db->table('users')->where('id', $userId)->get()->getRowArray();

        // Filter berdasarkan apakah user ini Klien atau Freelancer
        $myCol = ($role === 'freelancer') ? 'freelancer_id' : 'client_id';
        $partnerCol = ($role === 'freelancer') ? 'client_id' : 'freelancer_id';

        // 2. Ambil Statistik Kartu Angka
        $data['total_transaksi'] = $db->table('orders')->where($myCol, $userId)->countAllResults();
        
        $sumQuery = $db->table('orders')
            ->selectSum('services.price', 'total_price')
            ->join('services', 'services.id = orders.service_id')
            ->where('orders.'.$myCol, $userId)
            ->get()->getRowArray();
        $data['total_amount'] = $sumQuery['total_price'] ?? 0;

        $data['count_pending'] = $db->table('orders')->where($myCol, $userId)->where('status', 'pending')->countAllResults();
        $data['count_process'] = $db->table('orders')->where($myCol, $userId)->where('status', 'in_progress')->countAllResults();
        $data['count_success'] = $db->table('orders')->where($myCol, $userId)->where('status', 'completed')->countAllResults();
        $data['count_failed']  = $db->table('orders')->where($myCol, $userId)->where('status', 'canceled')->countAllResults();

        // 3. Ambil 5 Riwayat Transaksi Terbaru
        $builder = $db->table('orders');
        $builder->select('orders.id as order_id, orders.created_at, orders.status, users.fullname as partner_name, services.title as service_title, services.price');
        $builder->join('users', 'users.id = orders.'.$partnerCol);
        $builder->join('services', 'services.id = orders.service_id');
        $builder->where('orders.'.$myCol, $userId);
        $builder->orderBy('orders.created_at', 'DESC');
        $builder->limit(5); 
        $data['recent_orders'] = $builder->get()->getResultArray();

        return view('dashboard/panel', $data);
    }
}