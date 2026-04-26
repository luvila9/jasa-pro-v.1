<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Marketplace Jasa</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 sm:p-10">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h1>
            <p class="text-sm text-gray-500 mt-2">Masuk ke akun Anda untuk melanjutkan.</p>
        </div>

        <?php if(session()->has('success')): ?>
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <?= session('success') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->has('error')): ?>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <?= session('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/processLogin') ?>" method="POST" class="space-y-5">
            
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Alamat Email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="nama@email.com" required>
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200">
                Masuk
            </button>
            
            <p class="text-sm font-light text-gray-500 text-center">
                Belum punya akun? <a href="<?= base_url('register') ?>" class="font-medium text-primary-600 hover:underline">Daftar di sini</a>
            </p>
        </form>
    </div>

</body>
</html>