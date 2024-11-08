<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZ88mC6Up2uqSfb8WXG4z9Y6rf8eKFL1RvH6Zj5qJbm7dbpFW1ld9YPC6szgZiY" crossorigin="anonymous">

    <title>Sipinjam</title>
    <style>
        .event-pagi {
            background-color: rgb(241 207 77); /* Warna lingkaran untuk menandai kegiatan */
            color: white;
        }
        .event-siang {
            background-color: rgb(74 222 128); /* Warna lingkaran untuk menandai kegiatan */
            color: white;
        }
        .event-full {
            background-color: rgb(239 68 68); /* Warna lingkaran untuk menandai kegiatan */
            color: white;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->
    
    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>
    
    <!-- Wrapper Keterangan dan Kalender -->
    <div class="flex flex-row md:pl-64 mt-28 space-x-4 mx-4">

        <!-- Kalender -->
        <div class="flex-1 p-6 bg-white rounded-lg shadow">
            <!-- Header Bulan dan Navigasi -->
            <div class="flex justify-center items-center mb-4">
                <button id="prev-month" class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 text-lg">&lt;</button>
                <h2 id="calendar-header" class="mx-6 text-2xl font-bold"></h2>
                <button id="next-month" class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 text-lg">&gt;</button>
            </div>

            <!-- Kalender -->
            <div class="grid grid-cols-7 gap-4 text-center font-semibold text-lg">
                <div>Sunday</div>
                <div>Monday</div>
                <div>Tuesday</div>
                <div>Wednesday</div>
                <div>Thursday</div>
                <div>Friday</div>
                <div>Saturday</div>
            </div>

            <div id="calendar-days" class="grid grid-cols-7 gap-4 mt-4 text-center text-xl">
                <!-- Tanggal akan diisi oleh JavaScript -->
            </div>
        </div>

        <div class="flex flex-col">
            <!-- Keterangan -->
            <div class="p-6 bg-white rounded-lg shadow max-h-max">
                <h2 class="text-lg font-bold mb-2">Keterangan</h2>
                <div class="space-y-2">
                    <div class="bg-red-500 text-white px-4 py-2 rounded-md">Sesi sudah penuh</div>
                    <div class="bg-yellow-400 text-white px-4 py-2 rounded-md">Sesi 1</div>
                    <div class="bg-green-400 text-white px-4 py-2 rounded-md">Sesi 2</div>
                </div>
            </div>

            <div class="w-full h-32">
                <button
                    class="mt-5 tracking-wide font-semibold bg-blue-800 text-white w-full py-4 rounded-lg hover:bg-blue-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none"
                    onclick="window.location.href='../peminjaman/index.php'">
                    <span class="ml-">PINJAM</span>
                </button>
            </div>
        </div>
    </div>

<!-- Elemen Kalender atau Tombol untuk Memicu Modal -->
<button id="open-modal" class="p-2 bg-blue-600 text-white rounded-lg">Buka Modal Kalender</button>

<!-- Modal -->
<div id="event-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md p-6 relative transform transition-transform duration-300 scale-95">
        
        <!-- Close Icon (SVG) -->
        <button id="close-modal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        
        <!-- Icon and Title -->
        <div class="flex items-center mb-3">
            <i class="fa fa-calendar-check-o text-black mr-2" style="font-size:24px;"></i>
            <h2 id="event-title" class="text-2xl font-bold">Event Title</h2>
        </div>
        
        <!-- Event Details -->
        <div class="border-t border-gray-400 mt-2 pt-3">
            <p id="event-details" class="text-black leading-relaxed whitespace-pre-line text-left">Event details go here.</p>
        </div>
    </div>
</div>

<script>
    // Ambil elemen tombol untuk membuka modal dan elemen modal itu sendiri
    const openModalButton = document.getElementById('open-modal');
    const eventModal = document.getElementById('event-modal');
    const closeModalButton = document.getElementById('close-modal');

    // Tambahkan event listener untuk menampilkan modal saat tombol diklik
    openModalButton.addEventListener('click', function() {
        eventModal.classList.remove('hidden');
    });

    // Event listener untuk menutup modal saat tombol "X" diklik
    closeModalButton.addEventListener('click', function() {
        eventModal.classList.add('hidden');
    });

    // Tutup modal jika pengguna mengklik di luar konten modal
    window.addEventListener('click', function(event) {
        if (event.target === eventModal) {
            eventModal.classList.add('hidden');
        }
    });
</script>



    <script>
        let currentDate = new Date();
        let eventDays = [];

        // Fungsi untuk mengambil data peminjaman dari API
        async function fetchDataPeminjaman() {
            try {
                const response = await fetch("http://localhost/sipinjamfix/sipinjam/api/peminjaman");
                const data = await response.json();

                if (data.status === "success") {
                    eventDays = data.data.map(item => ({
                        day: new Date(item.tanggal_kegiatan).getDate(),
                        month: new Date(item.tanggal_kegiatan).getMonth(),
                        year: new Date(item.tanggal_kegiatan).getFullYear(),
                        nama_kegiatan: item.nama_kegiatan,
                        status: item.nama_status,
                        waktuMulai: item.waktu_mulai,
                        waktuSelesai: item.waktu_selesai,
                        nama_ormawa: item.nama_ormawa // Memastikan data Ormawa tersedia
                    }));
                    renderCalendar();
                } else {
                    console.error("Gagal mengambil data:", data.message);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }

        function renderCalendar() {
            const monthNames = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            const calendarHeader = document.getElementById("calendar-header");
            const calendarDays = document.getElementById("calendar-days");
            const eventModal = document.getElementById("event-modal");
            const eventTitle = document.getElementById("event-title");
            const eventDetails = document.getElementById("event-details");
            const closeModal = document.getElementById("close-modal");

            // Set header bulan dan tahun
            calendarHeader.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;

            // Hitung jumlah hari dalam bulan ini
            const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();
            const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();

            // Kosongkan elemen kalender
            calendarDays.innerHTML = "";

            // Tambahkan elemen hari kosong sebelum tanggal 1
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement("div");
                calendarDays.appendChild(emptyDay);
            }

            // Tambahkan elemen untuk setiap hari dalam bulan ini
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement("div");
                dayElement.textContent = day;
                dayElement.classList.add("calendar-day", "relative", "px-3.5", "py-1.5", "rounded-full", "hover:bg-gray-200");

                // Cek apakah tanggal tersebut ada dalam daftar eventDays
                const event = eventDays.find(event => 
                    event.day === day &&
                    event.month === currentDate.getMonth() &&
                    event.year === currentDate.getFullYear()
                );

                if (event) {
                    const waktuMulai = event.waktuMulai;
                    const waktuSelesai = event.waktuSelesai;

                    if (waktuMulai === "08:00:00" && waktuSelesai === "12:00:00") {
                        dayElement.classList.add("event-pagi");
                    } else if (waktuMulai === "12:00:00" && waktuSelesai === "16:00:00") {
                        dayElement.classList.add("event-siang");
                    } else if (waktuMulai === "08:00:00" && waktuSelesai === "16:00:00") {
                        dayElement.classList.add("event-full");
                    }

                    dayElement.addEventListener("click", () => {
                        eventTitle.textContent = `Kegiatan: ${event.nama_kegiatan}`;
                        eventDetails.innerHTML = `
                            Ormawa: ${event.nama_ormawa}<br>
                            Tanggal: ${day} ${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}<br>
                            Waktu: ${waktuMulai} - ${waktuSelesai}<br>
                            Status: ${event.status}
                        `;
                        eventModal.classList.remove("hidden");
                    });
                }

                calendarDays.appendChild(dayElement);
            }

            // Tutup modal
            closeModal.addEventListener("click", () => {
                eventModal.classList.add("hidden");
            });
        }

        // Navigasi bulan
        document.getElementById("prev-month").addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById("next-month").addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        // Inisialisasi kalender dengan data dari API
        fetchDataPeminjaman();
    </script>
</body>
</html>
