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

    <!-- Kalender -->
    <div class="flex justify-evenly items-right py-4 mt-28">
    <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-lg">&lt;</button>
    <h2 class="mx-6 text-2xl font-bold">Oktober</h2>
    <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-lg">&gt;</button>
</div>

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
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
        <div class="text-gray-400">1</div>
        <div class="text-gray-400">2</div>
        <div class="text-gray-400">3</div>
        <div class="text-gray-400">4</div>
        <div class="text-gray-400">5</div>
        <div class="text-gray-400">6</div>
        <div class="text-gray-400">7</div>
        <div>8</div>
        <div>9</div>
        <div>10</div>
        <div>11</div>
        <div>12</div>
        <div>13</div>
        <div>14</div>
        <div>15</div>
        <div class="relative">
            <span>16</span>
            <span class="absolute top-0 left-0 mt-1 ml-6 px-3 py-1 bg-red-500 text-white text-sm rounded toastify-center">Penuh</span>
        </div>
        <div>17</div>
        <div>18</div>
        <div>19</div>
        <div>20</div>
        <div>21</div>
        <div>22</div>
        <div>23</div>
        <div>24</div>
        <div>25</div>
        <div>26</div>
        <div class="relative">
            <span>27</span>
            <span class="absolute top-0 right-0 mt-1 mr-6 px-3 py-1 bg-yellow-400 text-white text-sm rounded">Sesi 2</span>
        </div>
        <div>28</div>
        <div>29</div>
        <div>30</div>
        <div>31</div>
    </div>
</div>



    <!-- End Kalender -->
</body>
</html>