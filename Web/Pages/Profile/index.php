<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>Sipinjam</title>
</head>
<body>
    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->
    
    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>
    
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-blue-600 h-40 flex items-center justify-center">
        <h1 class="text-white font-semibold text-sm">PROFILE</h1>
    </div>

    <!-- Profile Section -->
    <div class="flex items-center p-5 space-x-4">
        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
            <!-- Avatar Icon -->
            <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.67 0 8 1.34 8 4v2H4v-2c0-2.66 5.33-4 8-4zm0-2c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm0-10C5.48 0 0 5.48 0 12s5.48 12 12 12 12-5.48 12-12S18.52 0 12 0zm0 22c-5.53 0-10-4.47-10-10S6.47 2 12 2s10 4.47 10 10-4.47 10-10 10z"/>
            </svg>
        </div>
        <div>
            <p class="text-lg font-semibold">PENGGUNA SIPINJAM</p>
            <p class="text-sm text-gray-500">sipinmataku@gmail.com</p>
            <p class="text-sm text-gray-500">08123456789</p>
        </div>
    </div>

    <!-- Options -->
    <div class="p-4">
        <div class="flex items-center justify-between p-4 border-b cursor-pointer">
            <span class="flex items-center text-base">
                <svg class="w-5 h-5 text-gray-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 17v-2h14v2H3zm0 4v-2h10v2H3zm0-8v-2h18v2H3zm0-4V7h18v2H3z"/>
                </svg>
                Edit Profile
            </span>
            <span>></span>
        </div>

        <div class="flex items-center justify-between p-4 border-b cursor-pointer">
            <span class="flex items-center text-base">
                <svg class="w-5 h-5 text-gray-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M5 12h14v2H5z"/>
                </svg>
                Bahasa
            </span>
            <span>></span>
        </div>

        <div class="flex items-center justify-between p-4 cursor-pointer">
            <span class="flex items-center text-base">
                <svg class="w-5 h-5 text-gray-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 6h16v2H4zm0 6h16v2H4zm0 6h16v2H4z"/>
                </svg>
                FAQ
            </span>
            <span>></span>
        </div>
    </div>

    <!-- Log out Button -->
    <div class="flex justify-end p-4">
        <button class="text-base text-red-500 font-semibold">Log out</button>
    </div>
</div>
</body>
</html>
