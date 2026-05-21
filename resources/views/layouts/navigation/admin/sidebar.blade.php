{{-- resources/views/layouts/navigation/admin/sidebar.blade.php --}}

<aside class="sidebar" id="sidebar">
    <!-- Brand / Logo Area -->
    <div class="sidebar-brand">
        <span class="brand-dot"></span>
        <div class="brand-text">
            <span class="brand-title">Kantin Admin</span>
            <span class="brand-sub">Portal Administrasi</span>
        </div>
    </div>

    <!-- Navigation Menu -->
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

        {{-- Kelola (Dropdown Menu) --}}
       <div class="nav-group {{ request()->routeIs('admin.category.*', 'admin.vendor.*', 'admin.costumer.*', 'admin.invoice.*') ? 'open' : '' }}" id="kelola-group">
            <button class="nav-item nav-group-toggle" onclick="toggleGroup('kelola-group')" type="button">
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

            <div class="nav-sub-menu">
                <a href="{{ route('admin.category.index') }}"
                   class="nav-sub-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                    Kelola category
                </a>
                <a href="{{ route('admin.vendor.index') }}"
                   class="nav-sub-item {{ request()->routeIs('admin.vendor.*') ? 'active' : '' }}">
                    Kelola Vendor
                </a>
                <a href="{{ route('admin.costumer.index') }}"
                   class="nav-sub-item {{ request()->routeIs('admin.costumer.*') ? 'active' : '' }}">
                    Kelola Costumer
                </a>
                 <a href="{{ route('admin.invoice.index') }}"
                   class="nav-sub-item {{ request()->routeIs('admin.invoice.*') ? 'active' : '' }}">
                    Kelola Invoice
                </a>
            </div>
        </div>
    </nav>
 
    <!-- Sidebar Footer (Logout) -->
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-item logout-btn">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

{{-- 1. KODE CSS UNTUK DROPDOWN --}}
<style>
    /* Secara default sub-menu disembunyikan */
    .nav-sub-menu { 
        display: none; 
    }
    
    /* Ketika nav-group punya class 'open', sub-menu ditampilkan */
    .nav-group.open .nav-sub-menu { 
        display: block; 
    }
    
    /* Animasi panah berputar saat dropdown terbuka */
    .nav-group.open .chevron { 
        transform: rotate(180deg); 
    }
    .chevron {
        transition: transform 0.2s ease;
    }
</style>

{{-- 2. KODE JAVASCRIPT UNTUK KLIK --}}
<script>
function toggleGroup(id) {
    const group = document.getElementById(id);
    if (group) {
        group.classList.toggle('open');
    }
}
</script>