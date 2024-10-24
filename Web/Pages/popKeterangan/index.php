<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Detail Peminjaman</title>
    <style>
        /* Custom styling to hide modal by default */
        .modal {
            display: none;
        }

        /* Show modal when active */
        .modal.active {
            display: flex;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Button to open the modal -->
    <div class="flex justify-center mt-10">
        <button id="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Open Modal</button>
    </div>

    <!-- Modal Structure -->
    <div id="modal" class="modal fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <!-- Header with close button -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-blue-500 font-semibold text-lg">Keterangan</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-800 text-xl">&times;</button>
            </div>
            
            <!-- Textarea for input -->
            <textarea class="w-full h-32 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            
            <!-- Submit button -->
            <div class="flex justify-center mt-4">
                <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Submit</button>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to toggle modal visibility
        const modal = document.getElementById('modal');
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');

        openModalButton.addEventListener('click', () => {
            modal.classList.add('active');
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.remove('active');
        });

        // Close modal when clicking outside of the modal box
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.remove('active');
            }
        });
    </script>

</body>
</html>
