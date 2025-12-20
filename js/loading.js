/* ================================================================
   FILE: js/loading.js
   DESKRIPSI: Global Loading Script untuk DISPOL
   ================================================================ */

(function() {
    'use strict';

    // Cek apakah halaman di-refresh (bukan navigasi biasa)
    function isPageRefreshed() {
        // Method 1: Cek navigation type
        const perfEntries = performance.getEntriesByType('navigation');
        if (perfEntries.length > 0) {
            const navType = perfEntries[0].type;
            // 'reload' = refresh biasa, 'navigate' = pindah halaman
            return navType === 'reload';
        }
        
        // Method 2: Fallback untuk browser lama
        if (performance.navigation) {
            // TYPE_RELOAD = 1
            return performance.navigation.type === 1;
        }
        
        return false;
    }

    // Inject Loading HTML ke body saat halaman dimuat
    function injectLoadingHTML() {
        const loadingHTML = `
            <div id="loadingOverlay">
                <div class="loading-container">
                    <!-- Logo DISPOL -->
                    <div class="loading-logo">
                        <img src="image/dispol.png" alt="DISPOL Logo">
                    </div>

                    <!-- Brand -->
                    <div class="loading-brand">
                        DISP<span class="loading-brand-o">O</span>L
                    </div>

                    <!-- Pulse Rings Animation -->
                    <div class="loading-pulse">
                        <div class="pulse-ring"></div>
                        <div class="pulse-ring"></div>
                        <div class="pulse-ring"></div>
                        <div class="pulse-center">
                            <div class="pulse-center-icon"></div>
                        </div>
                    </div>

                    <!-- Loading Text -->
                    <div class="loading-text">
                        <span>M</span>
                        <span>E</span>
                        <span>M</span>
                        <span>U</span>
                        <span>A</span>
                        <span>T</span>
                    </div>

                    <!-- Subtitle -->
                    <div class="loading-subtitle">
                        Harap tunggu sebentar...
                    </div>

                    <!-- Progress Bar -->
                    <div class="loading-progress">
                        <div class="loading-progress-bar"></div>
                    </div>
                </div>
            </div>
        `;

        // Insert loading overlay sebagai child pertama di body
        document.body.insertAdjacentHTML('afterbegin', loadingHTML);
    }

    // Hide loading overlay dengan animasi
    function hideLoading() {
        const overlay = document.getElementById('loadingOverlay');
        if (overlay) {
            // Tambah delay sedikit untuk memastikan halaman sudah siap
            setTimeout(() => {
                overlay.classList.add('hidden');
                
                // Hapus element setelah transisi selesai
                setTimeout(() => {
                    overlay.remove();
                }, 500);
            }, 300); // Delay 300ms sebelum mulai fade out
        }
    }

    // Show loading overlay (untuk digunakan manual jika diperlukan)
    function showLoading() {
        const overlay = document.getElementById('loadingOverlay');
        if (overlay) {
            overlay.classList.remove('hidden');
        } else {
            injectLoadingHTML();
        }
    }

    // ✅ HANYA TAMPILKAN LOADING JIKA HALAMAN DI-REFRESH
    if (isPageRefreshed()) {
        // Initialize saat DOM ready
        if (document.readyState === 'loading') {
            // DOM belum siap, inject dulu
            document.addEventListener('DOMContentLoaded', () => {
                injectLoadingHTML();
            });
        } else {
            // DOM sudah siap
            injectLoadingHTML();
        }

        // Hide loading setelah window fully loaded
        window.addEventListener('load', hideLoading);

        // Fallback: Hide loading setelah maksimal 5 detik (untuk koneksi lambat)
        setTimeout(hideLoading, 5000);
    }

    // Export functions ke global scope untuk digunakan manual
    window.DISPOL = window.DISPOL || {};
    window.DISPOL.showLoading = showLoading;
    window.DISPOL.hideLoading = hideLoading;

})();