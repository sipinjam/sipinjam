<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>Edit Profile - Sipinjam</title>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <?php include '../../components/header.php'; ?>
    <!-- End Header -->

    <div class="flex">
        <!-- Sidebar -->
        <?php include '../../components/sidebar.php'; ?>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div class="flex-grow p-8">
            <div class="p-6 ml-64 mt-16 max-w-9xl bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-blue-800 mb-4">Edit Profile</h2>
                <div class="border-t border-gray-200 mb-6"></div>

                <!-- Edit Profile Section -->
                <div class="flex flex-col items-center mb-6">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.6.0 -->
                            <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/>
                        </svg>
                    </div>                   
                </div>

                <form onsubmit="updateUser(event)">
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <div>
                            <label class="text-gray-700">Nama Lengkap</label>
                            <input id="namaLengkap" type="text" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Nama Lengkap">
                        </div>
                        <div>
                            <label class="text-gray-700">Email</label>
                            <input id="email" type="email" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Email">
                        </div>
                        <div>
                            <label class="text-gray-700">No. Telp</label>
                            <input id="noTelpon" type="tel" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="No. Telp">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 mr-2" onclick="window.location.href='../Profile/index.php'">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Main Content -->
    </div>

    <script>
        // Fungsi untuk mendapatkan nilai cookie
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        // Fungsi untuk mengambil data user dan menampilkan di form
        function fetchUser() {
            const idUser = getCookie('id_peminjam'); // Ambil id_user dari cookie

            if (!idUser) {
                console.error("User ID not found in cookies.");
                return;
            }

            // Fetch data user berdasarkan id_user
            fetch(`http://localhost/sipinjamfix/sipinjam/api/users/${idUser}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        const userData = data.data;
                        document.getElementById("namaLengkap").value = userData.nama_lengkap;
                        document.getElementById("email").value = userData.email;
                        document.getElementById("noTelpon").value = userData.no_telpon;
                    } else {
                        console.error("Failed to fetch user data:", data.message);
                    }
                })
                .catch(error => console.error("Error fetching user data:", error));
        }

        // Fungsi untuk mengupdate data user
        function updateUser(event) {
            event.preventDefault(); // Mencegah reload halaman saat form disubmit

            const idUser = getCookie('id_peminjam'); // Ambil id_user dari cookie
            if (!idUser) {
                console.error("User ID not found in cookies.");
                return;
            }

            // Ambil data dari form
            const updatedUser = {
                nama_lengkap: document.getElementById("namaLengkap").value,
                email: document.getElementById("email").value,
                no_telpon: document.getElementById("noTelpon").value
            };

            // Kirim data ke API menggunakan method PATCH
            fetch(`http://localhost/sipinjamfix/sipinjam/api/users/${idUser}`, {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(updatedUser)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert("Profile updated successfully!");
                    window.location.href = "../Profile/index.php"; // Redirect setelah update berhasil
                } else {
                    console.error("Failed to update user:", data.message);
                    alert("Failed to update user. Please try again.");
                }
            })
            .catch(error => console.error("Error updating user:", error));
        }

        // Panggil fungsi fetchUser saat halaman dimuat
        window.onload = fetchUser;
    </script>
</body>
</html>
        