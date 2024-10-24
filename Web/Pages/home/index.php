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
    <div class="flex-grow">
    <!--SEARCH-->
    <form class="max-w-md mx-auto mt-5">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-[20px] bg-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-300 dark:border-gray-300 dark:placeholder-gray-500 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Cari Ruangan" required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-biru-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-800 dark:hover:bg-blue-800 dark:focus:ring-blue-800">Cari</button>
        </div>
    </form>
    
    <!-- Sidebar -->
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
        type="button"
        class="inline-flex items-center p-2mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-biru-800 dark:bg-biru-800">
            <a href="https://flowbite.com/" class="flex items-center pt-4 ps-8 mb-5">
                <img src="../../Sources/Img/LogoPolines.png" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">SIPINJAM</span>
            </a>
            <ul class="space-y-2 pt-10 font-medium">
                <li>
                    <a href="../home/"
                        class="flex items-center p-2 text-white rounded-lg active bg-biru-500 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white transition duration-75"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 512.001 512.001">
                            <path
                                d="M490.134,185.472L338.966,34.304c-45.855-45.737-120.076-45.737-165.931,0L21.867,185.472   C7.819,199.445-0.055,218.457,0,238.272v221.397C0.047,488.568,23.475,511.976,52.374,512h407.253   c28.899-0.023,52.326-23.432,52.373-52.331V238.272C512.056,218.457,504.182,199.445,490.134,185.472z M448,448H341.334v-67.883   c0-44.984-36.467-81.451-81.451-81.451c0,0,0,0,0,0h-7.765c-44.984,0-81.451,36.467-81.451,81.451l0,0V448H64V238.272   c0.007-2.829,1.125-5.541,3.115-7.552L218.283,79.552c20.825-20.831,54.594-20.835,75.425-0.01c0.003,0.003,0.007,0.007,0.01,0.01   L444.886,230.72c1.989,2.011,3.108,4.723,3.115,7.552V448z" />
                        </svg>
                        <span class="ms-3">Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white">
                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="m6,1c0-.553.448-1,1-1h10c.552,0,1,.447,1,1s-.448,1-1,1H7c-.552,0-1-.447-1-1Zm-2,6h16c.552,0,1-.447,1-1s-.448-1-1-1H4c-.552,0-1,.447-1,1s.448,1,1,1Zm20,11c0,3.314-2.686,6-6,6s-6-2.686-6-6,2.686-6,6-6,6,2.686,6,6Zm-2.5,0c0-.553-.447-1-1-1h-1.5v-1.5c0-.553-.447-1-1-1s-1,.447-1,1v1.5h-1.5c-.553,0-1,.447-1,1s.447,1,1,1h1.5v1.5c0,.553.447,1,1,1s1-.447,1-1v-1.5h1.5c.553,0,1-.447,1-1Zm-11.5,0c0-4.418,3.582-8,8-8H5c-2.757,0-5,2.243-5,5v4c0,2.757,2.243,5,5,5h7.709c-1.661-1.466-2.709-3.61-2.709-6Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Riwayat</span>
                    </a>
                </li>
                <li>
                    <a href="../Schedule/"
                        class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white transition duration-75"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M24,5v3H0v-3c0-1.654,1.346-3,3-3h3V0h2V2h8V0h2V2h3c1.654,0,3,1.346,3,3Zm0,12c0,3.86-3.141,7-7,7s-7-3.14-7-7,3.141-7,7-7,7,3.14,7,7Zm-4.293,1.293l-1.707-1.707v-2.586h-2v3.414l2.293,2.293,1.414-1.414Zm-11.707-1.293c0-2.829,1.308-5.35,3.349-7H0v14H11.349c-2.041-1.65-3.349-4.171-3.349-7Z" />
                        </svg>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Jadwal</span>
                    </a>
                </li>
                <li>
                    <a href="../Profile/"
                        class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white transition duration-75"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Profil</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    </div>
    <!-- End Sidebar -->

    <!-- Container for scrolling horizontally -->
    <div class="p-10 sm:ml-64 overflow-x-auto">
        <div class="flex space-x-4">
            <!-- Gedung Card 1 -->
            <div class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                <a href="#">
                    <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg" alt="Administrasi Bisnis"/>
                </a>
                <div class="p-3">
                    <a href="#">
                        <span class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Administrasi Bisnis</span>
                    </a>
                </div>
            </div>

            <!-- Gedung Card 2 -->
            <div class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                <a href="#">
                    <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/gkt-bg.jpeg" alt="Gedung Kuliah Terpadu"/>
                </a>
                <div class="p-3">
                    <a href="#">
                        <span class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung Kuliah Terpadu</span>
                    </a>
                </div>
            </div>

            <!-- Gedung Card 3 -->
            <div class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                <a href="#">
                    <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/mst.jpg" alt="Magister Terapan"/>
                </a>
                <div class="p-3">
                    <a href="#">
                        <span class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Magister Terapan</span>
                    </a>
                </div>
            </div>

            <!-- Gedung Card 4 -->
            <div class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                <a href="#">
                    <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg" alt="Gedung Sekolah A"/>
                </a>
                <div class="p-3">
                    <a href="#">
                        <span class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung Sekolah A</span>
                    </a>
                </div>
            </div>

            <!-- Gedung Card 5 -->
            <div class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                <a href="#">
                    <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg" alt="Gedung Sekolah B"/>
                </a>
                <div class="p-3">
                    <a href="#">
                        <span class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung Sekolah B</span>
                    </a>
                </div>
            </div>

            <!-- Gedung Card 6 -->
            <div class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                <a href="#">
                    <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg" alt="Gedung Sekolah C"/>
                </a>
                <div class="p-3">
                    <a href="#">
                        <span class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung Sekolah C</span>
                    </a>
                </div>
            </div>
            
            <!-- Gedung Card 7 -->
            <div class="w-[350px] h-[250px] rounded-[20px] shadow dark:bg-gray-200 dark:border-gray-700 flex-shrink-0">
                <a href="#">
                    <img class="gedung w-full h-[200px] rounded-t-[20px]" src="../../Sources/Img/AB.jpg" alt="Gedung Akuntansi"/>
                </a>
                <div class="p-3">
                    <a href="#">
                        <span class="mb-2 text-base font-medium text-center block tracking-tight text-gray-800">Gedung Akuntansi</span>
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
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Previous</span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">1</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">3</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Next</span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
</body>
</html>