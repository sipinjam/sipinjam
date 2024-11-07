<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>Sipinjam</title>
    <style>
        .event-pagi {
            background-color: rgb(96 165 250); /* Warna lingkaran untuk menandai kegiatan */
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
                    <div class="bg-blue-400 text-white px-4 py-2 rounded-md">Sesi 1</div>
                    <div class="bg-green-400 text-white px-4 py-2 rounded-md">Sesi 2</div>
                </div>
            </div>

            <div class="w-full h-32">
                <button
                    class="mt-5 tracking-wide font-semibold bg-yellow-400 text-white-500 w-full py-4 rounded-lg hover:bg-blue-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none"
                    onclick="window.location.href='../peminjaman/index.php'">
                    <span class="ml-">BOOKING</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="event-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3 p-5">
            <h2 id="event-title" class="text-2xl font-semibold mb-3"></h2>
            <p id="event-details" class="text-gray-700 mb-4"></p>
            <button id="close-modal" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Close
            </button>
        </div>
    </div>

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
                        nama_ormawa: item.nama_status // Memastikan data Ormawa tersedia
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
                            Ormawa: ${event.status}<br>
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
