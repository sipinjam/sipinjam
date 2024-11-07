<!-- Header -->
<div class="md:pl-64 w-full h-auto bg-biru-800 px-4 py-2 shadow-md fixed top-0 z-10">
    <div class="flex items-center justify-between max-w-screen-xl mx-auto gap-x-3 flex-wrap md:flex-nowrap">
        <!-- Bagian Kiri (bisa diisi dengan logo atau menu lainnya) -->
        <div class="flex items-center space-x-3">
            <!-- Add any left-aligned content here -->
        </div>

        <!-- Search Bar (Dimasukkan ke dalam Header) -->
        <div class="flex-grow max-w-md mx-auto" id="searchForm">
            <form class="flex flex-row gap-2 items-center">
                <input type="search" id="default-search"
                    class="w-full p-2 md:p-3 pl-10 text-sm md:text-base text-gray-900 rounded-lg bg-gray-300 placeholder-gray-500"
                    placeholder="Cari Ruangan" required />
                <button type="submit"
                    class="right-2 top-1/2 bg-blue-800 text-white px-4 py-1 rounded-md h-10">
                    Cari
                </button>
            </form>
        </div>

        <!-- Bagian Kanan (ikon dan username) -->
        <div class="ml-auto p-5 flex items-center space-x-3">
            <svg class="w-5 h-5 transition duration-75 group-hover:text-white <?php echo $current_page == 'Profile' ? 'text-white' : 'text-gray-400'; ?>"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path
                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
            </svg>
            <div class="text-white">
                <p class="text-sm md:text-base" id="nama_lengkap"></p>
            </div>
        </div>
    </div>
</div>

<script>
    // Mendefinisikan halaman-halaman di mana search bar akan ditampilkan
    const allowedPages = [
        "http://localhost/sipinjamfix/sipinjam/web/pages/home/",
        "http://localhost/sipinjamfix/sipinjam/web/pages/daftarRuangan/",
        "http://localhost/sipinjamfix/sipinjam/web/pages/kalender/"
    ];

    // Memeriksa apakah URL saat ini ada di dalam daftar allowedPages
    const currentUrl = window.location.href.toLowerCase(); // Mengubah URL saat ini menjadi huruf kecil
    const isAllowedPage = allowedPages.some(page => currentUrl.startsWith(page)); // Mengecek apakah halaman saat ini termasuk dalam daftar

    if (!isAllowedPage) {
        // Sembunyikan search bar jika halaman tidak ada dalam daftar allowedPages
        document.getElementById("searchForm").style.display = "none";
    }

    // Menambahkan event listener pada form pencarian
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Menghentikan form submit default

        // Ambil nilai pencarian dari input
        const searchQuery = document.getElementById('default-search').value.trim();

        // Redirect ke halaman daftarRuangan dengan parameter query search
        if (searchQuery) {
            window.location.href = `http://localhost/sipinjamfix/sipinjam/web/pages/daftarRuangan/?search=${encodeURIComponent(searchQuery)}`;
        } else {
            alert("Masukkan nama gedung atau ruangan yang ingin dicari.");
        }
    });
    function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        // Mengambil cookie 'nama_lengkap'
        const namaLengkap = getCookie('nama_lengkap');

        // Memasukkan nilai cookie ke dalam elemen HTML
        if (namaLengkap) {
            document.getElementById('nama_lengkap').textContent = namaLengkap;
        } else {
            document.getElementById('nama_lengkap').textContent = 'Nama lengkap tidak ditemukan';
        }
</script>