<?php
namespace App\Controllers;

// PASTIKAN KEEMPAT BARIS INI ADA DI ATAS:
use App\Models\OrderModel;
use App\Models\ServiceModel;
use App\Models\MessageModel; 
use App\Models\UserModel;

class Order extends BaseController
{
    public function create()
    {
        if (session()->get('role') !== 'klien') {
            return redirect()->back()->with('error', 'Hanya klien yang dapat memesan jasa.');
        }

        $serviceId = $this->request->getPost('service_id');
        $clientId = session()->get('id');

        $serviceModel = new \App\Models\ServiceModel();
        $service = $serviceModel->find($serviceId);

        if (!$service) {
            return redirect()->back()->with('error', 'Jasa tidak ditemukan.');
        }

        $orderModel = new \App\Models\OrderModel();

        // Cek order aktif
        $existingOrder = $orderModel->where('client_id', $clientId)
                                    ->where('service_id', $serviceId)
                                    ->whereIn('status', ['pending', 'in_progress'])
                                    ->first();

        if ($existingOrder) {
            return redirect()->to('/chat/' . $existingOrder['id']);
        }

        // ==========================================
        // LOGIKA BARU: UPLOAD BUKTI PEMBAYARAN
        // ==========================================
        $fileProof = $this->request->getFile('payment_proof');
        $fileName = null;

        // PERBAIKAN DI SINI: Menggunakan hasMoved()
        if ($fileProof && $fileProof->isValid() && !$fileProof->hasMoved()) {
            // Generate nama file acak agar tidak bentrok
            $fileName = $fileProof->getRandomName();
            // Pindahkan file ke folder public/uploads/payments
            $fileProof->move('uploads/payments', $fileName);
        }

        // Buat Order Baru
        $orderModel->insert([
            'client_id'     => $clientId,
            'freelancer_id' => $service['user_id'],
            'service_id'    => $serviceId,
            'status'        => 'pending', 
            'payment_proof' => $fileName // Simpan nama file ke database
        ]);

        $newOrderId = $orderModel->getInsertID();

        return redirect()->to('/chat/' . $newOrderId);
    }

    // 2. Menampilkan Tampilan Chat Room 
    public function chatRoom($orderId)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        $userId = session()->get('id');

        // Proteksi
        if (!$order || ($order['client_id'] != $userId && $order['freelancer_id'] != $userId)) {
            return redirect()->to('/dashboard')->with('error', 'Akses ke ruang obrolan ditolak.');
        }

        $userModel = new UserModel();
        $serviceModel = new ServiceModel();
        $messageModel = new MessageModel(); // Menggunakan MessageModel
        
        $partnerId = ($order['client_id'] == $userId) ? $order['freelancer_id'] : $order['client_id'];
        
        $data = [
            'order'        => $order,
            'partner'      => $userModel->find($partnerId),
            'me'           => $userId,
            'service'      => $serviceModel->find($order['service_id']),
            'messageCount' => $messageModel->where('order_id', $orderId)->countAllResults() 
        ];

        return view('chat/room', $data);
    }

    // 3. Memproses pengiriman pesan (AJAX)
    public function sendMessage($orderId)
    {
        $messageModel = new MessageModel();
        $messageModel->insert([
            'order_id'  => $orderId,
            'sender_id' => session()->get('id'),
            'message'   => $this->request->getPost('message')
        ]);
        
        return $this->response->setJSON(['status' => 'success']);
    }

    // 4. Mengambil data pesan terbaru (AJAX Polling)
    public function loadMessages($orderId)
    {
        $messageModel = new MessageModel();
        $messages = $messageModel->where('order_id', $orderId)->orderBy('created_at', 'ASC')->findAll();
        
        return $this->response->setJSON($messages);
    }

   // 5. Update Status Pesanan (Hanya untuk Freelancer)
    public function updateStatus($orderId)
    {
        // Pastikan hanya freelancer yang bisa mengubah status
        if (session()->get('role') !== 'freelancer') {
            return redirect()->back();
        }

        $orderModel = new OrderModel();
        $orderModel->update($orderId, [
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->back();
    }
}