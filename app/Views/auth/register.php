<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Marketplace Jasa</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 sm:p-10">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h1>
            <p class="text-sm text-gray-500 mt-2">Mulai temukan jasa atau tawarkan keahlian Anda.</p>
        </div>

        <?php if(session()->has('errors')): ?>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <ul class="list-disc pl-5">
                    <?php foreach(session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/processRegister') ?>" method="POST" class="space-y-5">
            
            <div>
                <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                <input type="text" name="fullname" id="fullname" value="<?= old('fullname') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="John Doe" required>
            </div>

            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Alamat Email</label>
                <input type="email" name="email" id="email" value="<?= old('email') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="nama@email.com" required>
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="••••••••" required>
            </div>

            <div>
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Mendaftar Sebagai</label>
                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option value="klien">Klien (Mencari Jasa)</option>
                    <option value="freelancer">Freelancer (Menawarkan Jasa)</option>
                </select>
            </div>

            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200">
                Daftar Sekarang
            </button>
            
            <p class="text-sm font-light text-gray-500 text-center">
                Sudah punya akun? <a href="<?= base_url('login') ?>" class="font-medium text-primary-600 hover:underline">Login di sini</a>
            </p>
        </form>
    </div>

    <script src="<?= base_url('node_modules/flowbite/dist/flowbite.min.js') ?>"></script>
</body>
</html>