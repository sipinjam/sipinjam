<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>Sipinjam</title>

</head>
<body>
    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->
    <!-- sidebar -->
<?php include '../../components/sidebar.php' ?>

    <!-- Keterangan -->
    
    <!-- End Keterangan -->

            <!-- Search Bar dengan posisi sticky -->
            <div class="md:pl-64 z-10 sticky top-20 pt-6 pb-4 mt-28">
            <form class="flex-grow max-w-md mx-auto">
                <div class="relative">
                    <input type="search" id="default-search" 
                        class="w-full p-2 md:p-3 pl-10 text-sm md:text-base text-gray-900 rounded-lg bg-gray-300 placeholder-gray-500"
                        placeholder="Cari Ruangan" required />
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-800 text-white px-4 py-1 rounded-md">Cari</button>
                </div>
            </form>
        </div>


    <!-- Wrapper Kalender -->
    <div class="flex-1 ml-96 max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
        <!-- Header Bulan dan Navigasi -->
        <div class="flex justify-center items-center mb-4">
            <button class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 text-lg">&lt;</button>
            <h2 class="mx-6 text-2xl font-bold">Oktober</h2>
            <button class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-600 text-lg">&gt;</button>
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

        <div class="grid grid-cols-7 gap-4 mt-4 text-center text-xl">
            <div class="relative">
                <span class="bg-red-500 text-white px-3.5 py-1.5 rounded-full">1</span>
            </div>
            <div>2</div>
            <div class="relative">
                <span class="bg-red-500 text-white px-3.5 py-1.5 rounded-full">3</span>
            </div>
            <div>4</div>
            <div>5</div>
            <div>6</div>
            <div>7</div>
            <div>8</div>
            <div>9</div>
            <div>10</div>
            <div class="relative">
                <span class="bg-green-500 text-white px-2.5 py-1.5 rounded-full">11</span>
            </div>
            <div>12</div>
            <div>13</div>
            <div>14</div>
            <div>15</div>
            <div class="relative">
                <span class="bg-red-500 text-white px-2.5 py-1.5 rounded-full">16</span>
            </div>
            <div>17</div>
            <div>18</div>
            <div>19</div>
            <div class="relative">
                <span class="bg-blue-500 text-white px-2.5 py-1.5 rounded-full">20</span>
            </div>
            <div class="relative">
                <span class="bg-blue-500 text-white px-2.5 py-1.5 rounded-full">21</span>
            </div>
            <div>22</div>
            <div>23</div>
            <div>24</div>
            <div>25</div>
            <div>26</div>
            <div class="relative">
                <span class="bg-green-500 text-white px-2.5 py-1.5 rounded-full">27</span>
            </div>
            <div>28</div>
            <div>29</div>
            <div>30</div>
            <div>31</div>
        </div>
    </div>
</div>

    <!-- End Kalender -->
    <div class="mt-6 flex-1 ml-96 max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="p-4 bg-gray-50 rounded-md">
    <h2 class="text-lg font-bold mb-2">Keterangan</h2>
    <div class="space-y-2">
    <div class="bg-red-500 text-white px-4 py-2 rounded-md">Sesi sudah penuh</div>
    <div class="bg-blue-400 text-black px-4 py-2 rounded-md">Sesi 1</div>
    <div class="bg-green-400 text-black px-4 py-2 rounded-md">Sesi 2</div>
    </div>
    </div>

</body>
</html>