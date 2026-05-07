<!-- Vendor Navigation -->
<nav class="bg-green-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Vendor Dashboard</h1>
        <ul class="flex space-x-4">
            <li><a href="{{ route('vendor.dashboard') }}" class="hover:underline">Dashboard</a></li>
            <li><a href="#" class="hover:underline">Shop</a></li>
            <li><a href="#" class="hover:underline">Products</a></li>
            <li><a href="#" class="hover:underline">Orders</a></li>
            <li><a href="{{ route('logout') }}" class="hover:underline">Logout</a></li>
        </ul>
    </div>
</nav>
