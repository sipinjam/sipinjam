<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>SIPINJAM</title>
</head>

<body class="flex flex-col min-h-screen">

    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>
    <!-- End Sidebar -->

    <!-- Header -->
    <div class="w-full h-[120px] bg-gradient-to-br from-blue-800 to-blue-300 p-4 shadow-md fixed top-0 left-0 z-20">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center space-x-3">
                <img src="../../Sources/Img/LogoPolines.png" alt="Logo" class="h-20 w-20">
                <h1 class="text-white text-3xl font-bold pl-3">SIPINJAM</h1>
            </div>
        </div>
    </div>


    <div class="flex-grow pt-[120px]">

        <!--SEARCH -->
        <form class="p-5 ml-auto max-w-lg w-full justify-between max-w-7xl mx-auto" id="search">
            <label for="default-search" class="mb-2 text-sm font-medium text-black sr-only dark:text-black">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-black rounded-[20px] bg-gray-300 dark:bg-gray-300 dark:placeholder-gray-500 dark:text-black" placeholder="Cari Ruangan" required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-4 py-2">Cari</button>
            </div>
        </form>

        <!-- Container for scrolling horizontally -->
        <div class="p-10 ml-64 overflow-x-auto">
            <div class="flex space-x-4">
                <!-- Gedung Card 1 -->
                <div
                    class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                    <a href="#">
                        <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg"
                            alt="Administrasi Bisnis" />
                    </a>
                    <div class="p-3">
                        <a href="#">
                            <span
                                class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Administrasi
                                Bisnis</span>
                        </a>
                    </div>
                </div>

                <!-- Gedung Card 2 -->
                <div
                    class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                    <a href="#">
                        <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/gkt-bg.jpeg"
                            alt="Gedung Kuliah Terpadu" />
                    </a>
                    <div class="p-3">
                        <a href="#">
                            <span
                                class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung
                                Kuliah Terpadu</span>
                        </a>
                    </div>
                </div>

                <!-- Gedung Card 3 -->
                <div
                    class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                    <a href="#">
                        <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/mst.jpg"
                            alt="Magister Terapan" />
                    </a>
                    <div class="p-3">
                        <a href="#">
                            <span
                                class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Magister
                                Terapan</span>
                        </a>
                    </div>
                </div>

                <!-- Gedung Card 4 -->
                <div
                    class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                    <a href="#">
                        <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg"
                            alt="Gedung Sekolah A" />
                    </a>
                    <div class="p-3">
                        <a href="#">
                            <span
                                class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung
                                Sekolah A</span>
                        </a>
                    </div>
                </div>

                <!-- Gedung Card 5 -->
                <div
                    class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                    <a href="#">
                        <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg"
                            alt="Gedung Sekolah B" />
                    </a>
                    <div class="p-3">
                        <a href="#">
                            <span
                                class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung
                                Sekolah B</span>
                        </a>
                    </div>
                </div>

                <!-- Gedung Card 6 -->
                <div
                    class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                    <a href="#">
                        <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg"
                            alt="Gedung Sekolah C" />
                    </a>
                    <div class="p-3">
                        <a href="#">
                            <span
                                class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung
                                Sekolah C</span>
                        </a>
                    </div>
                </div>

                <!-- Gedung Card 7 -->
                <div
                    class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                    <a href="#">
                        <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg"
                            alt="Gedung Akuntansi" />
                    </a>
                    <div class="p-3">
                        <a href="#">
                            <span
                                class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung
                                Akuntansi</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--Ruangan yang Sedang Dipinjam-->
        <div class="p-4 sm:ml-64">
            <h3 class="text-4xl font-bold p-4">Ruangan yang Sedang Dipinjam</h3>
            <!-- Responsive Grid -->
            <div class="pt-5 grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4 mb-4">
                <a href="#"
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-48 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        src="../../Sources/Img/gedungkuliah-terpadu.png" alt="png">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Gedung Kuliah Terpadu</h5>
                        <p class="text-sm text-gray-600 pt-2">Peminjam:</p>
                        <p class="text-sm font-bold">UKM Rohkris</p>
                        <p class="text-sm text-gray-600 pt-1">Tanggal Pinjam:</p>
                        <p class="text-sm font-bold">28 September 2024</p>
                        <p class="text-sm mt-2">Status: <span class="text-green-600 font-bold">Disetujui</span></p>
                    </div>
                </a>

                <a href="#"
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-48 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        src="../../Sources/Img/gedungkuliah-terpadu.png" alt="png">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Gedung Kuliah Terpadu</h5>
                        <p class="text-sm text-gray-600 pt-2">Peminjam:</p>
                        <p class="text-sm font-bold">UKM Rohkris</p>
                        <p class="text-sm text-gray-600 pt-1">Tanggal Pinjam:</p>
                        <p class="text-sm font-bold">29 September 2024</p>
                        <p class="text-sm mt-2">Status: <span class="text-green-600 font-bold">Disetujui</span></p>
                    </div>
                </a>

                <a href="#"
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-48 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        src="../../Sources/Img/gedungkuliah-terpadu.png" alt="png">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Gedung Kuliah Terpadu</h5>
                        <p class="text-sm text-gray-600 pt-2">Peminjam:</p>
                        <p class="text-sm font-bold">UKM Rohkris</p>
                        <p class="text-sm text-gray-600 pt-1">Tanggal Pinjam:</p>
                        <p class="text-sm font-bold">10 Oktober 2024</p>
                        <p class="text-sm mt-2">Status: <span class="text-green-600 font-bold">Disetujui</span></p>
                    </div>
                </a>

                <a href="#"
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-48 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        src="../../Sources/Img/gedungkuliah-terpadu.png" alt="png">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Gedung Kuliah Terpadu</h5>
                        <p class="text-sm text-gray-600 pt-2">Peminjam:</p>
                        <p class="text-sm font-bold">UKM Rohkris</p>
                        <p class="text-sm text-gray-600 pt-1">Tanggal Pinjam:</p>
                        <p class="text-sm font-bold">17 Oktober 2024</p>
                        <p class="text-sm mt-2">Status: <span class="text-green-600 font-bold">Disetujui</span></p>
                    </div>
                </a>

            </div>
        </div>

        <!-- Page Navigation -->
        <nav aria-label="Page navigation example">
            <ul class="flex items-center justify-center h-20 text-sm">
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" aria-current="page"
                        class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">1</a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">3</a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Next</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
</body>

</html>