// Variables for sorting and pagination
const itemsPerPage = 10;
let currentPage = 1;
let totalPages = 1;
let sortColumn = "";
let sortDirection = "asc";

// Custom sorting logic for the 'sesi' column
function sortBySesi(a, b, direction) {
  const order = ["Sesi 1", "Sesi 2", "Full Sesi"]; // Custom order for sessions
  const indexA = order.indexOf(a.sesi);
  const indexB = order.indexOf(b.sesi);

  if (direction === "asc") {
    return indexA - indexB;
  } else {
    return indexB - indexA;
  }
}

// Render pagination controls
function renderPaginationControls(totalItems) {
  const paginationControls = document.getElementById("paginationControls");
  paginationControls.innerHTML = "";

  totalPages = Math.ceil(totalItems / itemsPerPage);

  if (totalPages <= 1) return;

  const createPageItem = (page, isActive = false) => {
    const li = document.createElement("li");
    li.innerHTML = `
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight ${
                  isActive ? "text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700" : "text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                }">${page}</a>
            `;
    li.addEventListener("click", (e) => {
      e.preventDefault();
      currentPage = page;
      getPeminjaman();
    });
    return li;
  };

  if (currentPage > 1) {
    const prevLi = document.createElement("li");
    prevLi.innerHTML = `
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                </a>
            `;
    prevLi.addEventListener("click", (e) => {
      e.preventDefault();
      currentPage--;
      getPeminjaman();
    });
    paginationControls.appendChild(prevLi);
  }

  for (let i = 1; i <= totalPages; i++) {
    paginationControls.appendChild(createPageItem(i, i === currentPage));
  }

  if (currentPage < totalPages) {
    const nextLi = document.createElement("li");
    nextLi.innerHTML = `
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                </a>
            `;
    nextLi.addEventListener("click", (e) => {
      e.preventDefault();
      currentPage++;
      getPeminjaman();
    });
    paginationControls.appendChild(nextLi);
  }
}

// Function to get cookies with debugging
function getCookies(name) {
  // Log the full document cookies for debugging
  console.log("All cookies:", document.cookie);
  
  // Format the cookie string for searching
  const value = `; ${document.cookie}`;
  console.log("Formatted cookie string:", value);

  // Split the cookies to find the target one
  const parts = value.split(`; ${name}=`);
  console.log(`Split parts for '${name}':`, parts);

  // Check if the cookie exists and return it
  if (parts.length === 2) {
    const cookieValue = parts.pop().split(";").shift();
    console.log(`Value of '${name}' cookie:`, cookieValue);
    return cookieValue;
  } else {
    console.log(`Cookie '${name}' not found.`);
    return null;
  }
}


// Function to fetch and render data
async function getPeminjaman() {
  const loggedInUserId = getCookies("id_peminjam"); // Change to use id_peminjam

  if (!loggedInUserId) {
    console.error("ID peminjam tidak ditemukan dalam cookie.");
    return;
  }

  try {
    const response = await fetch("http://localhost/sipinjamfix/sipinjam/api/peminjaman/");
    const result = await response.json();

    if (result.status === "success") {
      const peminjamanTable = document.getElementById("peminjamanTable");
      peminjamanTable.innerHTML = "";

      if (result.data.length === 0) {
        peminjamanTable.innerHTML = '<tr><td colspan="5" class="text-center py-4">Tidak ada data peminjaman ditemukan.</td></tr>';
      } else {
        // Group data by room, date, and activity
        const groupedData = result.data
          .filter((item) => item.id_peminjam === loggedInUserId) // Filter by id_peminjam
          .reduce((acc, item) => {
            const key = `${item.nama_ruangan}_${item.tanggal_kegiatan}_${item.nama_kegiatan}`;

            if (!acc[key]) {
              acc[key] = { sessions: [], ...item };
            }

            if (item.waktu_mulai === "08:00:00" && item.waktu_selesai === "12:00:00") {
              acc[key].sessions.push("Sesi 1");
            } else if (item.waktu_mulai === "12:00:00" && item.waktu_selesai === "16:00:00") {
              acc[key].sessions.push("Sesi 2");
            } else if (item.waktu_mulai === "08:00:00" && item.waktu_selesai === "16:00:00") {
              acc[key].sessions.push("Full Sesi");
            }

            return acc;
          }, {});

        const combinedData = Object.values(groupedData).flatMap((group) => {
          const { sessions, ...rest } = group;

          if (sessions.includes("Sesi 1") && sessions.includes("Sesi 2")) {
            return [{ ...rest, sesi: "Full Sesi" }];
          }

          return sessions.map((session) => ({ ...rest, sesi: session }));
        });

        // Sort based on the selected column and direction
        if (sortColumn === "sesi") {
          combinedData.sort((a, b) => sortBySesi(a, b, sortDirection));
        } else {
          combinedData.sort((a, b) => {
            if (a[sortColumn] < b[sortColumn]) return sortDirection === "asc" ? -1 : 1;
            if (a[sortColumn] > b[sortColumn]) return sortDirection === "asc" ? 1 : -1;
            return 0;
          });
        }

        // Render paginated data
        const paginatedData = combinedData.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage);
        paginatedData.forEach((item) => {
          const row = document.createElement("tr");
          row.className = "bg-white hover:bg-gray-100";

          let statusColor;
          switch (item.nama_status.toLowerCase()) {
            case "proses":
              statusColor = "text-yellow-600";
              break;
            case "disetujui":
              statusColor = "text-green-600";
              break;
            case "ditolak":
              statusColor = "text-red-600";
              break;
            default:
              statusColor = "text-gray-600";
          }

          row.innerHTML = `
                        <td class="border px-4 py-2">${item.nama_ruangan}</td>
                        <td class="border px-4 py-2">${item.nama_kegiatan}</td>
                        <td class="border px-4 py-2">${item.tanggal_kegiatan}</td>
                        <td class="border px-4 py-2">${item.sesi}</td>
                        <td class="border px-4 py-2 ${statusColor} font-bold">${item.nama_status}</td>
                    `;
          peminjamanTable.appendChild(row);
        });

        renderPaginationControls(combinedData.length);
      }
    } else {
      console.error("Gagal mendapatkan data peminjaman:", result.message);
    }
  } catch (error) {
    console.error("Terjadi kesalahan saat mengambil data:", error);
  }
}

// Attach sorting event listeners to table headers
function attachSortEvents() {
  document.querySelectorAll("th[data-sort]").forEach((header) => {
    header.addEventListener("click", () => {
      const column = header.getAttribute("data-sort");
      if (sortColumn === column) {
        sortDirection = sortDirection === "asc" ? "desc" : "asc";
      } else {
        sortColumn = column;
        sortDirection = "asc";
      }

      // Update the SVG icon based on the current sort direction
      updateSortIndicator(header, column);

      getPeminjaman();
    });
  });
}

// Update the sort indicator SVG in the table header
function updateSortIndicator(header, column) {
  let sortIcon = header.querySelector(".sort-icon");

  if (!sortIcon) {
    sortIcon = document.createElement("svg");
    sortIcon.classList.add("sort-icon");
    sortIcon.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    sortIcon.setAttribute("width", "12");
    sortIcon.setAttribute("height", "12");
    sortIcon.setAttribute("viewBox", "0 0 12 12");
    header.appendChild(sortIcon);
  }

  sortIcon.innerHTML = sortDirection === "asc" ? '<path d="M6 9l3-3H3z"></path>' : '<path d="M6 3l-3 3h6z"></path>';
}

document.addEventListener("DOMContentLoaded", () => {
  getCookies();
  getPeminjaman();
  attachSortEvents();
});

