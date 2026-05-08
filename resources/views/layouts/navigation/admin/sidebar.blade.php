{{-- resources/views/layouts/navigation/admin/sidebar.blade.php --}}

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <span class="brand-dot"></span>
        <div class="brand-text">
            <span class="brand-title">Kantin Admin</span>
            <span class="brand-sub">Portal Administrasi</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                <rect x="14" y="14" width="7" height="7" rx="1.5"/>
            </svg>
            <span>Dashboard</span>
        </a>

        {{-- Kelola (dropdown) --}}
        <div class="nav-group {{ request()->routeIs('admin.category.*') ? 'open' : '' }}"
             id="kelola-group">
            <button class="nav-item nav-group-toggle" onclick="toggleGroup('kelola-group')">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="9" cy="6" r="2.5"/>
                    <circle cx="9" cy="18" r="2.5"/>
                    <path d="M14 6h6M14 18h6M4 12h16"/>
                </svg>
                <span>Kelola</span>
                <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="18 15 12 9 6 15"/>
                </svg>
            </button>

            <div class="nav-sub" id="kelola-sub">
                <a href="{{ route('admin.category.index') }}"
                   class="nav-sub-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                    Kelola Kategori
                </a>
                {{-- Tambahkan menu lain di sini sesuai route yang dibuat nanti --}}
                {{-- <a href="{{ route('admin.penjual.index') }}" class="nav-sub-item">Kelola Penjual</a> --}}
                {{-- <a href="{{ route('admin.pengguna.index') }}" class="nav-sub-item">Kelola Pengguna</a> --}}
                {{-- <a href="{{ route('admin.tagihan.index') }}" class="nav-sub-item">Kelola Tagihan</a> --}}
            </div>
        </div>
    </nav>
</aside>

<script>
    function toggleGroup(groupId) {
        const group = document.getElementById(groupId);
        group.classList.toggle('open');
    }
</script>