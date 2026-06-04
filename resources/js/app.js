import "../css/app.css";
import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

/**
 * Foody Vendor Panel - SweetAlert2 Confirm Delete Setup
 */
document.addEventListener("DOMContentLoaded", function () {
    const confirmButtons = document.querySelectorAll(".confirm-delete-btn");

    confirmButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah form/link tereksekusi instan

            const form = this.closest("form");

            // Mengambil attribute dinamis dari tombol dengan Fallback teks Foody
            const title =
                this.getAttribute("data-confirm-title") ||
                "Hapus Menu Hidangan?";
            const text =
                this.getAttribute("data-confirm-text") ||
                "Menu ini akan dihapus permanen dari database etalase kantin.";
            const confirmText =
                this.getAttribute("data-confirm-button") ||
                "YA, HAPUS PERMANEN";

            // Cek kondisi mode (Dark / Light) untuk optimalisasi variabel warna background
            const isDark = document.documentElement.classList.contains("dark");

            Swal.fire({
                title: `<span class="text-xl tracking-tight text-gray-900 dark:text-white">${title}</span>`,
                html: `<p class="text-[11px] text-gray-400 dark:text-gray-500 tracking-widest leading-relaxed mt-2 px-2">${text}</p>`,
                icon: "warning",
                iconColor: "#fbbf24", // Menyelaraskan icon default SweetAlert dengan --color-tertiary (Amber)
                showCancelButton: true,
                confirmButtonText: confirmText,
                cancelButtonText: "BATALKAN",
                reverseButtons: true, // Tombol Batal di kiri (Neutral), Hapus di kanan (Action)
                background: isDark ? "#030712" : "#ffffff",
                color: isDark ? "#ffffff" : "#111827",
                customClass: {
                    popup: "rounded-[2.5rem] border border-gray-100 dark:border-gray-900 shadow-2xl p-7 md:p-9 max-w-md",
                    confirmButton:
                        "px-6 py-3.5 text-[10px] tracking-widest rounded-2xl text-white bg-[#730f00] hover:bg-[#590c00] border-0 mx-2 transition-all duration-200 shadow-md shadow-red-900/10 active:scale-95 focus:ring-0",
                    cancelButton:
                        "px-6 py-3.5 text-[10px] tracking-widest rounded-2xl text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800/70 border border-gray-200/50 dark:border-gray-800 mx-2 transition-all duration-200 active:scale-95 focus:ring-0",
                },
                buttonsStyling: false, // Mematikan style bawaan SweetAlert2 agar class Tailwind bekerja mutlak
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tambahkan transisi fade-out kecil sesaat sebelum form dikirim ke Laravel backend
                    Swal.getPopup().style.opacity = "0";
                    setTimeout(() => {
                        form.submit();
                    }, 150);
                }
            });
        });
    });
});
