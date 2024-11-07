<!-- Header -->
<div class="md:pl-64 w-full h-auto bg-biru-800 px-4 py-2 shadow-md fixed top-0 z-10">
    <div class="flex items-center justify-between max-w-screen-xl mx-auto gap-x-3 flex-wrap md:flex-nowrap">
        <!-- Bagian Kiri (bisa diisi dengan logo atau menu lainnya) -->
        <div class="flex items-center space-x-3">
            <!-- Add any left-aligned content here -->
        </div>

        <!-- Search Bar -->
        <div class="flex-grow max-w-md mx-auto" id="searchForm">
            <form class="flex flex-row gap-2 items-center">
                <input type="search" id="default-search"
                    class="w-full p-2 md:p-3 pl-10 text-sm md:text-base text-gray-900 rounded-lg bg-gray-300 placeholder-gray-500"
                    placeholder="Cari Gedung atau Ruangan" required />
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

<!-- JavaScript untuk Mengontrol Tampilan Search Bar -->
<script>
    // Daftar halaman yang diizinkan menampilkan search bar
    const allowedPages = [
        "http://localhost/sipinjamfix/sipinjam/Web/Pages/home/",
        "http://localhost/sipinjamfix/sipinjam/Web/Pages/daftarRuangan/",
        "http://localhost/sipinjamfix/sipinjam/Web/Pages/kalender/"
    ];

    // Cek apakah URL saat ini ada di daftar halaman yang diizinkan
    const currentUrl = window.location.href.toLowerCase();
    
    // Sembunyikan search bar jika URL mengandung parameter `search` saja (tanpa `id_gedung`)
    if (currentUrl.includes("daftarruangan") && currentUrl.includes("search=") && !currentUrl.includes("id_gedung=")) {
        document.getElementById("searchForm").style.display = "none";
    } else {
        // Tampilkan search bar jika halaman berada di daftar allowedPages
        const isAllowedPage = allowedPages.some(page => currentUrl.startsWith(page.toLowerCase()));
        if (!isAllowedPage) {
            document.getElementById("searchForm").style.display = "none";
        }
    }

    // Menambahkan event listener pada form pencarian
    document.querySelector('form').addEventListener('submit', async function (event) {
        event.preventDefault(); // Menghentikan form submit default

        // Ambil nilai pencarian dari input
        const searchQuery = document.getElementById('default-search').value.trim().toLowerCase();

        if (!searchQuery) {
            alert("Masukkan nama gedung atau ruangan yang ingin dicari.");
            return;
        }

        try {
            // Fetch data dari API ruangan
            const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/ruangan');
            const data = await response.json();

            // Log data dari API untuk debugging
            console.log("Data dari API:", data);

            // Periksa apakah status dari API sukses
            if (data.status === "success") {
                // Cari apakah ada kecocokan berdasarkan nama gedung
                const gedungMatch = data.data.find(ruangan => ruangan.nama_gedung.toLowerCase() === searchQuery);

                // Cari kecocokan berdasarkan nama ruangan
                const ruanganMatch = data.data.filter(ruangan => ruangan.nama_ruangan.toLowerCase() === searchQuery);

                // Log hasil pencarian untuk debugging
                console.log("Gedung Match:", gedungMatch);
                console.log("Ruangan Match:", ruanganMatch);

                // Cek kecocokan gedung atau ruangan
                if (gedungMatch) {
                    // Redirect ke halaman daftarRuangan dengan parameter id_gedung jika gedung ditemukan
                    window.location.href = `http://localhost/sipinjamfix/sipinjam/Web/Pages/daftarRuangan/?id_gedung=${gedungMatch.id_gedung}`;
                } else if (ruanganMatch.length > 0) {
                    // Redirect ke halaman daftarRuangan dengan query nama_ruangan jika ruangan ditemukan
                    window.location.href = `http://localhost/sipinjamfix/sipinjam/Web/Pages/daftarRuangan/?search=${encodeURIComponent(searchQuery)}`;
                } else {
                    alert("Gedung atau ruangan yang dicari tidak ditemukan.");
                }

                // Kosongkan input search setelah submit berhasil
                document.getElementById('default-search').value = '';
            } else {
                alert("Gagal mengambil data dari server.");
            }
        } catch (error) {
            console.error("Error fetching data:", error);
            alert("Terjadi kesalahan saat mengakses data. Silakan coba lagi.");
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