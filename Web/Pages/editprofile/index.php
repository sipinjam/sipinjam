<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>Edit Profile - Sipinjam</title>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

    <div class="flex">
        <!-- Sidebar -->
        <?php include '../../components/sidebar.php' ?>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div class="flex-grow p-8">
            <div class="p-6 ml-64 mt-16 max-w-9xl bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Edit Profile</h2>
                <div class="border-t border-gray-200 mb-6"></div>
                
                <!-- Edit Profile Section -->
                <div class="flex flex-col items-center mb-6">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class= "w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/>
                    </svg>
                        <i class="text-4xl text-gray-500 fas fa-user"></i>
                    </div>
                    <p class="text-gray-600 mt-2 cursor-pointer">Ganti Foto</p>
                </div>
                <form>
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <div>
                            <label class="text-gray-700">Username</label>
                            <input type="text" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Username">
                        </div>
                        <div>
                            <label class="text-gray-700">Konfirmasi Username</label>
                            <input type="text" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Konfirmasi Username">
                        </div>
                    </div>

                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Edit Password</h2>
                    <div class="border-t border-gray-200 mb-6"></div>

                    <!-- Edit Password Section -->
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <div>
                            <label class="text-gray-700">Masukan Password</label>
                            <input type="password" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Masukan Password">
                        </div>
                        <div>
                            <label class="text-gray-700">Password Baru</label>
                            <input type="password" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Password Baru">
                        </div>
                        <div>
                            <label class="text-gray-700">Konfirmasi Password</label>
                            <input type="password" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Konfirmasi Password">
                        </div>
                    </div>
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Edit No Telp </h2>
                    <div class="border-t border-gray-200 mb-6"></div>

                    <!-- Edit Password Section -->
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <div>
                            <label class="text-gray-700">Masukan No. Telp </label>
                            <input type="No. Telp" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Masukan No. Telp">
                        </div>
                        <div>
                            <label class="text-gray-700">No. Telp Baru </label>
                            <input type="No. Telp" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Masukan No. Telp baru">
                        </div>
                    </div>
                    

                    <div class="flex justify-end">
                        <button type="button" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 mr-2">No, cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Yes, confirm</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Main Content -->
    </div>
</body>
</html>
