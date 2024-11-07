<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>Sipinjam</title>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->
    
    <div class="flex">
        <!-- Sidebar -->
        <?php include '../../components/sidebar.php' ?>
        <!-- End Sidebar -->

        <!-- Profile Card -->
        <div class="container p-6 ml-64 mt-8 max-w-9xl">
            <!-- Header -->
            <div class="bg-white rounded-lg mt-10">
                <div class="bg-indigo-700 rounded-t-lg p-8 h-48 flex">
                    <h1 class="text-white font-bold text-3xl">PROFILE</h1>
                </div>

                <!-- Profile Section -->
                <div class="flex items-center m-6 space-x-6 border-b">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center -mt-5 ml-5">
                        <!-- Avatar Icon -->
                        <svg class= "w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/>
                    </svg>
                    </div>
                    <div class="w-full  p-6 items-center text-lg flex justify-between = -mt-8">
                    
                        <div>
                            <p class="text-4xl font-bold" id="namaLengkap">PENGGUNA SIPINJAM</p>
                            <p class="text-base text-gray-500" id="email">sipitmataku@gmail.com</p>
                            <p class="text-base text-gray-500" id="noTelpon">08123456789</p>
                        </div>
                    </div>
                </div>

                <!-- Options -->
                <div class="divide-y divide-gray-300 m-10">
                    <div class="flex items-center justify-between p-6 cursor-pointer hover:bg-gray-100" onclick="window.location.href='../editprofile/index.php'" >
                        <span class="flex gap-5 items-center text-lg">
                        <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>pen [#1320]</title>
                        <desc>Created with Sketch.</desc>
                        <defs>
                    </defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Dribbble-Light-Preview" transform="translate(-140.000000, -2319.000000)" fill="#000000">
                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                    <path d="M86.4570767,2175.58276 L99.6296259,2161.94876 L101.053522,2163.42214 L87.8809728,2177.05714 L86.4570767,2175.58276 Z M99.8259906,2159 L84,2175.58276 L84,2179 L87.8809728,2179 L104,2162.91969 L99.8259906,2159 Z" id="pen-[#1320]">

                    </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <p class="text-base font-bold" id="namaLengkap">Edit Profile</p>
                        </span>
                        <span class="text-gray-500">></span>
                    </div>

                    <div class="flex items-center justify-between p-6 cursor-pointer hover:bg-gray-100">
                        <span class="flex gap-5 items-center text-lg">
                        <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg fill="#000000" width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32.032 16c0-8.501-6.677-15.472-15.072-15.969-0.173-0.019-0.346-0.032-0.523-0.032-0.052 0-0.104 0.005-0.156 0.007-0.093-0.002-0.186-0.007-0.281-0.007-8.84 0-16.032 7.178-16.032 16.001s7.192 16.001 16.032 16.001c0.094 0 0.188-0.006 0.281-0.008 0.052 0.002 0.104 0.008 0.156 0.008 0.176 0 0.349-0.012 0.523-0.032 8.395-0.497 15.072-7.468 15.072-15.969zM29.049 21.151c-0.551-0.16-1.935-0.507-4.377-0.794 0.202-1.381 0.313-2.84 0.313-4.357 0-1.196-0.069-2.354-0.197-3.469 3.094-0.37 4.45-0.835 4.54-0.867l-0.372-1.050c0.695 1.659 1.080 3.478 1.080 5.386 0 1.818-0.352 3.555-0.987 5.151zM8.921 16c0-1.119 0.074-2.212 0.21-3.263 1.621 0.127 3.561 0.222 5.839 0.243v6.939c-2.219 0.021-4.114 0.111-5.709 0.234-0.22-1.319-0.34-2.715-0.34-4.154zM16.967 2.132c2.452 0.711 4.552 4.115 5.492 8.628-1.512 0.12-3.332 0.209-5.492 0.229v-8.857zM14.971 2.156v8.832c-2.136-0.021-3.965-0.109-5.502-0.226 0.96-4.457 3.076-7.836 5.502-8.606zM14.971 21.913l0 7.929c-2.263-0.718-4.256-3.705-5.293-7.719 1.492-0.11 3.253-0.189 5.292-0.21zM16.967 29.868l-0-7.955c2.061 0.020 3.814 0.102 5.288 0.217-1.019 4.067-3 7.076-5.288 7.738zM16.967 19.92l0-6.939c2.291-0.021 4.218-0.118 5.818-0.25 0.131 1.053 0.203 2.147 0.203 3.268 0 1.442-0.116 2.84-0.329 4.16-1.575-0.128-3.462-0.219-5.692-0.24zM28.588 9.81c-0.302 0.094-1.564 0.453-4.094 0.751-0.564-2.998-1.584-5.561-2.91-7.412 3.048 1.325 5.535 3.697 7.005 6.661zM11.213 2.831c-1.632 1.873-2.963 4.568-3.691 7.754-2.265-0.245-3.623-0.534-4.166-0.665 1.585-3.27 4.407-5.836 7.856-7.088zM2.614 11.787c0.385 0.104 1.841 0.467 4.549 0.766-0.155 1.107-0.24 2.26-0.24 3.447 0 1.509 0.136 2.96 0.383 4.334-2.325 0.251-3.755 0.552-4.396 0.706-0.607-1.566-0.944-3.264-0.944-5.041 0-1.467 0.228-2.883 0.649-4.213zM3.784 22.886c0.727-0.154 2.029-0.39 3.956-0.591 0.759 2.803 1.993 5.175 3.473 6.874-3.16-1.148-5.79-3.398-7.429-6.282v0zM21.583 28.849c1.195-1.665 2.14-3.907 2.728-6.525 1.982 0.227 3.226 0.494 3.853 0.652-1.5 2.596-3.808 4.669-6.581 5.873z"></path>
                    </svg>
                    <p class="text-base font-bold" id="namaLengkap">Bahasa</p>
                        </span>
                        <span class="text-gray-500">></span>
                    </div>

                    <!-- FAQ Section -->
<div class="flex items-center justify-between p-6 cursor-pointer hover:bg-gray-100" onclick="window.location.href='../faq/index.php'">
    <span class="flex gap-5 items-center text-lg">
        <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
            <path d="M1662.178 0v1359.964h-648.703l-560.154 560.154v-560.154H0V0h1662.178ZM1511.07 151.107H151.107v1057.75h453.321v346.488l346.489-346.488h560.154V151.107ZM906.794 755.55v117.53H453.32V755.55h453.473Zm302.063-302.365v117.529H453.32V453.185h755.536Z" fill-rule="evenodd"/>
        </svg>
        <p class="text-base font-bold" id="namaLengkap">FAQ</p>
    </span>
    <span class="text-gray-500">></span>
</div>

                </div>
            </div>
        </div>
    </div>

    <!-- Script for fetching user data from API -->
    <script>
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    function fetchUser() {
        // Get the id_user from the cookie
        const idUser  = getCookie('id_peminjam');

        // Check if id_user exists
        if (!idUser ) {
            console.error("User  ID not found in cookies.");
            return; // Exit the function if id_user is not found
        }

        // Fetch user profile using the id_user
        fetch(`http://localhost/sipinjamfix/sipinjam/api/users/${idUser }`)
            .then(response => response.json())
            .then(data => {
                const userData = data.data;
                document.getElementById("namaLengkap").textContent = userData.nama_lengkap;
                document.getElementById("email").textContent = userData.email;
                document.getElementById("noTelpon").textContent = userData.no_telpon;
            })
            .catch(error => console.error("Error fetching user data:", error));
    }

    window.onload = fetchUser;
</script>
</body>
</html>
