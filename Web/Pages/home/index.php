<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPINJAM - Beranda</title>
    <link rel="stylesheet" href="home.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
</head>
<body>

<!-- Rename jadi index.php -->
<!-- edit bagian sidebarnya -->
<!-- Ntar jangan lupa yang home.css dihapus biar tailwindnya nda tabrakan -->
<!-- theme.css itu cuma buat warna -Nicho -->

<div class="container">
    <!-- Sidebar -->
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
                    <a href="#"
                        class="flex items-center p-2 text-white rounded-lg active bg-biru-500 group">
                        <svg class="w-5 h-5 text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 512.001 512.001">
                            <path
                                d="M490.134,185.472L338.966,34.304c-45.855-45.737-120.076-45.737-165.931,0L21.867,185.472   C7.819,199.445-0.055,218.457,0,238.272v221.397C0.047,488.568,23.475,511.976,52.374,512h407.253   c28.899-0.023,52.326-23.432,52.373-52.331V238.272C512.056,218.457,504.182,199.445,490.134,185.472z M448,448H341.334v-67.883   c0-44.984-36.467-81.451-81.451-81.451c0,0,0,0,0,0h-7.765c-44.984,0-81.451,36.467-81.451,81.451l0,0V448H64V238.272   c0.007-2.829,1.125-5.541,3.115-7.552L218.283,79.552c20.825-20.831,54.594-20.835,75.425-0.01c0.003,0.003,0.007,0.007,0.01,0.01   L444.886,230.72c1.989,2.011,3.108,4.723,3.115,7.552V448z" />
                        </svg>
                        <span class="ms-3">Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="../History/"
                        class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white transition duration-75"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="m6,1c0-.553.448-1,1-1h10c.552,0,1,.447,1,1s-.448,1-1,1H7c-.552,0-1-.447-1-1Zm-2,6h16c.552,0,1-.447,1-1s-.448-1-1-1H4c-.552,0-1,.447-1,1s.448,1,1,1Zm20,11c0,3.314-2.686,6-6,6s-6-2.686-6-6,2.686-6,6-6,6,2.686,6,6Zm-2.5,0c0-.553-.447-1-1-1h-1.5v-1.5c0-.553-.447-1-1-1s-1,.447-1,1v1.5h-1.5c-.553,0-1,.447-1,1s.447,1,1,1h1.5v1.5c0,.553.447,1,1,1s1-.447,1-1v-1.5h1.5c.553,0,1-.447,1-1Zm-11.5,0c0-4.418,3.582-8,8-8H5c-2.757,0-5,2.243-5,5v4c0,2.757,2.243,5,5,5h7.709c-1.661-1.466-2.709-3.61-2.709-6Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Riwayat</span>
                    </a>
                </li>
                <li>
                    <a href="../Schedule"
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
                    <a href="../Profile"
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
    <!-- End Sidebar -->

    <!-- Main content -->
    <div class="content">
        <!-- Search bar -->
        <div class="search-bar">
            <input type="text" placeholder="Cari ruangan">
        </div>

        <!-- Daftar Gedung (Horizontal Scroll) -->
        <div class="horizontal-scroll-container">
            <div class="building">
                <img src="../../Sources/Img/AB.jpg" alt="Administrasi Bisnis">
                <p>Administrasi Bisnis</p>
            </div>
            <div class="building">
                <img src="../../Sources/Img/gkt-bg.jpeg" alt="Gedung Kuliah Terpadu">
                <p>Gedung Kuliah Terpadu</p>
            </div>
            <div class="building">
                <img src="../../Sources/Img/mst.jpg" alt="Magister Terapan">
                <p>Magister Terapan</p>
            </div>
            <div class="building">
                <img src="../../Sources/Img/gkt-bg.jpeg" alt="Gedung Kerja Sama">
                <p>Gedung Kerja Sama</p>
            </div>
            <div class="building">
                <img src="../../Sources/Img/gkt-bg.jpeg" alt="Gedung Kerja Sama">
                <p>Gedung Akuntansi</p>
            </div>
            <div class="building">
                <img src="../../Sources/Img/gkt-bg.jpeg" alt="Gedung Kerja Sama">
                <p>Gedung Sekolah A</p>
            </div>
            <div class="building">
                <img src="../../Sources/Img/gkt-bg.jpeg" alt="Gedung Kerja Sama">
                <p>Gedung Sekolah B</p>
            </div>
        </div>

        <!-- Daftar Ruangan (Vertical Scroll) -->
        <div class="room-list">
            <h3>DAFTAR RUANGAN</h3>
            <div class="room-card">
                <img src="../../Sources/Img/gkt-bg.jpeg" alt="GKT Lantai 1">
                <div class="room-info">
                    <h4>GKT Lantai 1</h4>
                    <p>Kapasitas: 300</p>
                    <ul>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">AC</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">WIFI</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">LCD</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">SEAT</p>
                    </ul>
                </div>
            </div>
            <div class="room-card">
                <img src="../../Sources/Img/gkt-bg.jpeg" alt="GKT Lantai 2">
                <div class="room-info">
                    <h4>GKT Lantai 2</h4>
                    <p>Kapasitas: 300</p>
                    <ul>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">AC</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">WIFI</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">LCD</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">SEAT</p>
                    </ul>
                </div>
            </div>
            <div class="room-card">
                <img src="../../Sources/Img/mst.jpg" alt="MST Ruang Seminar">
                <div class="room-info">
                    <h4>MST Ruang Seminar</h4>
                    <p>Kapasitas: 30</p>
                    <ul>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">AC</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">WIFI</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">LCD</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">SEAT</p>
                    </ul>
                </div>
            </div>
            <div class="room-card">
                <img src="../../Sources/Img/mst.jpg" alt="MST III/303">
                <div class="room-info">
                    <h4>MST III/303</h4>
                    <p>Kapasitas: 30</p>
                    <ul>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">AC</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">WIFI</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">LCD</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">SEAT</p>
                    </ul>
                </div>
            </div>
            <div class="room-card">
                <img src="../../Sources/Img/mst.jpg" alt="MST III/304">
                <div class="room-info">
                    <h4>MST III/304</h4>
                    <p>Kapasitas: 30</p>
                    <ul>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">AC</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">WIFI</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">LCD</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">SEAT</p>
                    </ul>
                </div>
            </div>
            <div class="room-card">
                <img src="../../Sources/Img/mst.jpg" alt="MST III/305">
                <div class="room-info">
                    <h4>MST III/305</h4>
                    <p>Kapasitas: 30</p>
                    <ul>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">AC</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">WIFI</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">LCD</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">SEAT</p>
                    </ul>
                </div>
            </div>
            <div class="room-card">
                <img src="../../Sources/Img/mst.jpg" alt="MST III/306">
                <div class="room-info">
                    <h4>MST III/306</h4>
                    <p>Kapasitas: 30</p>
                    <ul>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">AC</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">WIFI</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">LCD</p>
                        <p><img src="../../Sources/Icons/home.png" alt="Home Icon">SEAT</p>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
