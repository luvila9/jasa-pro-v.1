<?php
namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        // Pastikan yang mengakses halaman ini hanya Admin!
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak. Anda bukan Admin.');
        }

        $db = \Config\Database::connect();

        // Ambil Statistik Global
        $data['total_users'] = $db->table('users')->countAllResults();
        $data['total_freelancer'] = $db->table('users')->where('role', 'freelancer')->countAllResults();
        $data['total_klien'] = $db->table('users')->where('role', 'klien')->countAllResults();
        
        $data['total_orders'] = $db->table('orders')->countAllResults();
        $data['total_revenue'] = $db->table('orders')
            ->selectSum('services.price', 'total')
            ->join('services', 'services.id = orders.service_id')
            ->where('orders.status', 'completed')
            ->get()->getRowArray()['total'] ?? 0;

        // ========================================================
        // Ambil Semua Transaksi (TERMASUK KOLOM payment_proof)
        // ========================================================
        $builder = $db->table('orders');
        $builder->select('orders.id, orders.created_at, orders.status, orders.payment_proof, 
                          k.fullname as klien_name, f.fullname as freelancer_name, 
                          services.title as service_title, services.price');
        $builder->join('users as k', 'k.id = orders.client_id');
        $builder->join('users as f', 'f.id = orders.freelancer_id');
        $builder->join('services', 'services.id = orders.service_id');
        $builder->orderBy('orders.created_at', 'DESC');
        $data['all_transactions'] = $builder->get()->getResultArray();

        return view('admin/dashboard', $data);
    }
}