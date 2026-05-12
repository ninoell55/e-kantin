<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Keranjang - E-Kantin SMEA</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#1E2A78',
          secondary: '#FFC928',
          dark: '#111827',
          danger: '#730f00',
        },
        fontFamily: {
          sans: ['Poppins', 'sans-serif'],
        }
      }
    }
  }
</script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-100 font-sans min-h-screen">

  <!-- Navbar -->
  <nav class="bg-white px-4 md:px-10 py-3 flex justify-between items-center shadow-sm sticky top-0 z-50">
    <div class="flex items-center gap-2.5">
      <div class="bg-primary text-secondary w-9 h-9 md:w-11 md:h-11 rounded-xl flex items-center justify-center font-bold text-sm md:text-lg flex-shrink-0">EK</div>
      <h2 class="font-bold text-base md:text-xl tracking-wide">
        <span class="text-primary">E-KANTIN</span> <span class="text-danger">SMEA</span>
      </h2>
    </div>
    <a href="/menu" class="text-primary text-sm font-semibold flex items-center gap-1 hover:opacity-70 transition-opacity">
      ← <span class="hidden sm:inline">Kembali ke Menu</span>
    </a>
  </nav>

  <!-- Main -->
  <div class="max-w-5xl mx-auto px-4 md:px-8 py-6 md:py-10">

    <h1 class="text-primary font-bold text-xl md:text-2xl mb-6">🛒 Keranjang Saya</h1>

    <div class="flex flex-col lg:flex-row gap-5">

      <!-- Cart Items -->
      <div class="flex flex-col gap-4 flex-1">

        <!-- Item 1 -->
        <div class="bg-white rounded-2xl p-4 md:p-5 shadow-sm">
          <div class="flex gap-4 items-start">
            <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl overflow-hidden flex-shrink-0">
              <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?q=80&w=600&auto=format&fit=crop" alt="Mie Ayam" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-semibold text-dark text-sm md:text-base">Mie Ayam Special</h3>
              <span class="inline-block mt-1 mb-2 bg-blue-50 text-primary text-xs font-semibold px-2.5 py-1 rounded-full">🍴 Stand Bu Rina</span>
              <p class="text-secondary font-bold text-lg md:text-xl">Rp12.000</p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
              <button onclick="changeQty(this,-1)" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-primary text-white font-bold text-base flex items-center justify-center hover:bg-danger transition-colors">−</button>
              <span class="font-bold text-dark w-5 text-center qty text-sm">1</span>
              <button onclick="changeQty(this,1)" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-primary text-white font-bold text-base flex items-center justify-center hover:bg-primary/80 transition-colors">+</button>
            </div>
          </div>
        </div>

        <!-- Item 2 -->
        <div class="bg-white rounded-2xl p-4 md:p-5 shadow-sm">
          <div class="flex gap-4 items-start">
            <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl overflow-hidden flex-shrink-0">
              <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop" alt="Burger" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-semibold text-dark text-sm md:text-base">Burger Crispy</h3>
              <span class="inline-block mt-1 mb-2 bg-blue-50 text-primary text-xs font-semibold px-2.5 py-1 rounded-full">🍴 Stand Pak Joko</span>
              <p class="text-secondary font-bold text-lg md:text-xl">Rp15.000</p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
              <button onclick="changeQty(this,-1)" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-primary text-white font-bold text-base flex items-center justify-center hover:bg-danger transition-colors">−</button>
              <span class="font-bold text-dark w-5 text-center qty text-sm">2</span>
              <button onclick="changeQty(this,1)" class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-primary text-white font-bold text-base flex items-center justify-center hover:bg-primary/80 transition-colors">+</button>
            </div>
          </div>
        </div>

        <!-- Tambah item -->
        <div class="border-2 border-dashed border-slate-200 rounded-2xl p-5 text-center text-sm text-gray-400 cursor-pointer hover:border-primary hover:text-primary transition-all group">
          <span class="text-xl block mb-1 group-hover:scale-110 transition-transform inline-block">+</span>
          Tambah item lainnya
        </div>

      </div>

      <!-- Summary -->
      <div class="lg:w-80 flex flex-col gap-4">

        <!-- Fast Checkout Info -->
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex gap-3 items-start">
          <span class="text-xl flex-shrink-0">⚡</span>
          <p class="text-primary text-xs leading-relaxed font-medium">
            Fast Checkout aktif — pesananmu disimpan sementara dengan session agar checkout lebih cepat dan ringan.
          </p>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-2xl p-5 shadow-sm">
          <h2 class="text-primary font-bold text-base md:text-lg mb-5">Ringkasan Pesanan</h2>

          <div class="flex flex-col gap-3 text-sm">
            <div class="flex justify-between text-dark/70">
              <span>Mie Ayam Special × <span id="qty1">1</span></span>
              <span>Rp<span id="sub1">12.000</span></span>
            </div>
            <div class="flex justify-between text-dark/70">
              <span>Burger Crispy × <span id="qty2">2</span></span>
              <span>Rp<span id="sub2">30.000</span></span>
            </div>
            <div class="w-full h-px bg-slate-100 my-1"></div>
            <div class="flex justify-between text-dark/70">
              <span>Total Item</span>
              <span id="totalItems" class="font-semibold">3</span>
            </div>
            <div class="flex justify-between text-dark/70">
              <span>Subtotal</span>
              <span>Rp<span id="subtotal">42.000</span></span>
            </div>
            <div class="flex justify-between text-dark/70">
              <span>Biaya Admin</span>
              <span class="text-green-600 font-semibold">Gratis</span>
            </div>
          </div>

          <div class="border-t-2 border-slate-100 mt-4 pt-4 flex justify-between items-center">
            <span class="font-bold text-dark">Total</span>
            <span class="font-bold text-xl text-primary">Rp<span id="total">42.000</span></span>
          </div>

          <a href="/checkout">
            <button class="w-full mt-5 py-4 rounded-2xl bg-secondary text-primary font-bold text-sm tracking-wide hover:-translate-y-0.5 hover:shadow-lg active:scale-95 transition-all">
              Checkout Sekarang →
            </button>
          </a>

          <p class="text-center text-xs text-dark/40 mt-3">🔒 Pembayaran aman & terpercaya</p>
        </div>

      </div>
    </div>
  </div>

<script>
  const prices = [12000, 15000];
  let qtys = [1, 2];

  function fmt(n) { return n.toLocaleString('id-ID'); }

  function changeQty(btn, delta) {
    const card = btn.closest('.bg-white');
    const allCards = Array.from(document.querySelectorAll('.bg-white.rounded-2xl')).filter(c => c.querySelector('.qty'));
    const idx = allCards.indexOf(card);
    if (idx < 0) return;
    qtys[idx] = Math.max(1, qtys[idx] + delta);
    card.querySelector('.qty').textContent = qtys[idx];
    updateSummary();
  }

  function updateSummary() {
    document.getElementById('qty1').textContent = qtys[0];
    document.getElementById('qty2').textContent = qtys[1];
    document.getElementById('sub1').textContent = fmt(prices[0] * qtys[0]);
    document.getElementById('sub2').textContent = fmt(prices[1] * qtys[1]);
    const total = prices[0]*qtys[0] + prices[1]*qtys[1];
    document.getElementById('totalItems').textContent = qtys[0] + qtys[1];
    document.getElementById('subtotal').textContent = fmt(total);
    document.getElementById('total').textContent = fmt(total);
  }
</script>
</body>
</html>