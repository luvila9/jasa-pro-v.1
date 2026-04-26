<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Super Panel - JasaPro</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen">

    <nav class="bg-gray-900 border-b border-gray-800 px-6 py-4 sticky top-0 z-50 shadow-md">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-red-600 rounded flex items-center justify-center font-bold text-white">JP</div>
                <span class="text-xl font-bold text-white">JasaPro <span class="text-red-500">ADMIN</span></span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-300">Halo, <?= esc(session()->get('fullname')) ?></span>
                <a href="<?= base_url('logout') ?>" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition">Logout</a>
            </div>
        </div>
    </nav>

    <main class="p-6 md:p-10 max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Pusat Kendali Sistem (Rekber)</h1>
            <p class="text-gray-600">Pantau seluruh aktivitas pengguna dan arus keuangan yang tertahan di platform.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 border-l-blue-500">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Total Pengguna</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-gray-900"><?= $total_users ?></span>
                    <span class="text-xs text-gray-500">(<?= $total_klien ?> Klien, <?= $total_freelancer ?> Freelancer)</span>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 border-l-purple-500">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Total Transaksi</p>
                <span class="text-3xl font-black text-gray-900"><?= $total_orders ?></span>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 border-l-green-500">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Nilai Transaksi Sukses</p>
                <span class="text-2xl font-black text-green-600">Rp <?= number_format($total_revenue, 0, ',', '.') ?></span>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 border-l-yellow-500">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Dana Tertahan (Escrow)</p>
                <span class="text-2xl font-black text-yellow-600">Rp --</span>
                <p class="text-[10px] text-gray-400 mt-1">*Fitur mendatang</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="font-bold text-gray-800">Semua Transaksi Platform</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-100 text-xs text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            <th class="py-3 px-6">Order ID</th>
                            <th class="py-3 px-6">Klien Pembeli</th>
                            <th class="py-3 px-6">Freelancer</th>
                            <th class="py-3 px-6">Layanan & Harga</th>
                            <th class="py-3 px-6 text-center">Bukti Bayar</th>
                            <th class="py-3 px-6 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        <?php foreach($all_transactions as $t): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6 font-bold text-gray-900">#<?= str_pad($t['id'], 5, '0', STR_PAD_LEFT) ?></td>
                                <td class="py-4 px-6 text-blue-600 font-medium"><?= esc($t['klien_name']) ?></td>
                                <td class="py-4 px-6 text-purple-600 font-medium"><?= esc($t['freelancer_name']) ?></td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-gray-800"><?= esc($t['service_title']) ?></div>
                                    <div class="text-green-600 font-bold mt-1">Rp <?= number_format($t['price'], 0, ',', '.') ?></div>
                                </td>
                                
                                <td class="py-4 px-6 text-center">
                                    <?php if(!empty($t['payment_proof'])): ?>
                                        <button onclick="openModal('<?= base_url('uploads/payments/' . $t['payment_proof']) ?>')" class="inline-flex items-center justify-center gap-1 bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded text-[11px] font-bold transition cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Cek Bukti
                                        </button>
                                    <?php else: ?>
                                        <span class="text-gray-400 text-[11px] italic">Tidak ada</span>
                                    <?php endif; ?>
                                </td>

                                <td class="py-4 px-6 text-center">
                                    <?php
                                        if($t['status'] == 'completed') echo '<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-bold">SELESAI</span>';
                                        elseif($t['status'] == 'in_progress') echo '<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-[10px] font-bold">DIPROSES</span>';
                                        elseif($t['status'] == 'canceled') echo '<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-bold">BATAL</span>';
                                        else echo '<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-bold">PENDING</span>';
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="imageModal" class="fixed inset-0 z-[100] hidden bg-black/90 flex items-center justify-center backdrop-blur-sm transition-opacity duration-300 opacity-0" onclick="closeModal()">
        <span class="absolute top-5 right-5 text-gray-400 hover:text-white text-4xl cursor-pointer transition">&times;</span>
        <img id="modalImage" src="" class="max-w-[90%] max-h-[90vh] object-contain rounded-xl shadow-2xl scale-95 transition-transform duration-300 border border-gray-800">
    </div>

    <script>
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        
        function openModal(src) {
            modal.classList.remove('hidden');
            setTimeout(() => { 
                modal.classList.remove('opacity-0'); 
                modalImg.src = src; 
                modalImg.classList.remove('scale-95'); 
                modalImg.classList.add('scale-100'); 
            }, 10);
        }
        
        function closeModal() {
            modal.classList.add('opacity-0'); 
            modalImg.classList.remove('scale-100'); 
            modalImg.classList.add('scale-95');
            setTimeout(() => { 
                modal.classList.add('hidden'); 
                modalImg.src = ''; 
            }, 300);
        }
    </script>
</body>
</html>