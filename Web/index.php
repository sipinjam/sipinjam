<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>SIPINJAM - Login</title>
</head>

<body>
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="flex-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-blue-500 text-center hidden lg:flex flex-col justify-center items-center">
                <div class="">
                    <img src="./Sources/Img/LogoPolines.png" alt="Logo Polines" class="w-32 h-32">
                </div>

                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-2">SIPINJAM</h1>
                    <p class="text-lg">Sistem Peminjaman Tempat</p>
                    <p class="text-lg">Politeknik Negeri Semarang</p>
                </div>

                <div class="mt-10 w-full">
                    <img src="./Sources/Img/loginbg.png" alt="Gambar Gedung" class="w-full h-auto">
                </div>
            </div>

            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div class="mt-12 flex flex-col items-center">
                    <div class="w-full flex-1 mt-8">
                        <div class="my-12 border-b text-center">
                            <div class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2">
                                Sign In with Username
                            </div>
                        </div>

                        <!-- Form login -->
                        <div class="mx-auto max-w-xs">
                            <input
                                id="nama_peminjam"
                                class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="text" placeholder="Username" />
                            <input
                                id="password"
                                class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                type="password" placeholder="Password" />

                            <!-- Pesan error -->
                            <div id="error-message" class="text-red-500 mt-3 hidden">Username atau password salah</div>

                            <button
                                class="mt-5 tracking-wide font-semibold bg-yellow-400 text-white-500 w-full py-4 rounded-lg hover:bg-blue-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none"
                                onclick=login()>
                                <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="8.5" cy="7" r="4" />
                                    <path d="M20 8v6M23 11h-6" />
                                </svg>
                                <span class="ml-">Sign In</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk melakukan login
        function login() {
            const nama_peminjam = document.getElementById('nama_peminjam').value;
            const password = document.getElementById('password').value;

            fetch('http://localhost/sipinjamfix/sipinjam/api/authentications', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        nama_peminjam: nama_peminjam,
                        password: password,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        // Save relevant data to cookies
                        document.cookie = `nama_peminjam=${nama_peminjam}; path=/`; // Example of saving the username
                        // You can save other data as needed
                        document.cookie = `id_peminjam=${data.data.id_peminjam}; path=/`;
                        document.cookie = `id_jenis_peminjam=${data.data.id_jenis_peminjam}; path=/`;
                        document.cookie = `nama_lengkap=${data.data.nama_lengkap}; path=/`;
                        document.cookie = `id_ormawa=${data.data.id_ormawa}; path=/`;

                        // Redirect to home page
                        const currentLocation = window.location.origin + window.location.pathname; // Get the current URL
                        window.location.href = `${currentLocation}/pages/home`;
                    } else {
                        // Handle other responses (e.g., error messages)
                        document.getElementById('error-message').innerText = data.message || "Login failed";
                        document.getElementById('error-message').style.display = 'block';
                    }
                    console.log(response);
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('error-message').innerText = "An error occurred. Please try again.";
                    document.getElementById('error-message').style.display = 'block';
                });
        }
    </script>
</body>

</html>