<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
</head>
<body class="bg-gray-100">

    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Section -->
        <div class="bg-blue-500 h-32 flex items-center justify-center relative">
            <img src="https://via.placeholder.com/150" class="w-16 h-16 rounded-full bg-gray-300 absolute -bottom-8 left-6 border-4 border-white">
            <h2 class="text-white text-xl font-bold mt-10">PENGGUNA SIPINJAM</h2>
        </div>

        <!-- Profile Section -->
        <div class="px-6 py-4 mt-10">
            <p class="text-center text-gray-600 font-semibold">UKM ROHKRIS</p>
            <p class="text-center text-sm text-gray-500">sipinjam@gmail.com</p>
            <p class="text-center text-sm text-gray-500">08123456789</p>
            <button class="absolute top-4 right-4 bg-red-500 text-white px-4 py-1 rounded">Log out</button>
        </div>

        <!-- Menu Section -->
        <div class="px-6 py-4 space-y-3">
            <a href="#" class="flex items-center justify-between bg-gray-100 p-3 rounded-lg text-gray-700 hover:bg-gray-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7V3m-4 4V3m-4 4V3M5 9h14M5 21h14m-7-6h7m-7 6h7" />
                    </svg>
                    <span>Edit Profile</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="#" class="flex items-center justify-between bg-gray-100 p-3 rounded-lg text-gray-700 hover:bg-gray-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18" />
                    </svg>
                    <span>Bahasa</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="#" class="flex items-center justify-between bg-gray-100 p-3 rounded-lg text-gray-700 hover:bg-gray-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 20h15l1-10H3.5l1 10zM9.5 5l2 6h5l2-6" />
                    </svg>
                    <span>FAQ</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

</body>
</html>
