<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Kerja Freelancer - JasaPro</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">

    <nav class="bg-white border-b border-gray-200 px-4 py-3 fixed left-0 right-0 top-0 z-50 shadow-sm">
        <div class="flex flex-wrap justify-between items-center max-w-7xl mx-auto">
            
            <div class="flex justify-start items-center">
                <span class="self-center text-2xl font-bold text-primary-600 whitespace-nowrap">JasaPro</span>
                <span class="ml-3 px-2 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-md border border-gray-200">Freelancer Panel</span>
            </div>
            
            <div class="flex items-center gap-2 sm:gap-4">
                
                <div class="relative">
                    <button id="chatDropdownBtn" class="relative p-2 text-gray-500 hover:text-primary-600 focus:outline-none transition rounded-full hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <?php if(count($chats) > 0): ?>
                            <span class="absolute top-1 right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white bg-red-500 rounded-full transform translate-x-1/4 -translate-y-1/4">
                                <?= count($chats) ?>
                            </span>
                        <?php endif; ?>
                    </button>

                    <div id="chatDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-100 z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                            <h3 class="text-sm font-bold text-gray-800">Pesan Masuk Klien</h3>
                        </div>
                        <div class="max-h-80 overflow-y-auto">
                            <?php if(empty($chats)): ?>
                                <div class="p-6 text-center text-sm text-gray-500">Belum ada obrolan.</div>
                            <?php else: ?>
                                <?php foreach($chats as $chat): ?>
                                    <a href="<?= base_url('chat/' . $chat['order_id']) ?>" class="flex items-center px-4 py-3 hover:bg-gray-50 transition border-b border-gray-50 last:border-0 group">
                                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold text-sm mr-3 group-hover:bg-green-600 group-hover:text-white transition">
                                            <?= strtoupper(substr($chat['partner_name'], 0, 1)) ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-bold text-gray-900 truncate"><?= esc($chat['partner_name']) ?></h4>
                                            <p class="text-xs text-gray-500 truncate"><?= esc($chat['service_title']) ?></p>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="hidden md:flex items-center pl-4 border-l border-gray-300 ml-2 relative z-50">
                    <button id="profileDropdownBtn" class="flex items-center gap-2 focus:outline-none">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-gray-700 to-gray-900 flex items-center justify-center text-white font-bold shadow-sm border-2 border-transparent hover:border-gray-400 transition">
                            <?= strtoupper(substr(session()->get('fullname'), 0, 1)) ?>
                        </div>
                    </button>

                    <div id="profileDropdown" class="hidden absolute right-0 top-12 mt-2 w-64 bg-[#1e2330] border border-gray-700 rounded-xl shadow-2xl text-gray-300 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-700 bg-[#191d28]">
                            <p class="text-xs text-gray-400 mb-0.5">Telah masuk sebagai</p>
                            <p class="text-sm font-bold text-white truncate"><?= esc(session()->get('fullname')) ?></p>
                        </div>
                        <div class="py-2">
                            <a href="<?= base_url('panel') ?>" class="flex items-center gap-3 px-5 py-2.5 text-sm hover:bg-gray-800 transition">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                Dashboard
                            </a>
                            <div class="my-1 border-t border-gray-700"></div>
                            <a href="<?= base_url('logout') ?>" class="flex items-center gap-3 px-5 py-2.5 text-sm hover:bg-gray-800 transition text-gray-400 hover:text-white">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </a>
                        </div>
                    </div>
                </div>

                <button id="mobileMenuBtn" class="md:hidden p-2 text-gray-500 hover:text-primary-600 focus:outline-none rounded-lg hover:bg-gray-100 transition ml-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

            </div>

            <div id="mobileMenu" class="hidden w-full md:hidden flex-col mt-3 pt-3 border-t border-gray-100 gap-1">
                <div class="text-sm text-gray-500 px-3 py-2">
                    Masuk sebagai <span class="font-bold text-gray-900"><?= esc(session()->get('fullname')) ?></span>
                </div>
                <a href="<?= base_url('profile') ?>" class="block px-3 py-2.5 text-primary-600 font-medium hover:bg-primary-50 rounded-lg transition">Edit Profil</a>
                <a href="<?= base_url('logout') ?>" class="block px-3 py-2.5 text-red-600 font-medium hover:bg-red-50 rounded-lg transition">Logout</a>
            </div>

        </div>
    </nav>

    <main class="pt-24 pb-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8 mb-6 border border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ruang Kerja Freelancer</h1>
                <p class="text-gray-500 mt-1">Kelola jasa yang Anda tawarkan dan pantau pesanan masuk di sini.</p>
            </div>
            <a href="<?= base_url('services/create') ?>" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 transition shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Jasa Baru
            </a>
        </div>

        <?php if(session()->has('success')): ?>
            <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                <?= session('success') ?>
            </div>
        <?php endif; ?>

        <?php 
            $pendingCount = 0;
            if(!empty($chats)) {
                foreach($chats as $c) {
                    if(isset($c['status']) && $c['status'] == 'pending') $pendingCount++;
                }
            }
        ?>
        <?php if($pendingCount > 0): ?>
            <div class="p-4 mb-8 text-sm text-yellow-800 rounded-xl bg-yellow-50 border border-yellow-200 shadow-sm flex items-start sm:items-center justify-between flex-col sm:flex-row gap-3" role="alert">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-yellow-100 rounded-full text-yellow-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <span class="font-bold text-base block">Pemberitahuan Pesanan Baru!</span> 
                        Anda memiliki <strong class="text-yellow-900"><?= $pendingCount ?> pesanan baru</strong> yang menunggu untuk direspon atau diproses.
                    </div>
                </div>
                <a href="<?= base_url('panel') ?>" class="whitespace-nowrap px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-bold rounded-lg transition shadow-sm text-xs">
                    Lihat Pesanan &rarr;
                </a>
            </div>
        <?php endif; ?>

        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Etalase Jasa Saya</h2>
            
            <?php if(empty($my_services)): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-10 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Jasa</h3>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">Anda belum menawarkan jasa apa pun. Klien tidak akan bisa menemukan Anda sampai Anda membuat etalase jasa pertama Anda.</p>
                    <a href="<?= base_url('services/create') ?>" class="text-primary-600 font-medium hover:underline">Mulai buat jasa sekarang &rarr;</a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($my_services as $service): ?>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col">
                            
                            <?php $images = !empty($service['image']) ? explode(',', $service['image']) : []; ?>
                            
                            <?php if(count($images) > 0 && !empty($images[0])): ?>
                                <div class="relative w-full h-48 bg-black border-b border-gray-200 overflow-hidden carousel-container group">
                                    <?php foreach($images as $index => $img): ?>
                                        <img src="<?= base_url('uploads/services/' . esc(trim($img))) ?>" alt="<?= esc($service['title']) ?>" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out cursor-zoom-in carousel-image <?= $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' ?>" onclick="openModal(this.src)">
                                    <?php endforeach; ?>
                                    <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-20">
                                        <svg class="w-10 h-10 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                    </div>
                                    <?php if(count($images) > 1): ?>
                                        <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs font-bold px-2 py-1 rounded-md shadow-sm z-20 carousel-badge">1/<?= count($images) ?> Foto</div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center border-b border-gray-200">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            <?php endif; ?>

                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 line-clamp-1 pr-2" title="<?= esc($service['title']) ?>"><?= esc($service['title']) ?></h3>
                                    <?php if($service['status'] === 'active'): ?>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-200">Aktif</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded border border-red-200">Nonaktif</span>
                                    <?php endif; ?>
                                </div>
                                <p class="text-gray-500 text-sm line-clamp-2 mb-4 flex-1"><?= esc($service['description']) ?></p>
                                <div class="text-xl font-black text-gray-900 mb-4">Rp <?= number_format($service['price'], 0, ',', '.') ?></div>
                                <div class="flex gap-2 border-t border-gray-100 pt-4 mt-auto">
                                    <a href="<?= base_url('services/edit/' . $service['id']) ?>" class="flex-1 px-3 py-2 text-sm font-medium text-center text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition block">
                                        Edit Jasa
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <div id="imageModal" class="fixed inset-0 z-[100] hidden bg-black/90 flex items-center justify-center backdrop-blur-sm transition-opacity duration-300 opacity-0" onclick="closeModal()">
        <span class="absolute top-5 right-5 text-white text-4xl cursor-pointer hover:text-gray-300 transition">&times;</span>
        <img id="modalImage" src="" class="max-w-[90%] max-h-[90vh] object-contain rounded-lg shadow-2xl scale-95 transition-transform duration-300">
    </div>

    <script>
        // Logika Navbar Dropdown Chat
        const chatBtn = document.getElementById('chatDropdownBtn');
        const chatDropdown = document.getElementById('chatDropdown');
        if(chatBtn) {
            chatBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                chatDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', (e) => {
                if (!chatBtn.contains(e.target) && !chatDropdown.contains(e.target)) {
                    chatDropdown.classList.add('hidden');
                }
            });
        }

        // Logika Dropdown Profil
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

        // Modal Gambar
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        function openModal(src) {
            modal.classList.remove('hidden');
            setTimeout(() => { modal.classList.remove('opacity-0'); modalImg.src = src; modalImg.classList.remove('scale-95'); modalImg.classList.add('scale-100'); }, 10);
        }
        function closeModal() {
            modal.classList.add('opacity-0'); modalImg.classList.remove('scale-100'); modalImg.classList.add('scale-95');
            setTimeout(() => { modal.classList.add('hidden'); modalImg.src = ''; }, 300);
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

        // Mobile Menu
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if(mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if(mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.classList.add('flex');
                } else {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('flex');
                }
            });
            document.addEventListener('click', (e) => {
                if (!mobileMenuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('flex');
                }
            });
        }
    </script>
</body>
</html>