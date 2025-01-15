<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Sipinjam</title>
</head>

<body class="flex flex-col items-center">
    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>

    <!-- Wrapper Keterangan dan Kalender -->
    <div class="flex flex-row md:pl-64 mt-28 space-x-4 mx-4">
        <div class="flex flex-col">
            <div class="mb-4 flex flex-row gap-2">
                <div class="relative" id="dropdownGedungButton">
                    <div id="buttonGedung" onclick="toggleDropdown('dropdownGedung')" class="flex justify-between items-center w-[300px] border-solid border-gray-300 border-[1px] px-5 py-2 rounded cursor-pointer bg-white shadow-sm">
                        --Gedung--

                        <svg fill="#000000" height="10px" width="10px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 330 330" xml:space="preserve">
                            <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393
                            c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393
                            s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z" />
                        </svg>
                    </div>

                    <div id="dropdownGedung" class="rounded border-[1px] border-gray-300 bg-white absolute top-[50px] w-[300px] shadow-rd hidden z-50">
                    </div>
                </div>
                <div class="relative" id="dropdownRuanganButton">
                    <div id="buttonRuangan" onclick="toggleDropdown('dropdownRuangan')" class="flex justify-between items-center w-[300px] border-solid border-gray-300 border-[1px] px-5 py-2 rounded cursor-pointer bg-white shadow-sm">
                        --Ruangan--

                        <svg fill="#000000" height="10px" width="10px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 330 330" xml:space="preserve">
                            <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393
                            c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393
                            s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z" />
                        </svg>
                    </div>

                    <div id="dropdownRuangan" class="rounded border-[1px] text-center border-gray-300 bg-white absolute top-[50px] w-[300px] shadow-rd hidden z-50">
                        <div class="p-3">
                            Pilih gedung terlebih dahulu
                        </div>
                    </div>
                </div>
                <button onclick="handleSearchRoom()" class="w-full bg-blue-500 text-white p-2 rounded w-1/4 h-10">Search</button>
            </div>

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

                <div id="event-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300">
                    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md p-6 relative transform transition-transform duration-300 scale-95"> <button id="close-modal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 z-10"> <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg> </button>
                        <div class="flex items-center mb-3"> <i class="fa fa-calendar-check-o text-black mr-2" style="font-size:24px;"></i>
                            <h2 id="event-title" class="text-2xl font-bold">Event Title</h2>
                        </div>
                        <div class="border-t border-gray-400 mt-2 pt-3">
                            <p id="event-details" class="text-black leading-relaxed whitespace-pre-line text-left">Event details go here.</p>
                        </div>
                    </div>
                </div>
                <div id="loading" class="hidden text-center text-blue-500">Loading...</div>
                <div id="error" class="hidden text-center text-red-500">Failed to fetch data. Please try again.</div>
            </div>

            <!-- Keterangan -->
            <div class="p-6 bg-white rounded-lg shadow max-h-max mt-4">
                <h2 class="text-lg font-bold mb-2">Keterangan</h2>
                <div class="space-y-2">
                    <div class="bg-red-500 text-white px-4 py-2 rounded-md">Sesi Sudah Penuh</div>
                    <div class="bg-yellow-400 text-white px-4 py-2 rounded-md">Sesi 1</div>
                    <div class="bg-green-400 text-white px-4 py-2 rounded-md">Sesi 2</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Snackbar -->
    <div id="snackbar" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white px-4 py-2 rounded shadow-md hidden z-50">
        <span id="snackbar-message"></span>
    </div>

    <!-- Modal Event -->
    <div id="event-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-md p-6 relative">
            <button id="close-modal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 z-10">
                <i class="fas fa-times"></i>
            </button>
            <h2 id="event-title" class="text-2xl font-bold mb-4"></h2>
            <p id="event-details" class="text-black leading-relaxed whitespace-pre-line"></p>
        </div>
    </div>

    <script>
        let ruanganData = [];
        let selectedRoomName = "";
        // api gedung
        async function gedungApiItems() {
            const apiURL = 'http://localhost/sipinjamfix/sipinjam/api/gedung';
            try {
                const response = await fetch(apiURL);
                const data = await response.json();

                if (data.status === "success") {
                    const gedungList = data.data.map(item => item.nama_gedung);
                    populateDropdown('dropdownGedung', gedungList, 'buttonGedung');
                } else {
                    console.error("API error: ", data.message);
                }
            } catch (error) {
                console.error("Error fetching dropdown items:", error);
            }
        }

        // api ruangan
        async function ruanganApiItems() {
            const apiURL = 'http://localhost/sipinjamfix/sipinjam/api/ruangan';
            try {
                const response = await fetch(apiURL);
                const data = await response.json();

                if (data.status === "success") {
                    ruanganData = data.data;
                } else {
                    console.error("API error: ", data.message);
                }
            } catch (error) {
                console.error("Error fetching dropdown items:", error);
            }
        }

        function populateDropdown(dropdownId, item, buttonId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.innerHTML = "";

            item.forEach(item => {
                const div = document.createElement("div");
                div.className = "cursor-pointer text-start hover:bg-gray-300 p-3";
                div.textContent = item;
                div.onclick = () => selectItem(buttonId, dropdownId, item);
                dropdown.appendChild(div);
            });
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle("hidden");
        }

        function selectItem(buttonId, dropdownId, name) {
            const button = document.getElementById(buttonId);
            button.firstChild.textContent = name;
            toggleDropdown(dropdownId);

            if (dropdownId === 'dropdownGedung') {
                const filteredRuangan = ruanganData
                    .filter(item => item.nama_gedung === name)
                    .map(item => item.nama_ruangan);
                populateDropdown('dropdownRuangan', filteredRuangan, 'buttonRuangan');
            } else if (dropdownId === 'dropdownRuangan') {
                selectedRoomName = name;
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            gedungApiItems();
            ruanganApiItems();
        });

        // api for peminjaman calendar
        let currentDate = new Date();
        let eventDays = [];
        let allEvents = [];

        function getColor(sesi) {
            if (sesi === '1') {
                return 'rgb(241, 207, 77)';
            } else if (sesi === '2') {
                return 'rgb(74, 222, 128)';
            } else if (sesi === '3') {
                return 'rgb(239, 68, 68)';
            }
        }

        async function fetchDataPeminjaman(roomName) {
            try {
                const response = await fetch("http://localhost/sipinjamfix/sipinjam/api/peminjaman");
                const data = await response.json();

                console.log("API Response:", data); // Debugging data API

                if (data.status === "success") {
                    allEvents = data.data
                        .filter(item =>
                            item.nama_ruangan.toLowerCase() === roomName.toLowerCase() &&
                            item.nama_status !== "ditolak"
                        )
                        .map(item => ({
                            day: new Date(item.tgl_peminjaman).getDate() - 1,
                            month: new Date(item.tgl_peminjaman).getMonth() + 1,
                            year: new Date(item.tgl_peminjaman).getFullYear(),
                            nama_ruangan: item.nama_ruangan,
                            nama_kegiatan: item.nama_kegiatan,
                            status: item.nama_status,
                            sesi: item.sesi_peminjaman,
                            nama_ormawa: item.nama_ormawa,
                        }));

                    console.log("Filtered Event Days:", allEvents); // Debugging hasil filter dan mapping

                    updateCalendarColors(allEvents);
                } else {
                    console.error("API Error:", data.message); // Menangani error API
                }
            } catch (error) {
                console.error("Fetch Error:", error); // Menangani error saat fetching
            }
        }

        const monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        function renderCalendar() {
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
                dayElement.dataset.date = new Date(currentDate.getFullYear(), currentDate.getMonth(), day).toISOString().split('T')[0];
                calendarDays.appendChild(dayElement);
            }

            updateCalendarColors(allEvents);

            // Tutup modal
            closeModal.addEventListener("click", () => {
                eventModal.classList.add("hidden");
            });

            window.addEventListener('click', function(event) {
                if (event.target === eventModal) {
                    eventModal.classList.add("hidden");
                }
            })
        }

        function updateCalendarColors(events) {
            const calendarDays = document.getElementById('calendar-days').children;
            const today = new Date();

            for (let dayElement of calendarDays) {
                const dateString = dayElement.dataset.date;

                // Mencari event yang cocok berdasarkan tanggal
                const eventsForDay = events.filter(event =>
                    dateString === `${event.year}-${event.month.toString().padStart(2, '0')}-${event.day.toString().padStart(2, '0')}`
                );

                if (eventsForDay.length > 0) {
                    const eventDate = new Date(`${eventsForDay[0].year}-${eventsForDay[0].month}-${eventsForDay[0].day + 1}`);
                    let color;

                    // Cek jika tanggal kegiatan sudah lewat
                    if (eventDate < today) {
                        color = "rgb(30, 64, 175)"; // Warna biru
                    } else if (eventsForDay.length > 1 || eventsForDay.some(event => event.sesi == '3')) {
                        // Cek jika ada lebih dari satu event atau terdapat sesi '3'
                        color = "rgb(239, 68, 68)"; // Warna merah
                    } else {
                        // Jika hanya ada satu event
                        color = getColor(eventsForDay[0].sesi);
                    }

                    dayElement.style.backgroundColor = color;
                    dayElement.style.cursor = 'pointer';

                    // Bersihkan marker sebelumnya
                    dayElement.innerHTML = dayElement.innerHTML.split('<div')[0];

                    dayElement.addEventListener("click", () => {
                        document.getElementById('event-modal').classList.remove('hidden');
                        document.getElementById('event-title').textContent = eventsForDay.map(event => event.nama_kegiatan).join(', ');
                        document.getElementById('event-details').textContent = eventsForDay.map(event => `
Nama Ruangan: ${event.nama_ruangan}
Ormawa: ${event.nama_ormawa}
Status: ${event.status}
Sesi: ${event.sesi}`).join('\n\n');
                    });
                }
            }
        }

        async function handleSearchRoom() {
            clearDataPeminjam();
            const selectedGedung = document.getElementById("buttonGedung").textContent.trim();
            if (selectedGedung === "--Gedung--" || selectedRoomName === "") {
                showSnackbar("Harap pilih gedung dan ruangan terlebih dahulu.");
            } else {
                showSnackbar(`Menampilkan data untuk ${selectedRoomName}.`);
                
                await fetchDataPeminjaman(selectedRoomName);
            }
        }

        function clearDataPeminjam() {
    const calendarDays = document.getElementById('calendar-days').children;
    for (let dayElement of calendarDays) {
        dayElement.style.backgroundColor = ""; // Hapus warna background
        dayElement.style.cursor = ""; // Reset pointer
        dayElement.removeEventListener("click", () => {}); // Hapus event listener
    }

    const eventModal = document.getElementById("event-modal");
    if (eventModal) {
        eventModal.classList.add("hidden"); // Tutup modal event jika terbuka
    }
}

        // Navigasi bulan
        document.getElementById("prev-month").addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
            if (selectedRoomName) searchRoom();
        });

        document.getElementById("next-month").addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
            if (selectedRoomName) searchRoom();
        });

        // Inisialisasi kalender
        renderCalendar();

        // Fungsi Snackbar
        function showSnackbar(message) {
            const snackbar = document.getElementById('snackbar');
            const snackbarMessage = document.getElementById('snackbar-message');

            snackbarMessage.textContent = message;
            snackbar.classList.remove('hidden');
            setTimeout(() => {
                snackbar.classList.add('hidden');
            }, 3000);
        }

        // Fungsi lainnya (Kalender, Dropdown, dll.)
        // Contoh memanggil snackbar setelah pemilihan gedung:
        function searchRoom() {
            const selectedGedung = document.getElementById("buttonGedung").textContent.trim();
            if (selectedGedung === "--Gedung--") {
                showSnackbar("Harap pilih gedung dan ruangan terlebih dahulu.");
            } else {
                showSnackbar(`Menampilkan data untuk ${selectedRoomName}.`);
            }
        }
    </script>

</body>

</html>