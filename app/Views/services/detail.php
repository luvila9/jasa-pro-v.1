<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($service['title']) ?> - JasaPro</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #0b1121; color: #ffffff; }
        .bg-card { background-color: #171f30; }
        .bg-input { background-color: #232b3d; }
        
        .swal2-popup { border: 1px solid #1f2937 !important; border-radius: 1rem !important; }
        .payment-method { border: 1px solid #374151; transition: all 0.2s; }
        .payment-method:hover { border-color: #3b82f6; background-color: #1e293b; }
        .payment-method input[type="radio"] { accent-color: #3b82f6; }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col pb-12">

    <nav class="border-b border-gray-800 bg-[#0b1121] px-4 py-3 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            
            <div class="flex items-center gap-4 w-1/4">
                <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center font-bold text-white">JP</div>
                    <span class="text-xl font-bold hidden sm:block text-white">JasaPro</span>
                </a>
            </div>

            <div class="flex-1 max-w-2xl hidden md:block">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" class="block w-full p-2.5 pl-10 text-sm text-white bg-input border border-gray-700 rounded-full focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500" placeholder="Cari Jasa atau Freelancer">
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 w-1/4">
                <div class="hidden sm:flex items-center gap-2 bg-input px-3 py-1.5 rounded-full border border-gray-700 text-sm font-medium text-white">
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
                            <a href="<?= base_url('panel') ?>" class="flex items-center gap-3 px-5 py-2.5 text-sm hover:bg-gray-800 transition text-gray-300">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                Dashboard
                            </a>
                            <a href="<?= base_url('profile') ?>" class="flex items-center gap-3 px-5 py-2.5 text-sm hover:bg-gray-800 transition text-gray-300">
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

    <main class="pt-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto flex-1 w-full">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-3/5">
                <div class="bg-card rounded-2xl shadow-lg border border-gray-800 overflow-hidden">
                    <?php $images = !empty($service['image']) ? explode(',', $service['image']) : []; ?>
                    
                    <?php if(count($images) > 0 && !empty($images[0])): ?>
                        <div class="w-full h-[400px] bg-black flex items-center justify-center">
                            <img id="mainImage" src="<?= base_url('uploads/services/' . esc(trim($images[0]))) ?>" alt="<?= esc($service['title']) ?>" class="max-w-full max-h-full object-contain">
                        </div>
                        
                        <?php if(count($images) > 1): ?>
                            <div class="flex gap-2 p-4 overflow-x-auto bg-[#1a2235] border-t border-gray-800">
                                <?php foreach($images as $index => $img): ?>
                                    <button onclick="changeImage('<?= base_url('uploads/services/' . esc(trim($img))) ?>')" class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 focus:outline-none focus:border-blue-500 hover:opacity-80 transition <?= $index === 0 ? 'border-blue-500' : 'border-gray-700' ?> thumbnail-btn bg-black">
                                        <img src="<?= base_url('uploads/services/' . esc(trim($img))) ?>" class="w-full h-full object-cover opacity-90 hover:opacity-100">
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="w-full h-[400px] bg-input flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mt-8 bg-card rounded-2xl shadow-lg border border-gray-800 p-6 sm:p-8">
                    <h2 class="text-xl font-bold text-white mb-4 border-b border-gray-800 pb-3">Deskripsi Jasa</h2>
                    <div class="prose max-w-none text-gray-400 whitespace-pre-line leading-relaxed text-sm">
                        <?= esc($service['description']) ?>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/5">
                <div class="bg-card rounded-2xl shadow-lg border border-gray-800 p-6 sm:p-8 sticky top-24">
                    
                    <span class="inline-block px-3 py-1 bg-input text-gray-300 text-[10px] font-bold uppercase tracking-wider rounded border border-gray-700 mb-4">
                        <?= esc($service['category'] ?? 'Umum') ?>
                    </span>

                    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-6 leading-tight">
                        <?= esc($service['title']) ?>
                    </h1>

                    <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-800">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-blue-600 to-blue-400 text-white flex items-center justify-center font-bold text-2xl flex-shrink-0 shadow-lg border border-blue-500">
                            <?= strtoupper(substr($freelancer['fullname'], 0, 1)) ?>
                        </div>
                        
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-0.5">Disediakan oleh</p>
                            <p class="font-bold text-white text-lg"><?= esc($freelancer['fullname']) ?></p>
                            
                            <div class="flex flex-wrap gap-2 mt-2.5">
                                <?php if(!empty($freelancer['whatsapp'])): ?>
                                    <a href="<?= esc($freelancer['whatsapp']) ?>" target="_blank" title="WhatsApp" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#0f2e1b] text-green-500 hover:bg-green-600 hover:text-white transition border border-green-800">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                    </a>
                                <?php endif; ?>

                                <?php if(!empty($freelancer['instagram'])): ?>
                                    <a href="<?= esc($freelancer['instagram']) ?>" target="_blank" title="Instagram" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#2d111d] text-pink-500 hover:bg-pink-600 hover:text-white transition border border-pink-900">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.20 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    </a>
                                <?php endif; ?>

                                <?php if(!empty($freelancer['portfolio'])): ?>
                                    <a href="<?= esc($freelancer['portfolio']) ?>" target="_blank" title="Portofolio" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#122640] text-blue-400 hover:bg-blue-600 hover:text-white transition border border-blue-900">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-sm text-gray-400 font-medium mb-1">Harga Layanan</p>
                        <div class="text-4xl font-black text-blue-500 mb-6">
                            Rp <?= number_format($service['price'], 0, ',', '.') ?>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center text-gray-300">
                                <div class="w-8 h-8 rounded bg-input flex items-center justify-center mr-3 border border-gray-700">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="font-medium text-sm"><?= esc($service['delivery_time'] ?? '1') ?> Hari Pengerjaan</span>
                            </div>
                            <div class="flex items-center text-gray-300">
                                <div class="w-8 h-8 rounded bg-input flex items-center justify-center mr-3 border border-gray-700">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                </div>
                                <span class="font-medium text-sm">
                                    <?php 
                                        $rev = $service['revisions'] ?? 0;
                                        echo ($rev == -1) ? 'Bebas Revisi (Unlimited)' : (($rev == 0) ? 'Tanpa Revisi' : 'Maksimal ' . $rev . ' Kali Revisi');
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php if (session()->get('role') === 'klien'): ?>
                        <form action="<?= base_url('order/create') ?>" method="POST" id="formOrder_<?= $service['id'] ?>" class="w-full" enctype="multipart/form-data">
                            <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                            <input type="file" name="payment_proof" id="fileProof_<?= $service['id'] ?>" class="hidden" accept="image/*" onchange="updateFileName(<?= $service['id'] ?>)">
                        </form>
                        
                        <button type="button" onclick="showOrderOptions(<?= $service['id'] ?>, <?= $service['price'] ?>)" class="w-full py-4 mt-8 text-base font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-900 transition flex items-center justify-center gap-2 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            Pesan Jasa Sekarang
                        </button>

                    <?php elseif (session()->get('role') === 'freelancer' && session()->get('id') == $service['user_id']): ?>
                        <a href="<?= base_url('services/edit/' . $service['id']) ?>" class="w-full py-4 mt-8 text-base font-bold text-center text-white bg-input border border-gray-600 rounded-xl hover:bg-gray-700 transition block">
                            Edit Jasa Ini
                        </a>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </main>

    <script>
        // Logika Dropdown Profile Navbar
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

        // Logika Ganti Gambar Utama
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
            const btns = document.querySelectorAll('.thumbnail-btn');
            btns.forEach(btn => {
                btn.classList.remove('border-blue-500');
                btn.classList.add('border-gray-700');
            });
            event.currentTarget.classList.remove('border-gray-700');
            event.currentTarget.classList.add('border-blue-500');
        }

        // ==========================================
        // LOGIKA SWEETALERT FAKE PAYMENT GATEWAY
        // ==========================================
        
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
                customClass: {
                    popup: 'border border-gray-700'
                }
            }).then((result) => {
                
                // JIKA KLIEN PILIH "ORDER NOW"
                if (result.isConfirmed) {
                    
                    // Tampilkan Warning Konsultasi
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
                        
                        // JIKA KLIEN TETAP MELANJUTKAN ORDER (PAYMENT GATEWAY)
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
                                // JIKA KLIEN KLIK "KIRIM & BAYAR"
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
                                        // Submit form secara otomatis
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