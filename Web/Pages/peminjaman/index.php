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
    <div
        class="flex pl-44 max-w-6xl mx-auto bg-gray-50 rounded-lg  p-8 pt-24 flex-row items-center justify-center min-h-screen bg-gray-100">

        <!-- Grid Container for Responsive Layout -->
        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

            <!-- Peminjaman Card -->
            <div class="bg-white shadow-lg rounded-lg h-64">
                <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Peminjaman</div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input id="username" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ormawa</label>
                        <select id="ormawa" name="ormawa"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih Ormawa</option>
                            <!-- Options will be added dynamically -->
                        </select>
                    </div>
                </div>
            </div>
            <!-- Ormawa Card -->
            <div class="bg-white shadow-lg rounded-lg h-[36rem]">
                <div class="bg-blue-500 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">Ormawa</div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Ketua HM/UKM</label>
                        <input id="namaKetuaHMUKM" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM Ketua HM/UKM</label>
                        <input id="nimKetuaHMUKM" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Ketua Pelaksana</label>
                        <input id="namaKetuaPelaksana" type="text" placeholder="John Doe"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM Ketua Pelaksana</label>
                        <input id="nimKetuaPelaksana" type="text" placeholder="0.00.00.0.0"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pembina HM/UKM</label>
                        <input id="namaPembinaHMUKM" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIP Pembina HM/UKM</label>
                        <input id="nipPembinaHMUKM" type="text" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-600 shadow-sm cursor-not-allowed">
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
                            <input id="namaKegiatan" type="text" placeholder="Silahkan isi nama kegiatan"
                                class="mt-1 block w-full p-2 border border-red-500 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tema Kegiatan</label>
                            <input id="temaKegiatan" type="text" value=""
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input id="tanggalKegiatan" type="date"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 my-2">Waktu</label>
                            <div class="time-selector">
                                <div class="button-group">
                                    <button
                                        class="time-button flex-1 px-4 border border-blue-500 bg-blue-100 rounded text-blue-500 w-32 h-8">08:00
                                        - 12:00</button>
                                    <button
                                        class="time-button flex-1 px-4 border border-blue-500 bg-blue-100 rounded text-blue-500 w-32 h-8">12:00
                                        - 16:00</button>
                                </div>
                                <button
                                    class="time-button mt-1 flex-1 px-4 border border-blue-500 bg-blue-100 rounded text-blue-500 w-32 h-8">08:00
                                    - 16:00</button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ruangan</label>
                            <input id="ruangan" type="text" value=""
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="justify-between mt-2">
                            <label class="block text-sm font-medium text-gray-900 text-white" for="file_input">Daftar
                                Panitia</label>
                            <input
                                class="block w-full text-sm text-gray-900 rounded-lg border border-gray-300 cursor-pointer text-gray-400 focus:outline-none border-gray-600 placeholder-gray-400"
                                aria-describedby="file_input_help" id="file_input" type="file">

                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-4">
                    <button
                        class="py-2 px-6 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600">Cancel</button>
                    <button
                        class="py-2 px-6 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Fetch `id_ruangan` from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const idRuangan = urlParams.get('id_ruangan');

    if (idRuangan) {
        fetchRoomData(idRuangan);
    }

    async function fetchRoomData(idRuangan) {
        try {
            // Fetch room data based on the provided idRuangan
            const response = await fetch(`http://localhost/sipinjamfix/sipinjam/api/ruangan/${idRuangan}`);
            const result = await response.json();

            if (result.status === "success") {
                const roomData = result.data;

                // Fetch the logged-in user data using the id_peminjam from the cookie
                const idUser = getCookie('id_peminjam');
                if (!idUser) {
                    console.error("User ID not found in cookies.");
                    return;
                }

                // Fetch user profile using the id_user
                const userResponse = await fetch(`http://localhost/sipinjamfix/sipinjam/api/users/${idUser}`);
                const userResult = await userResponse.json();

                if (userResult.status === "success") {
                    const userData = userResult.data;

                    // Populate the form with the fetched user data and room data
                    document.getElementById("username").value = userData
                        .nama_lengkap; // Set the username field with the user's full name
                    document.getElementById("ormawa").value =
                        "Rohani Kristiani Polines"; // Replace with dynamic data if needed

                    document.getElementById("namaKetuaHMUKM").value = "-"; // Empty field for user input
                    document.getElementById("nimKetuaHMUKM").value = "-"; // Empty field for user input
                    document.getElementById("namaKetuaPelaksana").value = ""; // Empty field for user input
                    document.getElementById("nimKetuaPelaksana").value = ""; // Empty field for user input
                    document.getElementById("namaPembinaHMUKM").value = "-"; // Empty field for user input
                    document.getElementById("nipPembinaHMUKM").value = "-"; // Empty field for user input
                    document.getElementById("namaKegiatan").value = ""; // Empty field for user input
                    document.getElementById("temaKegiatan").value = ""; // Empty field for user input

                    document.getElementById("ruangan").value = roomData.nama_ruangan ||
                        ""; // The room name (can be auto-filled)

                    // Now, fetch the Ketua data (from the structure API)
                    //await fetchKetuaData(); // Ensure this is called after setting room data
                } else {
                    console.error("Error fetching user data:", userResult.message);
                }
            } else {
                console.error("Error fetching room data:", result.message);
            }
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }
    // Fetch room data on page load or as needed
    fetchRoomData(idRuangan);

    async function populateOrmawaDropdown() {
        try {
            const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/mahasiswa');
            const result = await response.json();

            if (result.status === "success") {
                const ormawaMembers = result.data;

                // Remove duplicates by id_ormawa
                const uniqueOrmawa = Array.from(new Set(ormawaMembers.map(a => a.id_ormawa)))
                    .map(id_ormawa => {
                        return ormawaMembers.find(a => a.id_ormawa === id_ormawa);
                    });

                const dropdown = document.getElementById('ormawa');

                // Clear existing options
                dropdown.innerHTML = '';

                // Add unique options to dropdown
                uniqueOrmawa.forEach(member => {
                    const option = document.createElement('option');
                    option.value = member.id_ormawa;
                    option.textContent = member.nama_ormawa; // Display the name of Ormawa
                    dropdown.appendChild(option);
                });
            } else {
                console.error("Error fetching Ormawa members:", result.message);
            }
        } catch (error) {
            console.error("Error populating Ormawa dropdown:", error);
        }
    }

    // Fetch Ormawa data when the page loads
    fetchOrmawaData();

    async function fetchOrmawaData() {
        try {
            const response = await fetch('http://localhost/sipinjamfix/sipinjam/api/mahasiswa');
            const result = await response.json();

            if (result.status === "success") {
                const ormawaData = result.data;

                // Populate the Ormawa dropdown
                const dropdown = document.getElementById("ormawa");
                dropdown.innerHTML = ''; // Clear the existing options

                // Add the default "Pilih Ormawa" option
                const defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.textContent = "Pilih Ormawa";
                dropdown.appendChild(defaultOption);

                // Loop through the ormawaData and create an option for each
                ormawaData.forEach(item => {
                    const option = document.createElement("option");
                    option.value = item.id_ormawa; // Set `id_ormawa` as the value
                    option.textContent = item.nama_ormawa; // Display `nama_ormawa` as the option text
                    dropdown.appendChild(option);
                });
            } else {
                console.error("Failed to fetch Ormawa data:", result.message);
            }
        } catch (error) {
            console.error("Error fetching Ormawa data:", error);
        }
    }

    // Event listener to handle Ormawa selection
    document.getElementById('ormawa').addEventListener('change', async function() {
        const selectedOrmawa = this.value; // Get the selected Ormawa ID
        if (selectedOrmawa) {
            await autofillKetuaData(selectedOrmawa);
        }
    });

    async function autofillKetuaData(ormawaId) {
        try {
            // Fetch all members related to the selected Ormawa
            const response = await fetch(
                `http://localhost/sipinjamfix/sipinjam/api/mahasiswa?ormawa_id=${ormawaId}`
            );
            const result = await response.json();

            if (result.status === "success") {
                const ormawaMembers = result.data;

                // Debug log to show fetched members
                console.log("Fetched Ormawa Members:", ormawaMembers);

                const ormawaName = document.getElementById('ormawa').selectedOptions[0].textContent;

                console.log("Selected Ormawa:", ormawaName);

                // Find the Ketua based on the dynamic Ormawa name
                const ketua = ormawaMembers.find(member =>
                    member.nama_ormawa === ormawaName && member.nama_struktur === 'Ketua UKM'
                );

                const pembina = ormawaMembers.find(member =>
                    member.nama_ormawa === ormawaName
                );

                // If needed, log or use the 'ketua' variable
                console.log(ketua);

                console.log(pembina);

                // Debug log to see if the Ketua was found
                console.log("Found Ketua:", ketua);
                console.log("Found Pembina:", pembina);

                if (ketua) {
                    // Autofill the Ketua details
                    document.getElementById("namaKetuaHMUKM").value = ketua.nama_mahasiswa;
                    document.getElementById("nimKetuaHMUKM").value = ketua.nim_mahasiswa;
                } else {
                    console.error("Ketua not found in the selected Ormawa.");
                    clearKetuaFields();
                }

                if (pembina) {
                    // Autofill the Ketua details
                    document.getElementById("namaPembinaHMUKM").value = pembina.nama_pembina;
                    document.getElementById("nipPembinaHMUKM").value = pembina.nip_pembina;
                } else {
                    console.error("Pembina not found in the selected Ormawa.");
                    clearPembinaFields();
                }
            } else {
                console.error("Error fetching Ormawa members:", result.message);
            }
        } catch (error) {
            console.error("Error autofilling Ketua data:", error);
        }
    }

    // Function to clear Ketua fields
    function clearKetuaFields() {
        document.getElementById("namaKetuaHMUKM").value = "-";
        document.getElementById("nimKetuaHMUKM").value = "-";
    }

    function clearPembinaFields() {
        document.getElementById("namaPembinaHMUKM").value = "-";
        document.getElementById("nipPembinaHMUKM").value = "-";
    }

    // Fetch Ormawa data when the page loads
    fetchOrmawaData();

    // Function to get cookies by name
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    // Function to fetch user data based on id_peminjam
    function fetchUser() {
        const idUser = getCookie('id_peminjam');

        // Log the cookie to debug
        console.log("Cookie id_peminjam:", idUser);

        if (!idUser) {
            console.error("User ID not found in cookies.");
            return;
        }

        // Fetch user profile using the id_user
        fetch(`http://localhost/sipinjamfix/sipinjam/api/users/${idUser}`)
            .then(response => response.json())
            .then(data => {
                console.log("API Response:", data); // Log the full response

                // Check if data is present and access the correct user
                const userData = data.data; // Access the user data directly as it is an object

                if (userData) {
                    document.getElementById("nama_lengkap").value = userData.nama_lengkap;
                } else {
                    console.error("No user data found.");
                }
            })
            .catch(error => console.error("Error fetching user data:", error));
    }
    // Call the function to fetch user data and populate the form
    fetchUser();
    </script>
</body>

</html>