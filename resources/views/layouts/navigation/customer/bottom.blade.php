    </main>

    <!-- Bottom Navigation Mobile -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 shadow-lg z-40 md:hidden">
        <div class="flex justify-around items-center py-2">
            <a href="{{ route('customer.dashboard') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-blue-900 transition py-1">
                <i class="fas fa-home text-xl"></i>
                <span class="text-[10px]">Beranda</span>
            </a>
            <a href="{{ route('customer.menu') }}"  class="flex flex-col items-center gap-1 text-gray-400 hover:text-blue-900 transition py-1">
                <i class="fas fa-utensils text-xl"></i>
                <span class="text-[10px] font-semibold">Menu</span>
            </a>
            <a href="{{ route('customer.tracking') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-blue-900 transition py-1">
                <i class="fas fa-truck text-xl"></i>
                <span class="text-[10px]">Tracking</span>
            </a>
            <a href="{{ route('customer.cart') }}" class="relative flex flex-col items-center gap-1 text-gray-400 hover:text-blue-900 transition py-1">
                <i class="fas fa-shopping-cart text-xl"></i>
                <span class="cart-badge-bottom absolute -top-2 -right-3 bg-red-700 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center">0</span>
                <span class="text-[10px]">Cart</span>
            </a>
        </div>
    </nav>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const headerBadge = document.querySelector('.cart-badge');
        const bottomBadge = document.querySelector('.cart-badge-bottom');
        if(headerBadge && bottomBadge) {
            const update = () => { bottomBadge.textContent = headerBadge.textContent; };
            update();
            new MutationObserver(update).observe(headerBadge, { childList: true, characterData: true, subtree: true });
        }
    });
    </script>

</body>
</html>