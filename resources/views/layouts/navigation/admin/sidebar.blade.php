{{-- resources/views/layouts/navigation/admin/sidebar.blade.php --}}

<aside class="sidebar" id="sidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="Logo SMK" style="width:36px;height:36px;object-fit:contain;flex-shrink:0;">
        <div class="brand-text">
            <span class="brand-title">Foo<span style="color:#f87171;">dy</span></span>
            <span class="brand-sub">Admin Panel</span>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="sidebar-nav">

        {{-- Label section --}}
        <span class="nav-label">MENU UTAMA</span>

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <div class="nav-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                    <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                    <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                    <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                </svg>
            </div>
            <span>Dashboard</span>
        </a>

        {{-- Label section --}}
        <span class="nav-label" style="margin-top: 8px;">KELOLA DATA</span>

        {{-- Kelola Dropdown --}}
        <div class="nav-group {{ request()->routeIs('admin.category.*', 'admin.vendor.*', 'admin.costumer.*', 'admin.invoice.*') ? 'open' : '' }}"
             id="kelola-group">
            <button class="nav-item nav-group-toggle" onclick="toggleGroup('kelola-group')" type="button">
                <div class="nav-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="9" cy="6" r="2.5"/>
                        <circle cx="9" cy="18" r="2.5"/>
                        <path d="M14 6h6M14 18h6M4 12h16"/>
                    </svg>
                </div>
                <span>Kelola</span>
                <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="18 15 12 9 6 15"/>
                </svg>
            </button>

            <div class="nav-sub-menu">
                <a href="{{ route('admin.category.index') }}"
                   class="nav-sub-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                    </svg>
                    Kategori
                </a>
                <a href="{{ route('admin.vendor.index') }}"
                   class="nav-sub-item {{ request()->routeIs('admin.vendor.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    Penjual
                </a>
                <a href="{{ route('admin.costumer.index') }}"
                   class="nav-sub-item {{ request()->routeIs('admin.costumer.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Pengguna
                </a>
                <a href="{{ route('admin.invoice.index') }}"
                   class="nav-sub-item {{ request()->routeIs('admin.invoice.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                    Invoice
                </a>
            </div>
        </div>

    </nav>

    {{-- Footer Logout --}}
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <span class="sidebar-user-name">{{ Auth::user()->name }}</span>
                <span class="sidebar-user-role">{{ strtoupper(Auth::user()->role ?? 'Admin') }}</span>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>

