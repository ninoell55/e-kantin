<!-- Admin Navigation -->
<nav class="bg-gray-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Admin Dashboard</h1>
        <ul class="flex space-x-4">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a></li>
            <li><a href="#" class="hover:underline">Users</a></li>
            <li><a href="#" class="hover:underline">Categories</a></li>
            <li><a href="#" class="hover:underline">Reports</a></li>
            <li><a href="{{ route('logout') }}" class="hover:underline">Logout</a></li>
        </ul>
    </div>
</nav>
