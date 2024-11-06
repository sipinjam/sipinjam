<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Kegiatan</title>
    <link rel="stylesheet" href="../../Public/theme.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen ">

    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>
    <!-- End Sidebar -->

    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

    <!-- Main Content -->
    <div class="flex pl-44 max-w-6xl mx-auto bg-gray-50 rounded-lg  p-8 pt-24 flex-row items-center justify-center min-h-screen bg-gray-100">

        <!-- Grid Container for Responsive Layout -->
        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

            <!-- Peminjaman Card -->
            <div class="bg-white shadow-lg rounded-lg h-64">
                <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Peminjaman</div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" value="PENGGUNA SIPIT" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ormawa</label>
                        <input type="text" value="Rohani Kristiani Polines" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                </div>
            </div>

            <!-- Ormawa Card -->
            <div class="bg-white shadow-lg rounded-lg h-[36rem]">
                <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Ormawa</div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Ketua HM/UKM</label>
                        <input type="text" value="" placeholder=""
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM Ketua HM/UKM</label>
                        <input type="text" value="" placeholder="e.g 4.33.23.0.0"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Ketua Pelaksana</label>
                        <input type="text" value=""
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM Ketua Pelaksana</label>
                        <input type="text" value=""
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pembina HM/UKM</label>
                        <input type="text" value=""
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIP Pembina HM/UKM</label>
                        <input type="text" value=""
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>
            </div>

            <!-- Kegiatan Card -->
            <div class="w-96">
                <div class="bg-white shadow-lg rounded-lg">
                    <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Kegiatan</div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                            <input type="text" placeholder="Silahkan isi nama kegiatan"
                                class="mt-1 block w-full p-2 border border-red-500 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tema Kegiatan</label>
                            <input type="text" value=""
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 my-2">Waktu</label>
                            <div class="time-selector">
                                <div class="button-group">
                                    <button class="time-button flex-1 px-4 border border-blue-500 bg-blue-100 rounded text-blue-500 w-32 h-8">08:00 - 12:00</button>
                                    <button class="time-button flex-1 px-4 border border-blue-500 bg-blue-100 rounded text-blue-500 w-32 h-8">12:00 - 16:00</button>
                                </div>
                                <button class="time-button mt-1 flex-1 px-4 border border-blue-500 bg-blue-100 rounded text-blue-500 w-32 h-8">08:00 - 16:00</button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ruangan</label>
                            <input type="text" value=""
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="justify-between mt-2">
                            <label class="block text-sm font-medium text-gray-900 text-white" for="file_input">Daftar Panitia</label>
                            <input class="block w-full text-sm text-gray-900 rounded-lg border border-gray-300 cursor-pointer text-gray-400 focus:outline-none border-gray-600 placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">

                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-4">
                    <button class="py-2 px-6 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600">Cancel</button>
                    <button class="py-2 px-6 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">Submit</button>
                </div>
            </div>
        </div>
        <!-- Submit & Cancel Buttons -->


    </div>
</body>
<script>
    // Pilih semua tombol dengan kelas 'time-button'
    const timeButtons = document.querySelectorAll('.time-button');

    // Tambahkan event listener untuk setiap tombol
    timeButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Hapus kelas 'selected' dari semua tombol
            timeButtons.forEach(btn => btn.classList.remove('border-blue-500', 'bg-blue-100', 'text-blue-500'));

            // Tambahkan kelas 'selected' pada tombol yang dipilih
            button.classList.add('border-blue-500', 'bg-blue-100', 'text-blue-500');
        });
    });
</script>

</html>