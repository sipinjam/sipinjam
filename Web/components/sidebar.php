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
    <div class="h-full px-3 py-4 overflow-y-auto bg-biru-800">
        <a href="https://flowbite.com/" class="flex items-center pt-4 ps-8 mb-5">
            <img src="../../Sources/Img/LogoPolines.png" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap text-white">SIPINJAM</span>
        </a>
        <ul class="space-y-2 pt-10 font-medium">
            <li>
                <a href="../home/"
                    class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white <?php echo $current_page == 'home' ? 'active bg-biru-500 text-white' : ''; ?>">
                    <svg class="w-6 h-6 transition duration-75 group-hover:text-white <?php echo $current_page == 'home' ? 'text-white' : 'text-gray-400'; ?>"
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
                <a href="../peminjaman/"
                    class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white <?php echo $current_page == 'peminjaman' ? 'active bg-biru-500 text-white' : ''; ?>">
                    <svg class="w-6 h-6 transition duration-75 group-hover:text-white <?php echo $current_page == 'peminjaman' ? 'text-white' : 'text-gray-400'; ?>"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.06935 5.00839C2 5.37595 2 5.81722 2 6.69975V13.75C2 17.5212 2 19.4069 3.17157 20.5784C4.34315 21.75 6.22876 21.75 10 21.75H14C17.7712 21.75 19.6569 21.75 20.8284 20.5784C22 19.4069 22 17.5212 22 13.75V11.5479C22 8.91554 22 7.59935 21.2305 6.74383C21.1598 6.66514 21.0849 6.59024 21.0062 6.51946C20.1506 5.75 18.8345 5.75 16.2021 5.75H15.8284C14.6747 5.75 14.0979 5.75 13.5604 5.59678C13.2651 5.5126 12.9804 5.39471 12.7121 5.24543C12.2237 4.97367 11.8158 4.56578 11 3.75L10.4497 3.19975C10.1763 2.92633 10.0396 2.78961 9.89594 2.67051C9.27652 2.15704 8.51665 1.84229 7.71557 1.76738C7.52976 1.75 7.33642 1.75 6.94975 1.75C6.06722 1.75 5.62595 1.75 5.25839 1.81935C3.64031 2.12464 2.37464 3.39031 2.06935 5.00839ZM12 11C12.4142 11 12.75 11.3358 12.75 11.75V13H14C14.4142 13 14.75 13.3358 14.75 13.75C14.75 14.1642 14.4142 14.5 14 14.5H12.75V15.75C12.75 16.1642 12.4142 16.5 12 16.5C11.5858 16.5 11.25 16.1642 11.25 15.75V14.5H10C9.58579 14.5 9.25 14.1642 9.25 13.75C9.25 13.3358 9.58579 13 10 13H11.25V11.75C11.25 11.3358 11.5858 11 12 11Z" />
                    </svg>
                    <span class="ms-3">Peminjaman</span>
                </a>
            </li>
            <li id="kotakMasuk">
                <a href="../kotakMasuk/"
                    class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white <?php echo $current_page == 'kotakMasuk' ? 'active bg-biru-500 text-white' : ''; ?>">
                    <svg class="w-6 h-6 transition duration-75 group-hover:text-white <?php echo $current_page == 'kotakMasuk' ? 'text-white' : 'text-gray-400'; ?>"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7 2L6.93417 2C6.04769 1.99995 5.28387 1.99991 4.67221 2.08215C4.0167 2.17028 3.38835 2.36902 2.87868 2.87868C2.36902 3.38835 2.17028 4.0167 2.08215 4.67221C1.99991 5.28387 1.99995 6.04769 2 6.93417L2 7L2 17.0658C1.99995 17.9523 1.99991 18.7161 2.08215 19.3278C2.17028 19.9833 2.36902 20.6117 2.87868 21.1213C3.38835 21.631 4.0167 21.8297 4.67221 21.9179C5.28388 22.0001 6.0477 22.0001 6.9342 22H17.0658C17.9523 22.0001 18.7161 22.0001 19.3278 21.9179C19.9833 21.8297 20.6117 21.631 21.1213 21.1213C21.631 20.6117 21.8297 19.9833 21.9179 19.3278C22.0001 18.7161 22.0001 17.9523 22 17.0658V6.9342C22.0001 6.0477 22.0001 5.28388 21.9179 4.67221C21.8297 4.0167 21.631 3.38835 21.1213 2.87868C20.6117 2.36902 19.9833 2.17028 19.3278 2.08215C18.7161 1.99991 17.9523 1.99995 17.0658 2L7 2ZM5 14C4.44772 14 4 14.4477 4 15C4 15.5523 4.44772 16 5 16H5.92963C6.26399 16 6.57622 16.1671 6.76168 16.4453L7.57422 17.6641C8.13061 18.4987 9.06731 19 10.0704 19H13.9296C14.9327 19 15.8694 18.4987 16.4258 17.6641L17.2383 16.4453C17.4238 16.1671 17.736 16 18.0704 16H19C19.5523 16 20 15.5523 20 15C20 14.4477 19.5523 14 19 14H18.0704C17.0673 14 16.1306 14.5013 15.5742 15.3359L14.7617 16.5547C14.5762 16.8329 14.264 17 13.9296 17H10.0704C9.73601 17 9.42378 16.8329 9.23832 16.5547L8.42578 15.3359C7.86939 14.5013 6.93269 14 5.92963 14H5ZM13 11.0858L13.7929 10.2929C14.1834 9.90237 14.8166 9.90237 15.2071 10.2929C15.5976 10.6834 15.5976 11.3166 15.2071 11.7071L13.2071 13.7071C12.5404 14.3738 11.4596 14.3738 10.7929 13.7071L8.79289 11.7071C8.40237 11.3166 8.40237 10.6834 8.79289 10.2929C9.18342 9.90237 9.81658 9.90237 10.2071 10.2929L11 11.0858V8C11 7.44772 11.4477 7 12 7C12.5523 7 13 7.44772 13 8V11.0858Z" />
                    </svg>
                    <span class="ms-3">Kotak Masuk</span>
                </a>
            </li>
            <li>
                <a href="../history/"
                    class="flex items-center p-2 text-gray-400 rounded-lg hover:bg-gray-700 group hover:text-white <?php echo $current_page == 'history' ? 'active bg-biru-500 text-white' : ''; ?>">
                    <svg class="w-6 h-6 transition duration-75 group-hover:text-white <?php echo $current_page == 'history' ? 'text-white' : 'text-gray-400'; ?>"
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
                    <svg class="w-6 h-6 transition duration-75 group-hover:text-white <?php echo $current_page == 'kalender' ? 'text-white' : 'text-gray-400'; ?>"
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
                    <svg class="w-6 h-6 transition duration-75 group-hover:text-white <?php echo $current_page == 'Profile' ? 'text-white' : 'text-gray-400'; ?>"
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
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white transition duration-75"
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
function checkCookie() {
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    const idJenisPeminjamCookie = getCookie('id_jenis_peminjam');

    if (idJenisPeminjamCookie == 1) {
        document.getElementById("kotakMasuk").style.display = "block";
    } else {
        document.getElementById("kotakMasuk").style.display = "none";
    }

    const namaPeminjamCookie = getCookie('nama_peminjam');
    if (!namaPeminjamCookie) {
        window.location.href = '/sipinjamfix/sipinjam/web';
    }
}

checkCookie();

function logout() {
    document.cookie = "nama_peminjam=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "id_peminjam=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "id_jenis_peminjam=;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    window.location.href = '/pages/login';
}
</script>