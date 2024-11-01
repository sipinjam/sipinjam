<?php
$current_page = basename($_SERVER['REQUEST_URI']);
?>

<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="inline-flex items-center p-2mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-biru-800 dark:bg-biru-800">
        <a href="https://flowbite.com/" class="flex items-center pt-4 ps-8 mb-5">
            <img src="../../Sources/Img/LogoPolines.png" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">SIPINJAM</span>
        </a>
        <ul class="space-y-2 pt-10 font-medium">
            <li>
                <a href="../home/"
                    class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white <?php echo $current_page == 'home' ? 'active bg-biru-500 text-white' : ''; ?>">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white <?php echo $current_page == 'home' ? 'text-white' : 'text-gray-400'; ?>"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 495.398 495.398">
                        <path
                            d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391
				v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158
				c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747
				c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z" />
                        <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401
				c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79
				c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z" />
                    </svg>
                    <span class="ms-3">Beranda</span>
                </a>
            </li>
            <li>
                <a href="../history/"
                    class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white <?php echo $current_page == 'history' ? 'active bg-biru-500 text-white' : ''; ?>">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white <?php echo $current_page == 'history' ? 'text-white' : 'text-gray-400'; ?>"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="m6,1c0-.553.448-1,1-1h10c.552,0,1,.447,1,1s-.448,1-1,1H7c-.552,0-1-.447-1-1Zm-2,6h16c.552,0,1-.447,1-1s-.448-1-1-1H4c-.552,0-1,.447-1,1s.448,1,1,1Zm20,11c0,3.314-2.686,6-6,6s-6-2.686-6-6,2.686-6,6-6,6,2.686,6,6Zm-2.5,0c0-.553-.447-1-1-1h-1.5v-1.5c0-.553-.447-1-1-1s-1,.447-1,1v1.5h-1.5c-.553,0-1,.447-1,1s.447,1,1,1h1.5v1.5c0,.553.447,1,1,1s1-.447,1-1v-1.5h1.5c.553,0,1-.447,1-1Zm-11.5,0c0-4.418,3.582-8,8-8H5c-2.757,0-5,2.243-5,5v4c0,2.757,2.243,5,5,5h7.709c-1.661-1.466-2.709-3.61-2.709-6Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Riwayat</span>
                </a>
            </li>
            <li>
                <a href="../kalender/"
                    class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white <?php echo $current_page == 'kalender' ? 'active bg-biru-500 text-white' : ''; ?>">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white <?php echo $current_page == 'Schedule' ? 'text-white' : 'text-gray-400'; ?>"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24,5v3H0v-3c0-1.654,1.346-3,3-3h3V0h2V2h8V0h2V2h3c1.654,0,3,1.346,3,3Zm0,12c0,3.86-3.141,7-7,7s-7-3.14-7-7,3.141-7,7-7,7,3.14,7,7Zm-4.293,1.293l-1.707-1.707v-2.586h-2v3.414l2.293,2.293,1.414-1.414Zm-11.707-1.293c0-2.829,1.308-5.35,3.349-7H0v14H11.349c-2.041-1.65-3.349-4.171-3.349-7Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Cek Ketersediaan</span>
                </a>
            </li>
            <li>
                <a href="../Profile/"
                    class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white <?php echo $current_page == 'Profile' ? 'active bg-biru-500 text-white' : ''; ?>">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white <?php echo $current_page == 'Profile' ? 'text-white' : 'text-gray-400'; ?>"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Profil</span>
                </a>
            </li>
            <li onclick="logout()">
                <a href=""
                    class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white transition duration-75"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.2929 14.2929C16.9024 14.6834 16.9024 15.3166 17.2929 15.7071C17.6834 16.0976 18.3166 16.0976 18.7071 15.7071L21.6201 12.7941C21.6351 12.7791 21.6497 12.7637 21.6637 12.748C21.87 12.5648 22 12.2976 22 12C22 11.7024 21.87 11.4352 21.6637 11.252C21.6497 11.2363 21.6351 11.2209 21.6201 11.2059L18.7071 8.29289C18.3166 7.90237 17.6834 7.90237 17.2929 8.29289C16.9024 8.68342 16.9024 9.31658 17.2929 9.70711L18.5858 11H13C12.4477 11 12 11.4477 12 12C12 12.5523 12.4477 13 13 13H18.5858L17.2929 14.2929Z" />
                        <path
                            d="M5 2C3.34315 2 2 3.34315 2 5V19C2 20.6569 3.34315 22 5 22H14.5C15.8807 22 17 20.8807 17 19.5V16.7326C16.8519 16.647 16.7125 16.5409 16.5858 16.4142C15.9314 15.7598 15.8253 14.7649 16.2674 14H13C11.8954 14 11 13.1046 11 12C11 10.8954 11.8954 10 13 10H16.2674C15.8253 9.23514 15.9314 8.24015 16.5858 7.58579C16.7125 7.4591 16.8519 7.35296 17 7.26738V4.5C17 3.11929 15.8807 2 14.5 2H5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<script>
function logout() {
    // Hapus data di localStorage
    localStorage.removeItem('nama_peminjam');
    localStorage.removeItem('loggedIn');

    // Alihkan pengguna ke halaman login
    window.location.href = '/sipinjamfix/sipinjam/web/pages/login';
}
</script>