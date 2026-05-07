<!-- Customer Navigation -->
<nav class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Customer Dashboard</h1>
        <ul class="flex space-x-4">
            <li><a href="{{ route('customer.dashboard') }}" class="hover:underline">Dashboard</a></li>
            <li><a href="#" class="hover:underline">Menu</a></li>
            <li><a href="#" class="hover:underline">Orders</a></li>
            <li><a href="#" class="hover:underline">Profile</a></li>
            <li><a href="{{ route('logout') }}" class="hover:underline">Logout</a></li>
        </ul>
    </div>
</nav>
