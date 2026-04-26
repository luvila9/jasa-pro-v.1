<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pengguna - JasaPro</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
</head>
<body class="font-sans antialiased h-screen flex overflow-hidden text-sm bg-gray-50 text-gray-900">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col flex-shrink-0 shadow-sm z-10">
        
        <div class="h-16 flex items-center px-6 border-b border-gray-100">
            <span class="text-xl font-black text-primary-600">JasaPro <span class="font-medium text-gray-400">Panel</span></span>
        </div> 

        <nav class="flex-1 px-4 space-y-2 mt-6">
            
            <a href="<?= base_url('panel') ?>" class="flex items-center gap-3 px-4 py-3 bg-primary-50 text-primary-700 rounded-xl font-bold transition border border-primary-100">
                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            
            <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:text-primary-600 hover:bg-gray-50 rounded-xl font-medium transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Ruang Kerja
            </a>
            
            <div class="pt-6 mt-6 border-t border-gray-100">
                <a href="<?= base_url('logout') ?>" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Akun
                </a>
            </div>
        </nav>
    </aside>

    <main class="flex-1 overflow-y-auto p-6 md:p-10">
        <div class="max-w-6xl mx-auto">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10" id="pengaturan-profil">
                
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-primary-500 to-blue-400 flex items-center justify-center text-white font-bold text-4xl shadow-md mb-4 border-4 border-white">
                        <?= strtoupper(substr(session()->get('fullname'), 0, 1)) ?>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 mb-2"><?= esc(session()->get('fullname')) ?></h2>
                    <span class="px-4 py-1 bg-primary-50 text-primary-700 text-xs font-bold uppercase tracking-wider rounded-full border border-primary-200">
                        <?= esc(session()->get('role') ?? 'Member') ?>
                    </span>
                    <div class="w-full mt-6 pt-6 border-t border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Bergabung sejak</p>
                        <p class="font-medium text-gray-700"><?= date('F Y') ?></p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 lg:p-8 lg:col-span-2">
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Pengaturan Profil & Sosmed</h3>
                    <p class="text-sm text-gray-500 mb-6">Lengkapi tautan sosial media dan portofolio Anda agar klien lebih mudah menghubungi Anda.</p>
                    
                    <?php if(session()->has('success')): ?>
                        <div class="p-3 mb-6 text-sm text-green-700 bg-green-50 rounded-lg border border-green-200"><?= session('success') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('profile/update') ?>" method="POST" class="space-y-5">
                        
                        <div>
                            <label class="block mb-1.5 text-sm font-bold text-gray-700">Link WhatsApp (Opsional)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                </div>
                                <input type="url" name="whatsapp" value="<?= esc($user['whatsapp'] ?? '') ?>" placeholder="https://wa.me/62812..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-1.5 text-sm font-bold text-gray-700">Link Instagram (Opsional)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-pink-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.20 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    </div>
                                    <input type="url" name="instagram" value="<?= esc($user['instagram'] ?? '') ?>" placeholder="https://instagram.com/..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5">
                                </div>
                            </div>

                            <div>
                                <label class="block mb-1.5 text-sm font-bold text-gray-700">Link Portofolio (Opsional)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                    </div>
                                    <input type="url" name="portfolio" value="<?= esc($user['portfolio'] ?? '') ?>" placeholder="https://web..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5">
                                </div>
                            </div>
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-bold rounded-lg text-sm transition shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="mb-10">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Laporan Aktivitas</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex flex-col justify-center">
                        <span class="text-sm font-medium text-gray-500 mb-1">Total Pesanan Diproses</span>
                        <span class="text-3xl font-black text-gray-900"><?= esc($total_transaksi ?? 0) ?></span>
                    </div>
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex flex-col justify-center">
                        <span class="text-sm font-medium text-gray-500 mb-1"><?= session()->get('role') == 'freelancer' ? 'Total Pendapatan' : 'Total Pembelanjaan' ?></span>
                        <span class="text-3xl font-black text-primary-600">Rp <?= number_format($total_amount ?? 0, 0, ',', '.') ?></span>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl py-5 flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-yellow-700 mb-0.5"><?= esc($count_pending ?? 0) ?></span>
                        <span class="text-xs font-bold text-yellow-600 uppercase">Menunggu</span>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl py-5 flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-blue-700 mb-0.5"><?= esc($count_process ?? 0) ?></span>
                        <span class="text-xs font-bold text-blue-600 uppercase">Dalam Proses</span>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-xl py-5 flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-green-700 mb-0.5"><?= esc($count_success ?? 0) ?></span>
                        <span class="text-xs font-bold text-green-600 uppercase">Selesai</span>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-xl py-5 flex flex-col items-center justify-center">
                        <span class="text-2xl font-bold text-red-700 mb-0.5"><?= esc($count_failed ?? 0) ?></span>
                        <span class="text-xs font-bold text-red-600 uppercase">Gagal / Batal</span>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Riwayat Transaksi Terakhir</h3>
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-200 bg-gray-50 text-xs text-gray-500 font-bold uppercase tracking-wider">
                                    <th class="py-4 px-5 whitespace-nowrap">Tanggal</th>
                                    <th class="py-4 px-5 whitespace-nowrap">Order ID</th>
                                    <th class="py-4 px-5 whitespace-nowrap">Deskripsi Layanan</th>
                                    <th class="py-4 px-5 whitespace-nowrap">Total Harga</th>
                                    <th class="py-4 px-5 whitespace-nowrap">Status</th>
                                    <th class="py-4 px-5 whitespace-nowrap text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                                <?php if(empty($recent_orders)): ?>
                                    <tr>
                                        <td colspan="6" class="py-10 text-center text-gray-500 italic">Belum ada riwayat transaksi.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($recent_orders as $order): ?>
                                        <tr class="hover:bg-gray-50 transition duration-200">
                                            <td class="py-4 px-5 whitespace-nowrap text-gray-500">
                                                <?= isset($order['created_at']) ? date('d-m-Y H:i', strtotime($order['created_at'])) : '-' ?>
                                            </td>
                                            <td class="py-4 px-5 font-bold text-gray-900 whitespace-nowrap">
                                                #<?= str_pad($order['order_id'], 5, '0', STR_PAD_LEFT) ?>
                                            </td>
                                            <td class="py-4 px-5">
                                                <div class="font-bold text-gray-900 line-clamp-1 max-w-[200px]" title="<?= esc($order['service_title']) ?>">
                                                    <?= esc($order['service_title']) ?>
                                                </div>
                                                <div class="text-xs text-primary-600 font-medium mt-0.5">Partner: <?= esc($order['partner_name']) ?></div>
                                            </td>
                                            <td class="py-4 px-5 font-medium whitespace-nowrap">
                                                Rp <?= number_format($order['price'] ?? 0, 0, ',', '.') ?>
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                <?php
                                                    $status = $order['status'] ?? 'pending';
                                                    if($status == 'completed') echo '<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-bold tracking-wide">SELESAI</span>';
                                                    elseif($status == 'in_progress') echo '<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-[10px] font-bold tracking-wide">DIPROSES</span>';
                                                    elseif($status == 'canceled') echo '<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-bold tracking-wide">BATAL</span>';
                                                    else echo '<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-bold tracking-wide">MENUNGGU</span>';
                                                ?>
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap text-right">
                                                <a href="<?= base_url('chat/' . $order['order_id']) ?>" class="inline-flex items-center justify-center px-4 py-2 bg-white text-primary-600 hover:bg-primary-50 rounded-lg transition text-xs font-bold border border-gray-200 shadow-sm gap-1.5">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                                    Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>