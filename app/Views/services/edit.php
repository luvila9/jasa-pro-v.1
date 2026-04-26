<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jasa - JasaPro</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <nav class="bg-white border-b border-gray-200 px-4 py-3 fixed left-0 right-0 top-0 z-50 shadow-sm">
        <div class="flex flex-wrap justify-between items-center max-w-3xl mx-auto">
            <a href="<?= base_url('dashboard') ?>" class="text-gray-500 hover:text-gray-900 flex items-center font-medium transition">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <span class="text-lg font-bold text-gray-900">Edit Detail Jasa</span>
            <div class="w-16"></div>
        </div>
    </nav>

    <main class="pt-24 pb-8 px-4 max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sm:p-8">
            
            <?php if(session()->has('errors')): ?>
                <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                    <ul class="list-disc pl-5">
                        <?php foreach(session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('services/update/' . $service['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Judul Jasa <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="<?= old('title', $service['title']) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-3" required>
                </div>

                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Kategori Jasa <span class="text-red-500">*</span></label>
                    <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-3" required>
                        <option value="" disabled>Pilih kategori yang paling sesuai...</option>
                        <?php 
                            $categories = [
                                'Programmer & IT' => 'Programmer & IT (Web, App, Jaringan)',
                                'Desain & Grafis' => 'Desain & Grafis (Logo, Ilustrasi, UI/UX)',
                                'Audio & Video' => 'Audio & Video (Editor, Animator, Artis/Voice Over)',
                                'Penulisan & Penerjemahan' => 'Penulisan & Penerjemahan (Artikel, Copywriting)',
                                'Pemasaran Digital' => 'Pemasaran Digital (SEO, Social Media, Iklan)',
                                'Arsitektur & Interior' => 'Arsitektur & Interior (Desain Bangunan, 3D Render)',
                                'Perbaikan & Mekanik' => 'Perbaikan & Mekanik (Elektronik, Otomotif, Mesin)',
                                'Pendidikan & Tutoring' => 'Pendidikan & Tutoring (Guru Les, Pelatihan)',
                                'Konsultasi Bisnis' => 'Konsultasi Bisnis (Keuangan, Hukum, Pajak)',
                                'Lainnya' => 'Lainnya...'
                            ];
                            foreach($categories as $val => $label):
                                $selected = (old('category', $service['category']) == $val) ? 'selected' : '';
                        ?>
                            <option value="<?= $val ?>" <?= $selected ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Harga (Rp)</label>
                        <input type="number" name="price" id="price" value="<?= old('price', isset($service) ? $service['price'] : '') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Contoh: 500000" required>
                    </div>

                    <div>
                        <label for="delivery_time" class="block mb-2 text-sm font-medium text-gray-900">Waktu Kerja (Hari) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" name="delivery_time" id="delivery_time" value="<?= old('delivery_time', isset($service) ? $service['delivery_time'] : '') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 pr-12" placeholder="Contoh: 7" min="1" required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500 font-medium text-sm">Hari</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="revisions" class="block mb-2 text-sm font-medium text-gray-900">Batas Revisi</label>
                        <select name="revisions" id="revisions" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="0" <?= old('revisions', isset($service) ? $service['revisions'] : '') == '0' ? 'selected' : '' ?>>Tanpa Revisi</option>
                            <?php for($i=1; $i<=10; $i++): ?>
                                <option value="<?= $i ?>" <?= old('revisions', isset($service) ? $service['revisions'] : '') == $i ? 'selected' : '' ?>>
                                    <?= $i ?> Kali Revisi
                                </option>
                            <?php endfor; ?>
                            <option value="-1" <?= old('revisions', isset($service) ? $service['revisions'] : '') == '-1' ? 'selected' : '' ?>>Sepuasnya (Unlimited)</option>
                        </select>
                    </div>
                </div>

                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status Jasa <span class="text-red-500">*</span></label>
                        <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-3">
                            <option value="active" <?= ($service['status'] == 'active') ? 'selected' : '' ?>>Aktif (Terlihat oleh klien)</option>
                            <option value="inactive" <?= ($service['status'] == 'inactive') ? 'selected' : '' ?>>Nonaktif (Disembunyikan sementara)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-3" required><?= old('description', $service['description']) ?></textarea>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Ganti Foto Portofolio (Opsional)</label>
                    
                    <?php if(!empty($service['image'])): ?>
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-2">Foto saat ini:</p>
                            <div class="flex gap-2 overflow-x-auto pb-2">
                                <?php foreach(explode(',', $service['image']) as $img): ?>
                                    <?php if(trim($img) !== ''): ?>
                                        <img src="<?= base_url('uploads/services/' . trim($img)) ?>" alt="Gallery" class="h-20 w-auto object-cover rounded border border-gray-200 shadow-sm">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <input type="file" name="images[]" multiple accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    
                    <p class="mt-1 text-xs text-gray-500">Tahan tombol <b>Ctrl</b>/<b>Command</b> untuk memilih beberapa gambar sekaligus. Memilih gambar baru akan menimpa semua gambar lama.</p>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="<?= base_url('dashboard') ?>" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition">Batal</a>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition">Simpan Perubahan</button>
                </div>

            </form>
        </div>
    </main>

</body>
</html>