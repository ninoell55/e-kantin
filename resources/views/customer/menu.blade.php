<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kantin SMEA</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-box {
            background: #1E2A78;
            color: #FFC928;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
        }

        .logo h2 {
            margin: 0;
            color: #1E2A78;
        }

        .logo span {
            color: #b91c1c;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-box input {
            padding: 10px 15px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            width: 220px;
            outline: none;
        }

        .cart-btn {
            background: #1E2A78;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
        }

        .hero {
            background: linear-gradient(135deg, #1E2A78, #26358C);
            color: white;
            padding: 70px 30px;
            text-align: center;
        }

        .hero h1 {
            font-size: 52px;
            margin-bottom: 15px;
        }

        .hero span {
            color: #FFC928;
        }

        .hero p {
            max-width: 700px;
            margin: auto;
            font-size: 18px;
            line-height: 1.7;
            opacity: 0.9;
        }

        .category {
            display: flex;
            justify-content: center;
            gap: 15px;
            padding: 30px 20px;
            flex-wrap: wrap;
        }

        .category button {
            border: none;
            padding: 12px 22px;
            border-radius: 999px;
            background: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .category button:hover,
        .category .active {
            background: #FFC928;
            color: #1E2A78;
        }

        .menu-section {
            padding: 20px 40px 70px;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .section-title h2 {
            color: #1E2A78;
            margin: 0;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .menu-card {
            background: white;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .menu-card:hover {
            transform: translateY(-6px);
        }

        .menu-image {
            height: 180px;
            background: #dbeafe;
        }

        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .menu-content {
            padding: 20px;
        }

        .menu-content h3 {
            margin: 0 0 10px;
            color: #111827;
        }

        .menu-price {
            color: #FFC928;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .menu-stand {
            color: #6b7280;
            margin-bottom: 20px;
        }

        .menu-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stock {
            font-size: 14px;
            color: #16a34a;
            font-weight: bold;
        }

        .add-cart {
            background: #1E2A78;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .add-cart:hover {
            background: #16205f;
        }

        .floating-cart {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background: #FFC928;
            color: #1E2A78;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .hero h1 {
                font-size: 38px;
            }

            .menu-section {
                padding: 20px;
            }

            .search-box input {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <div class="logo-box">EK</div>
            <h2>E-KANTIN <span>SMEA</span></h2>
        </div>

        <div class="nav-right">
            <div class="search-box">
                <input type="text" placeholder="Cari makanan...">
            </div>

            <button class="cart-btn">
                🛒 Keranjang
            </button>
        </div>
    </div>

    <!-- Hero -->
    <div class="hero">
        <h1>Jajan Bebas Antre, <span>Istirahat Lebih Santai.</span></h1>

        <p>
            Pesan makanan favoritmu langsung dari kelas, bayar pakai QR atau tunai,
            lalu tinggal ambil pesananmu saat bel istirahat berbunyi.
        </p>
    </div>

    <!-- Category -->
    <div class="category">
        <button class="active">Semua</button>
        <button>Makanan</button>
        <button>Minuman</button>
        <button>Snack</button>
        <button>Terlaris</button>
    </div>

    <!-- Menu -->
    <div class="menu-section">

        <div class="section-title">
            <h2>Menu Tersedia</h2>
        </div>

        <div class="menu-grid">

            <!-- Card 1 -->
            <div class="menu-card">
                <div class="menu-image">
                    <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?q=80&w=1200&auto=format&fit=crop" alt="Makanan">
                </div>

                <div class="menu-content">
                    <h3>Mie Ayam Special</h3>

                    <div class="menu-price">
                        Rp12.000
                    </div>

                    <div class="menu-stand">
                        Stand Bu Rina
                    </div>

                    <div class="menu-footer">
                        <div class="stock">● Tersedia</div>

                        <button class="add-cart">
                            + Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="menu-card">
                <div class="menu-image">
                    <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1200&auto=format&fit=crop" alt="Burger">
                </div>

                <div class="menu-content">
                    <h3>Burger Crispy</h3>

                    <div class="menu-price">
                        Rp15.000
                    </div>

                    <div class="menu-stand">
                        Stand Pak Joko
                    </div>

                    <div class="menu-footer">
                        <div class="stock">● Tersedia</div>

                        <button class="add-cart">
                            + Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="menu-card">
                <div class="menu-image">
                    <img src="https://images.unsplash.com/photo-1622483767028-3f66f32aef97?q=80&w=1200&auto=format&fit=crop" alt="Minuman">
                </div>

                <div class="menu-content">
                    <h3>Es Coklat Jumbo</h3>

                    <div class="menu-price">
                        Rp8.000
                    </div>

                    <div class="menu-stand">
                        Stand Minuman Dingin
                    </div>

                    <div class="menu-footer">
                        <div class="stock">● Tersedia</div>

                        <button class="add-cart">
                            + Keranjang
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Floating Cart -->
    <div class="floating-cart">
        🛒
    </div>

</body>
</html>

