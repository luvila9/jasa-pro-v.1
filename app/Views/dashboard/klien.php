<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Klien - JasaPro</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Custom Dark Theme Colors */
        body { background-color: #0b1121; color: #ffffff; }
        .bg-card { background-color: #171f30; }
        .bg-input { background-color: #232b3d; }
        
        /* Modifikasi SweetAlert agar cocok dengan Dark Mode */
        .swal2-popup { border: 1px solid #1f2937 !important; border-radius: 1rem !important; }
        .payment-method { border: 1px solid #374151; transition: all 0.2s; }
        .payment-method:hover { border-color: #3b82f6; background-color: #1e293b; }
        .payment-method input[type="radio"] { accent-color: #3b82f6; }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col">

    <nav class="border-b border-gray-800 bg-[#0b1121] px-4 py-3 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-4 w-1/4">
                <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center font-bold text-white">JP</div>
                    <span class="text-xl font-bold hidden sm:block">JasaPro</span>
                </a>
            </div>

            <div class="flex-1 max-w-2xl hidden md:block">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" class="block w-full p-2.5 pl-10 text-sm text-white bg-input border border-gray-700 rounded-full focus:ring-blue-500 focus:border-blue-500" placeholder="Cari Jasa atau Freelancer">
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 w-1/4">
                <div class="hidden sm:flex items-center gap-2 bg-input px-3 py-1.5 rounded-full border border-gray-700 text-sm font-medium">
                    <span class="text-red-500">🇮🇩</span> ID / IDR
                </div>
                
                <div class="relative z-50">
                    <button id="profileDropdownBtn" class="flex items-center gap-2 focus:outline-none">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-gray-700 to-gray-900 flex items-center justify-center text-white font-bold shadow-sm border-2 border-transparent hover:border-gray-400 transition">
                            <?= strtoupper(substr(session()->get('fullname'), 0, 1)) ?>
                        </div>
                    </button>

                    <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-64 bg-[#1e2330] border border-gray-700 rounded-xl shadow-2xl text-gray-300 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-700 bg-[#191d28]">
                            <p class="text-xs text-gray-400 mb-0.5">Telah masuk sebagai</p>
                            <p class="text-sm font-bold text-white truncate"><?= esc(session()->get('fullname')) ?></p>
                        </div>
                        <div class="py-2">
                            <a href="<?= base_url('panel') ?>" class="flex items-center gap-3 px-5 py-2.5 text-sm hover:bg-gray-800 transition">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                Dashboard
                            </a>
                            <a href="<?= base_url('profile') ?>" class="flex items-center gap-3 px-5 py-2.5 text-sm hover:bg-gray-800 transition">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Pengaturan
                            </a>
                            <div class="my-1 border-t border-gray-700"></div>
                            <a href="<?= base_url('logout') ?>" class="flex items-center gap-3 px-5 py-2.5 text-sm hover:bg-gray-800 transition text-gray-400 hover:text-white">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="border-b border-gray-800 bg-[#0b1121]">
        <div class="max-w-7xl mx-auto px-4 flex items-center gap-6 overflow-x-auto">
            <button onclick="switchTab('katalog')" id="nav-katalog" class="py-4 text-sm font-medium text-blue-500 border-b-2 border-blue-500 whitespace-nowrap flex items-center gap-2 focus:outline-none transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Katalog Jasa
            </button>
            <button onclick="switchTab('transaksi')" id="nav-transaksi" class="py-4 text-sm font-medium text-gray-400 hover:text-white whitespace-nowrap flex items-center gap-2 focus:outline-none transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Cek Transaksi
            </button>
            <button onclick="switchTab('chat')" id="nav-chat" class="py-4 text-sm font-medium text-gray-400 hover:text-white whitespace-nowrap flex items-center gap-2 focus:outline-none transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Riwayat Chat
                <?php if(count($chats) > 0): ?>
                    <span class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full ml-1 leading-none"><?= count($chats) ?></span>
                <?php endif; ?>
            </button>
        </div>
    </div>

    <main class="flex-1 px-4 py-8 max-w-7xl mx-auto w-full">

        <div id="tab-katalog" class="block w-full">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white mb-2">Eksplorasi Jasa Digital</h1>
                <p class="text-gray-400 text-sm">Temukan freelancer profesional untuk membantu proyek Anda.</p>
            </div>

            <?php if(empty($all_services)): ?>
                <div class="bg-card rounded-2xl border border-gray-800 p-10 text-center">
                    <h3 class="text-lg font-semibold text-white mb-2">Belum Ada Jasa Tersedia</h3>
                    <p class="text-gray-400">Saat ini para freelancer kami sedang menyiapkan portofolio mereka.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach($all_services as $service): ?>
                        <div class="bg-card rounded-2xl shadow-lg border border-gray-800 overflow-hidden hover:border-gray-600 transition duration-300 flex flex-col group relative">
                            
                            <?php $images = !empty($service['image']) ? explode(',', $service['image']) : []; ?>
                            <?php if(count($images) > 0 && !empty($images[0])): ?>
                                <a href="<?= base_url('service/' . $service['id']) ?>" class="block relative w-full h-48 bg-[#0b1121] border-b border-gray-800 overflow-hidden carousel-container group cursor-pointer">
                                    <?php foreach($images as $index => $img): ?>
                                        <img src="<?= base_url('uploads/services/' . esc(trim($img))) ?>" alt="<?= esc($service['title']) ?>" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out carousel-image <?= $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' ?>">
                                    <?php endforeach; ?>
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                        <span class="px-4 py-2 bg-blue-600 text-white font-bold text-sm rounded-lg shadow-sm">Lihat Detail</span>
                                    </div>
                                    <?php if(count($images) > 1): ?>
                                        <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs font-bold px-2 py-1 rounded-md z-20 carousel-badge">1/<?= count($images) ?> Foto</div>
                                    <?php endif; ?>
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('service/' . $service['id']) ?>" class="block w-full h-48 bg-[#0b1121] flex items-center justify-center border-b border-gray-800 hover:bg-gray-900 transition">
                                    <span class="text-sm font-medium text-gray-500">Lihat Detail</span>
                                </a>
                            <?php endif; ?>

                            <div class="p-5 flex-1 flex flex-col">
                                <div class="mb-3">
                                    <span class="inline-block px-2.5 py-1 bg-input text-gray-300 text-[10px] font-bold uppercase tracking-wider rounded border border-gray-700">
                                        <?= esc($service['category'] ?? 'Umum') ?>
                                    </span>
                                </div>
                                <a href="<?= base_url('service/' . $service['id']) ?>" class="block hover:text-blue-400 transition">
                                    <h3 class="text-base font-bold text-white line-clamp-2 mb-2" title="<?= esc($service['title']) ?>"><?= esc($service['title']) ?></h3>
                                </a>
                                <p class="text-gray-400 text-xs line-clamp-2 mb-4 flex-1"><?= esc($service['description']) ?></p>
                                
                                <div class="text-xl font-black text-blue-500 mb-3">Rp <?= number_format($service['price'], 0, ',', '.') ?></div>
                                
                                <div class="flex items-center gap-4 text-xs font-medium text-gray-400 mb-5 pb-4 border-b border-gray-800">
                                    <div class="flex items-center gap-1.5" title="Estimasi Pengerjaan">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <?= esc($service['delivery_time'] ?? '1') ?> Hari
                                    </div>
                                    <div class="flex items-center gap-1.5" title="Batas Revisi">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                        <?php 
                                            $rev = $service['revisions'] ?? 0;
                                            echo ($rev == -1) ? 'Unlimited' : (($rev == 0) ? 'Tanpa' : $rev) . ' Rev';
                                        ?>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <form action="<?= base_url('order/create') ?>" method="POST" id="formOrder_<?= $service['id'] ?>" class="w-full" enctype="multipart/form-data">
                                        <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                                        <input type="file" name="payment_proof" id="fileProof_<?= $service['id'] ?>" class="hidden" accept="image/*" onchange="updateFileName(<?= $service['id'] ?>)">
                                        
                                        <button type="button" onclick="showOrderOptions(<?= $service['id'] ?>, <?= $service['price'] ?>)" class="w-full px-3 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-900 transition flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                            Pesan Jasa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div id="tab-transaksi" class="hidden w-full flex flex-col items-center justify-start py-10">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-3">Cek Invoice Kamu dengan Mudah dan Cepat</h1>
                <p class="text-sm text-gray-400">Lihat detail pesanan jasa kamu menggunakan nomor Order ID.</p>
            </div>
            <div class="bg-card w-full max-w-2xl rounded-2xl shadow-2xl border border-gray-800 p-6 sm:p-8 mb-16">
                <form action="<?= base_url('chat') ?>" method="GET" id="invoiceForm">
                    <label for="invoice_id" class="block text-sm font-bold text-white mb-3">Cari detail pesanan kamu disini</label>
                    <div class="relative mb-6">
                        <input type="text" id="invoice_id" name="order_id" required
                            class="block w-full p-4 text-sm text-white bg-input border border-gray-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500" 
                            placeholder="Masukkan nomor Order ID (Contoh: 1, 2, 3...)">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-bold rounded-xl text-sm px-5 py-4 flex justify-center items-center gap-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari Invoice
                    </button>
                </form>
            </div>

            <div class="w-full max-w-5xl">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Transaksi Real-Time</h2>
                    <p class="text-sm text-gray-400">Berikut ini Real-Time data pesanan masuk terbaru JasaPro.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-800 text-xs text-gray-400 font-bold uppercase tracking-wider">
                                <th class="py-4 px-4 whitespace-nowrap">Tanggal</th>
                                <th class="py-4 px-4 whitespace-nowrap">Nomor Invoice</th>
                                <th class="py-4 px-4 whitespace-nowrap">Detail Pesanan</th>
                                <th class="py-4 px-4 whitespace-nowrap">Harga</th>
                                <th class="py-4 px-4 whitespace-nowrap">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-300">
                            <?php if(empty($chats)): ?>
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500 italic">Belum ada transaksi.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($chats as $chat): ?>
                                    <tr class="border-b border-gray-800 hover:bg-[#171f30] transition duration-200">
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            <?= isset($chat['created_at']) ? date('d-m-Y H:i:s', strtotime($chat['created_at'])) : date('d-m-Y H:i:s') ?>
                                        </td>
                                        <td class="py-4 px-4 font-medium text-white whitespace-nowrap">
                                            JP-<?= str_pad($chat['order_id'], 6, '0', STR_PAD_LEFT) ?>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="truncate max-w-[200px] text-white font-medium" title="<?= esc($chat['service_title']) ?>">
                                                <?= esc($chat['service_title']) ?>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-0.5">Partner: <?= esc($chat['partner_name']) ?></div>
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            Rp <?= number_format($chat['price'] ?? 0, 0, ',', '.') ?>
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            <?php
                                                $status = $chat['status'] ?? 'pending';
                                                if($status == 'completed') {
                                                    echo '<span class="bg-[#0f2e1b] text-[#22c55e] px-3 py-1 rounded-full text-[10px] font-bold tracking-wider">SUCCESS</span>';
                                                } elseif($status == 'in_progress') {
                                                    echo '<span class="bg-[#122640] text-[#3b82f6] px-3 py-1 rounded-full text-[10px] font-bold tracking-wider">PROSES</span>';
                                                } elseif($status == 'canceled') {
                                                    echo '<span class="bg-[#3a1618] text-[#ef4444] px-3 py-1 rounded-full text-[10px] font-bold tracking-wider">GAGAL</span>';
                                                } else {
                                                    echo '<span class="bg-[#3f2c0d] text-[#eab308] px-3 py-1 rounded-full text-[10px] font-bold tracking-wider">PENDING</span>';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div id="tab-chat" class="hidden w-full max-w-4xl mx-auto">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-white mb-2">Riwayat Pesanan & Chat Anda</h2>
            </div>
            
            <?php if(empty($chats)): ?>
                <div class="bg-card rounded-2xl border border-gray-800 p-10 text-center">
                    <p class="text-gray-400">Belum ada riwayat pesanan atau obrolan.</p>
                </div>
            <?php else: ?>
                <div class="space-y-3">
                    <?php foreach($chats as $chat): ?>
                        <a href="<?= base_url('chat/' . $chat['order_id']) ?>" class="bg-card border border-gray-800 p-4 rounded-xl flex items-center hover:border-blue-500 transition group">
                            <div class="w-12 h-12 rounded-full bg-input text-gray-300 flex items-center justify-center font-bold text-lg mr-4 border border-gray-700 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-500 transition">
                                <?= strtoupper(substr($chat['partner_name'], 0, 1)) ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-1">
                                    <h4 class="text-sm font-bold text-white truncate"><?= esc($chat['partner_name']) ?></h4>
                                    <span class="text-[10px] text-gray-500 font-medium px-2 py-0.5 bg-input rounded border border-gray-700">Order #<?= $chat['order_id'] ?></span>
                                </div>
                                <p class="text-xs text-gray-400 truncate"><?= esc($chat['service_title']) ?></p>
                            </div>
                            <div class="ml-4 text-gray-600 group-hover:text-blue-500 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <script>
        // LOGIKA TABULASI
        function switchTab(tabId) {
            document.getElementById('tab-katalog').classList.add('hidden');
            document.getElementById('tab-transaksi').classList.add('hidden');
            document.getElementById('tab-chat').classList.add('hidden');

            const navs = ['nav-katalog', 'nav-transaksi', 'nav-chat'];
            navs.forEach(nav => {
                let el = document.getElementById(nav);
                el.classList.remove('text-blue-500', 'border-b-2', 'border-blue-500');
                el.classList.add('text-gray-400');
            });

            document.getElementById('tab-' + tabId).classList.remove('hidden');
            let activeNav = document.getElementById('nav-' + tabId);
            activeNav.classList.remove('text-gray-400');
            activeNav.classList.add('text-blue-500', 'border-b-2', 'border-blue-500');
        }
        
        switchTab('katalog');

        // Form Invoice
        document.getElementById('invoiceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const orderId = document.getElementById('invoice_id').value.trim();
            if(orderId) {
                const numericId = orderId.replace(/\D/g,''); 
                if(numericId) {
                    window.location.href = "<?= base_url('chat/') ?>" + numericId;
                } else {
                    alert('Silakan masukkan ID Order berupa angka.');
                }
            }
        });

        // Dropdown Profil
        const profileBtn = document.getElementById('profileDropdownBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        if(profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', (e) => {
                if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        }

        // Carousel Autoplay
        document.addEventListener('DOMContentLoaded', function() {
            const carousels = document.querySelectorAll('.carousel-container');
            carousels.forEach(container => {
                const images = container.querySelectorAll('.carousel-image');
                const badge = container.querySelector('.carousel-badge');
                let currentIndex = 0;
                if(images.length > 1) {
                    setInterval(() => {
                        images[currentIndex].classList.remove('opacity-100', 'z-10'); images[currentIndex].classList.add('opacity-0', 'z-0');
                        currentIndex = (currentIndex + 1) % images.length;
                        images[currentIndex].classList.remove('opacity-0', 'z-0'); images[currentIndex].classList.add('opacity-100', 'z-10');
                        if(badge) badge.innerText = `${currentIndex + 1}/${images.length} Foto`;
                    }, 3500); 
                }
            });
        });

        // ==========================================
        // LOGIKA SWEETALERT FAKE PAYMENT GATEWAY
        // ==========================================
        
        // Fungsi menampilkan nama file gambar yang diupload
        function updateFileName(serviceId) {
            const fileInput = document.getElementById('fileProof_' + serviceId);
            const fileNameDisplay = document.getElementById('displayFileName_' + serviceId);
            if(fileInput.files.length > 0 && fileNameDisplay) {
                fileNameDisplay.innerHTML = `<span class="text-green-400 font-bold text-xs">✓ File terpilih: ${fileInput.files[0].name}</span>`;
            }
        }

        function showOrderOptions(serviceId, price) {
            let formattedPrice = new Intl.NumberFormat('id-ID').format(price);

            Swal.fire({
                title: '<span class="text-white">Pilih Langkah Selanjutnya</span>',
                html: '<p class="text-gray-400 text-sm">Anda ingin langsung memesan atau diskusi dulu dengan Freelancer?</p>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb', // Biru Order Now
                cancelButtonColor: '#16a34a',  // Hijau Chat Freelancer
                confirmButtonText: 'Order Now',
                cancelButtonText: 'Chat Freelancer',
                background: '#171f30',
                reverseButtons: true,
                customClass: { popup: 'border border-gray-700' }
            }).then((result) => {
                
                // JIKA KLIEN PILIH "ORDER NOW"
                if (result.isConfirmed) {
                    Swal.fire({
                        title: '<span class="text-yellow-400">Peringatan!</span>',
                        html: '<p class="text-gray-300 text-sm">Apakah anda sudah konsultasi dengan pihak freelancer? Jika belum, disarankan menghubungi freelancer terlebih dahulu agar pesanan anda sesuai.</p>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2563eb',
                        cancelButtonColor: '#4b5563',
                        confirmButtonText: 'Ya, Lanjutkan Pembayaran',
                        cancelButtonText: 'Kembali',
                        background: '#171f30',
                        customClass: { popup: 'border border-gray-700' }
                    }).then((orderResult) => {
                        if (orderResult.isConfirmed) {
                            Swal.fire({
                                title: '<span class="text-white text-xl">Selesaikan Pembayaran</span>',
                                html: `
                                    <div class="text-left mt-2">
                                        <div class="bg-blue-900 bg-opacity-20 border border-blue-800 rounded-xl p-4 mb-4">
                                            <p class="text-xs text-gray-400 mb-1">Transfer ke Rekening Bersama (Admin JasaPro):</p>
                                            <p class="text-lg font-black text-white tracking-widest">BCA 123-456-7890</p>
                                            <p class="text-sm font-bold text-blue-400 mt-2">Total: Rp ${formattedPrice}</p>
                                        </div>
                                        
                                        <p class="text-xs text-gray-400 mb-2 font-bold uppercase tracking-wider">Upload Bukti Transfer / QRIS:</p>
                                        
                                        <div class="border-2 border-dashed border-gray-600 rounded-xl p-6 flex flex-col items-center justify-center hover:border-blue-500 transition">
                                            <button type="button" onclick="document.getElementById('fileProof_${serviceId}').click()" class="bg-gray-700 hover:bg-gray-600 text-white text-xs font-bold py-2 px-4 rounded shadow-sm mb-2 transition">
                                                📁 Pilih Gambar Bukti
                                            </button>
                                            <div id="displayFileName_${serviceId}" class="text-xs text-gray-500 italic">Belum ada file dipilih</div>
                                        </div>
                                    </div>
                                `,
                                showCancelButton: true,
                                confirmButtonColor: '#2563eb',
                                cancelButtonColor: '#4b5563',
                                confirmButtonText: 'Kirim & Bayar',
                                cancelButtonText: 'Batal',
                                background: '#171f30',
                                customClass: { popup: 'border border-gray-700' },
                                preConfirm: () => {
                                    const fileInput = document.getElementById('fileProof_' + serviceId);
                                    if (fileInput.files.length === 0) {
                                        Swal.showValidationMessage('Anda wajib mengunggah bukti pembayaran!');
                                    }
                                }
                            }).then((payResult) => {
                                if(payResult.isConfirmed) {
                                    Swal.fire({
                                        title: '<span class="text-white">Bukti Terkirim!</span>',
                                        html: '<span class="text-gray-400 text-sm">Admin sedang memverifikasi pembayaran Anda. Membuka ruang obrolan...</span>',
                                        icon: 'success',
                                        background: '#171f30',
                                        showConfirmButton: false,
                                        timer: 2500,
                                        customClass: { popup: 'border border-gray-700' }
                                    }).then(() => {
                                        // Submit form
                                        document.getElementById('formOrder_' + serviceId).submit();
                                    });
                                }
                            });
                        }
                    });
                
                // JIKA KLIEN PILIH "CHAT FREELANCER"
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    document.getElementById('formOrder_' + serviceId).submit();
                }
            });
        }
    </script>
</body>
</html>