<style>
    /* ── SIDEBAR RESTYLED ── */
    .sidebar {
        width: var(--sidebar-w) !important;
        height: 100vh !important;
        background: #0f1225 !important;
        display: flex !important;
        flex-direction: column !important;
        flex-shrink: 0 !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        border-right: 1px solid rgba(255,255,255,0.04) !important;
    }

    /* Brand */
    .sidebar-brand {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 22px 20px 18px !important;
        border-bottom: 1px solid rgba(255,255,255,0.06) !important;
        flex-shrink: 0 !important;
    }
    .brand-logo {
        width: 36px !important;
        height: 36px !important;
        border-radius: 10px !important;
        background: linear-gradient(135deg, #3d4fd6, #6366f1) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }
    .brand-logo svg { width: 18px !important; height: 18px !important; color: #fff !important; }
    .brand-title { font-size: 15px !important; font-weight: 700 !important; color: #fff !important; display: block !important; }
    .brand-sub { font-size: 10px !important; color: rgba(255,255,255,0.35) !important; text-transform: uppercase !important; letter-spacing: 0.1em !important; display: block !important; margin-top: 1px !important; }

    /* Nav */
    .sidebar-nav {
        padding: 16px 12px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 2px !important;
        flex: 1 !important;
    }
    .nav-label {
        font-size: 9px !important;
        font-weight: 700 !important;
        color: rgba(255,255,255,0.25) !important;
        letter-spacing: 0.12em !important;
        padding: 8px 10px 4px !important;
        display: block !important;
    }

    /* Nav Item */
    .nav-item {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        padding: 10px 12px !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: rgba(255,255,255,0.5) !important;
        text-decoration: none !important;
        cursor: pointer !important;
        background: none !important;
        border: none !important;
        width: 100% !important;
        text-align: left !important;
        transition: all 0.15s ease !important;
        font-family: var(--font) !important;
    }
    .nav-item:hover {
        background: rgba(214, 53, 77, 0.15) !important;
        color: #fff !important;
    }
    .nav-item.active {
        background: rgba(214, 53, 77, 0.15) !important;
        color: #fff !important;
    }
    .nav-item.active .nav-icon-wrap {
        background: rgba(214, 53, 77, 0.15) !important;
        color: #fff !important;
    }

    /* Icon wrap */
    .nav-icon-wrap {
        width: 32px !important;
        height: 32px !important;
        border-radius: 8px !important;
        background: rgba(255,255,255,0.06) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
        color: rgba(255,255,255,0.5) !important;
        transition: all 0.15s ease !important;
    }
    .nav-item:hover .nav-icon-wrap {
        background: rgba(214, 53, 77, 0.15) !important;
        color: #fff !important;
    }
    .nav-icon-wrap svg { width: 15px !important; height: 15px !important; }

    /* Chevron */
    .chevron { width: 14px !important; height: 14px !important; margin-left: auto !important; transition: transform 0.2s ease !important; color: rgba(255,255,255,0.3) !important; }
    .nav-group.open .chevron { transform: rotate(180deg) !important; }

    /* Dropdown */
    .nav-group { display: flex !important; flex-direction: column !important; }
    .nav-sub-menu { display: none !important; flex-direction: column !important; gap: 1px !important; margin-top: 2px !important; padding: 4px 0 4px 14px !important; }
    .nav-group.open .nav-sub-menu { display: flex !important; }

    .nav-sub-item {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        padding: 9px 12px !important;
        border-radius: 8px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        color: rgba(255,255,255,0.45) !important;
        text-decoration: none !important;
        transition: all 0.15s ease !important;
        border-left: 2px solid rgba(255,255,255,0.08) !important;
    }
    .nav-sub-item svg { width: 14px !important; height: 14px !important; flex-shrink: 0 !important; }
    .nav-sub-item:hover {
        background:  rgba(214, 53, 77, 0.15) !important;
        color: #fff !important;
        border-left-color: rgba(255,255,255,0.2) !important;
    }
    .nav-sub-item.active {
        background: rgba(214, 53, 77, 0.15) !important;
        color: #b91c1c !important;
        border-left-color: #730f00 !important;
    }

    /* Footer */
    .sidebar-footer {
        padding: 14px 12px !important;
        border-top: 1px solid rgba(255,255,255,0.06) !important;
        flex-shrink: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 10px !important;
    }
    .sidebar-user {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        padding: 8px 10px !important;
        border-radius: 10px !important;
        background: rgba(255,255,255,0.04) !important;
    }
    .sidebar-user-avatar {
        width: 32px !important;
        height: 32px !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, #3d4fd6, #6366f1) !important;
        color: #fff !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }
    .sidebar-user-info { display: flex !important; flex-direction: column !important; line-height: 1.2 !important; overflow: hidden !important; }
    .sidebar-user-name { font-size: 13px !important; font-weight: 600 !important; color: #fff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; }
    .sidebar-user-role { font-size: 10px !important; color: rgba(255,255,255,0.35) !important; letter-spacing: 0.05em !important; }

    .logout-btn {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        width: 100% !important;
        padding: 10px 12px !important;
        border-radius: 10px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        color: rgba(255,255,255,0.4) !important;
        background: none !important;
        border: none !important;
        cursor: pointer !important;
        font-family: var(--font) !important;
        transition: all 0.15s ease !important;
    }
    .logout-btn:hover {
        background: rgba(220,38,38,0.12) !important;
        color: #f87171 !important;
    }
    .logout-btn svg { width: 16px !important; height: 16px !important; }
</style>

<script>
    function toggleGroup(id) {
        const group = document.getElementById(id);
        if (group) group.classList.toggle('open');
    }
</script>