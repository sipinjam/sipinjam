<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>SIPINJAM</title>
</head>

<body>

    <!-- Sidebar -->
    <?php include '../../Components/sidebar.php'; ?>
    <!-- End Sidebar -->

    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

    <!-- Main Menu -->
    <div class="flex-grow p-10 pt-[120px] sm:ml-64 overflow-x-auto">
        <div class="flex space-x-4">     
            <div class="block max-w-m p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">150</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Total Peminjaman</p>
            </div>
            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">30</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Pending</p>
            </div>
        </div>
    </div>          

    <!--Charts -->
    <div class="w-[600px] h-[400px] bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mx-auto">
    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
      <div class="flex items-center">
        <!-- Dropdown menu -->
        <div class="relative">
            <button id="dropdownDefaultButton" class="text-lg font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white" type="button">
              Tahun 2024
              <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
              </svg>
            </button>
            <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 absolute right-0 top-full mt-2">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                      <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tahun 2024</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tahun 2023</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tahun 2022</a>
                      </li>
                      <li>
                    </ul>
            </div>
        </div>
      </div>
      <div>
        <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
          42.5%
        </span>
      </div>
    </div>

    <div class="grid grid-cols-2">
      <dl class="flex items-center">
        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal mr-1">Money spent:</dt>
        <dd class="text-gray-900 text-sm dark:text-white font-semibold">$3,232</dd>
      </dl>
      <dl class="flex items-center justify-end">
        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal mr-1">Conversion rate:</dt>
        <dd class="text-gray-900 text-sm dark:text-white font-semibold">1.2%</dd>
      </dl>
    </div>

    <div id="column-chart" class="my-0"></div>
  </div>

  <script>
    // Dropdown toggle logic
    document.getElementById("dropdownDefaultButton").addEventListener("click", function() {
      const dropdown = document.getElementById("lastDaysdropdown");
      dropdown.classList.toggle("hidden");
    });
    const options = {
      colors: ["#9DBDFF"],
      series: [
        {
          name: "Peminjam   ",
          color: "#9DBDFF",
          data: [
            { x: "Januari", y: 231 },
            { x: "Februari", y: 122 },
            { x: "Maret", y: 63 },
            { x: "April", y: 421 },
            { x: "Mei", y: 122 },
            { x: "Juni", y: 323 },
            { x: "Juli", y: 111 },
            { x: "Agustus", y: 231 },
            { x: "September", y: 122 },
            { x: "Oktober", y: 63 },
            { x: "November", y: 421 },
            { x: "Desember", y: 122 },
          ],
        },
      ],
      chart: {
        type: "bar",
        height: "320px",
        fontFamily: "Inter, sans-serif",
        toolbar: {
          show: false,
        },
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "70%",
          borderRadiusApplication: "end",
          borderRadius: 8,
        },
      },
      tooltip: {
        shared: true,
        intersect: false,
        style: {
          fontFamily: "Inter, sans-serif",
        },
      },
      states: {
        hover: {
          filter: {
            type: "darken",
            value: 1,
          },
        },
      },
      stroke: {
        show: true,
        width: 0,
        colors: ["transparent"],
      },
      grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
          left: 2,
          right: 2,
          top: -14,
        },
      },
      dataLabels: {
        enabled: false,
      },
      legend: {
        show: false,
      },
      xaxis: {
        floating: false,
        labels: {
          show: true,
          style: {
            fontFamily: "Inter, sans-serif",
            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400',
          },
        },
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
      },
      yaxis: {
        show: false,
      },
      fill: {
        opacity: 1,
      },
    }

    if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
      const chart = new ApexCharts(document.getElementById("column-chart"), options);
      chart.render();
    }
  </script>

</body>
</html>