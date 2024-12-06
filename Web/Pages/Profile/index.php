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
        <div class="container p-6 ml-64 max-w-9xl">
            <!-- Header -->
            <div class="bg-white rounded-lg mt-10 py-5">
                <div class="bg-indigo-500 rounded-t-lg pl-8 mt-6 pt-10 h-48 flex">
                    <h1 class="text-white font-bold text-3xl">PROFILE</h1>
                </div>

                <!-- Profile Section -->
                <div class="flex items-center mx-10 p-6 space-x-6 border-b">
                    <div class="w-24 h-24 p-6 bg-gray-200 rounded-full flex items-center justify-center -mt-5 ml-5">
                        <!-- Avatar Icon -->
                        <svg class= "w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/>
                    </svg>
                    </div>
                    <div class="w-full  p-6 items-center text-lg flex justify-between = -mt-8">
                    
                        <div>
                            <p class="text-4xl font-bold" id="namaLengkap">PENGGUNA SIPINJAM</p>
                            <p class="text-xl text-gray-500" id="email">sipitmataku@gmail.com</p>
                            <p class="text-xl text-gray-500" id="noTelpon">08123456789</p>
                        </div>
                    </div>
                </div>

                <!-- Options -->
                <div class="divide-y divide-gray-300 mx-10">
                    <div class="flex items-center justify-between p-6 cursor-pointer rounded-lg hover:bg-gray-100" onclick="window.location.href='../editprofile/index.php'" >
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
                    <p class="text-xl font-bold" id="namaLengkap">Edit Profile</p>
                        </span>
                        <span class="text-gray-500">></span>
                    </div>

                    <!-- FAQ Section -->
        <div class="flex items-center justify-between p-6 cursor-pointer rounded-lg hover:bg-gray-100" onclick="window.location.href='../faq/index.php'">
            <span class="flex gap-5 items-center text-lg">
            <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
            <path d="M1662.178 0v1359.964h-648.703l-560.154 560.154v-560.154H0V0h1662.178ZM1511.07 151.107H151.107v1057.75h453.321v346.488l346.489-346.488h560.154V151.107ZM906.794 755.55v117.53H453.32V755.55h453.473Zm302.063-302.365v117.529H453.32V453.185h755.536Z" fill-rule="evenodd"/>
            </svg>
                <p class="text-xl font-bold" id="namaLengkap">FAQ</p>
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
