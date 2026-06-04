@extends('layouts.vendor')

@section('content')
    <div class="w-full min-h-screen bg-white px-4 sm:px-6 lg:px-8 pb-34 animate-fade-in">

        {{-- Header Halaman --}}
        <div
            class="w-full flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-5 mb-6 border-b border-gray-100">
            <div>
                <nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                    <span class="flex items-center gap-1"><i class="ti ti-smart-home"></i> Vendor Panel</span>
                    <i class="ti ti-chevron-right text-[8px]"></i>
                    <span class="text-[#7f1d1d]">Tagihan Sewa</span>
                </nav>
                <h1 class="text-2xl font-black text-gray-900 tracking-tight leading-none flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#7f1d1d] rounded-full"></span>
                    Tagihan Sewa Lapak
                </h1>
            </div>
        </div>

        @if (session('success'))
            <div
                class="mb-6 rounded-2xl border border-emerald-500/20 bg-emerald-50 p-4 text-sm text-emerald-800 font-bold flex items-center gap-2 shadow-sm">
                <i class="ti ti-circle-check text-base"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Ringkasan Info Rekening Sekolah --}}
        <div
            class="bg-gray-50 rounded-2xl p-5 border border-gray-100 mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="text-left">
                <h3 class="text-xs font-black text-gray-800 uppercase tracking-wide">Metode Pembayaran Sewa</h3>
                <p class="text-[11px] text-gray-400 font-semibold mt-1 leading-relaxed">
                    Anda bisa membayar langsung secara **Tunai (Cash)** ke Bendahara, atau melalui **Transfer** ke rekening
                    sekolah di bawah ini.
                </p>
            </div>
            <div
                class="bg-[#7f1d1d] text-white px-4 py-3 rounded-2xl text-xs font-mono font-bold whitespace-nowrap text-center shadow-sm">
                <span class="text-[9px] uppercase tracking-widest font-black block text-red-300 mb-0.5">Rekening Utama
                    Sekolah</span>
                BANK BJB — 0012345678901 (Kantin SMKN 1)
            </div>
        </div>

        {{-- Grid Card Daftar Tagihan (Menggantikan Tabel) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($bills as $bill)
                <div
                    class="bg-white border border-gray-100 rounded-3xl p-5 shadow-sm hover:shadow-md transition-all flex flex-col justify-between relative overflow-hidden group">

                    {{-- Top Section: Periode & Status --}}
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-0.5">Periode
                                Tagihan</span>
                            <h3 class="text-base font-black text-gray-900 tracking-tight">
                                {{ $bill->month }} {{ $bill->year }}
                            </h3>
                        </div>

                        {{-- Status Badge --}}
                        <div>
                            @if ($bill->status === 'paid')
                                <span
                                    class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 border border-emerald-100 px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider">
                                    ✓ Lunas
                                </span>
                            @elseif($bill->status === 'verifying')
                                <span
                                    class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 border border-blue-100 px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider">
                                    🗘 Verifikasi
                                </span>
                            @elseif($bill->status === 'overdue')
                                <span
                                    class="inline-flex items-center gap-1 bg-rose-50 text-rose-700 border border-rose-100 px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider">
                                    ⚠ Terlambat
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 border border-amber-100 px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider">
                                    ● Unpaid
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr class="border-gray-50 my-1">

                    {{-- Center Section: Nominal & Info --}}
                    <div class="py-3 space-y-2.5">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400 font-semibold">Batas Waktu:</span>
                            <span class="font-mono text-gray-600 bg-gray-50 px-2 py-0.5 rounded-lg text-[11px]">
                                {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400 font-semibold">Total Tagihan:</span>
                            <span class="font-mono text-base font-black text-[#7f1d1d]">
                                Rp {{ number_format($bill->amount, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center text-xs pt-1">
                            <span class="text-gray-400 font-semibold">Metode Dipilih:</span>
                            {{-- Diperbaiki: Jika status unpaid, tidak ada bukti, dan pembayaran belum menyentuh aksi apa pun --}}
                            @if ($bill->status === 'unpaid' && !$bill->payment_proof && $bill->updated_at == $bill->created_at)
                                <span class="text-gray-400 italic text-[11px]">Belum ditentukan</span>
                            @else
                                @if ($bill->payment_method === 'transfer')
                                    <span class="text-blue-600 font-black flex items-center gap-1 uppercase text-[10px]">
                                        <i class="ti ti-device-computer text-sm"></i> Transfer Bank
                                    </span>
                                @else
                                    <span class="text-amber-600 font-black flex items-center gap-1 uppercase text-[10px]">
                                        <i class="ti ti-wallet text-sm"></i> Tunai (Cash)
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>

                    {{-- Bottom Section: Tombol Aksi Dinamis (Sudah Diperbaiki Logikanya) --}}
                    <div class="mt-4 pt-3 border-t border-gray-50">
                        @if ($bill->status === 'paid')
                            {{-- Skenario 1: Lunas --}}
                            <div
                                class="w-full text-center py-2 bg-emerald-50 text-emerald-700 text-xs font-black uppercase tracking-wider rounded-xl border border-emerald-100">
                                <i class="ti ti-circle-check-filled"></i> Pembayaran Selesai
                            </div>
                        @elseif($bill->status === 'verifying' || ($bill->payment_method === 'transfer' && $bill->payment_proof))
                            {{-- Skenario 2: Sudah upload transfer & status menunggu dicek admin --}}
                            <button type="button"
                                onclick="openPayModal('{{ route('vendor.bills.pay', $bill->id) }}', '{{ $bill->month }} {{ $bill->year }}', '{{ $bill->payment_method }}')"
                                class="w-full py-2.5 bg-blue-50 border border-blue-200 text-blue-700 hover:bg-blue-100/70 text-xs font-black uppercase tracking-wide rounded-xl transition-all flex items-center justify-center gap-1">
                                <i class="ti ti-refresh text-sm"></i> Ganti Bukti Transfer
                            </button>
                        @elseif($bill->status === 'unpaid' && $bill->payment_method === 'cash' && $bill->updated_at != $bill->created_at)
                            {{-- Skenario 3: Vendor fix memilih bayar tunai (dan sudah menekan submit simpan metode) --}}
                            <button type="button"
                                onclick="openPayModal('{{ route('vendor.bills.pay', $bill->id) }}', '{{ $bill->month }} {{ $bill->year }}', '{{ $bill->payment_method }}')"
                                class="w-full py-2.5 bg-amber-500 text-white hover:bg-amber-600 text-xs font-black uppercase tracking-wide rounded-xl transition-all shadow-sm flex items-center justify-center gap-1">
                                <i class="ti ti-info-circle text-sm"></i> Detail / Ubah Metode Cash
                            </button>
                        @else
                            {{-- Skenario 4: Default pabrik saat data baru dibuat oleh admin (belum diapa-apain) --}}
                            <button type="button"
                                onclick="openPayModal('{{ route('vendor.bills.pay', $bill->id) }}', '{{ $bill->month }} {{ $bill->year }}', '{{ $bill->payment_method }}')"
                                class="w-full py-2.5 bg-[#1b2563] text-white hover:bg-[#151c4b] text-xs font-black uppercase tracking-wide rounded-xl transition-all shadow-md flex items-center justify-center gap-1">
                                <i class="ti ti-credit-card text-sm"></i> Pilih Metode Bayar
                            </button>
                        @endif
                    </div>

                </div>
            @empty
                {{-- State Kosong --}}
                <div
                    class="col-span-1 md:col-span-2 lg:col-span-3 py-16 text-center text-gray-400 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                    <i class="ti ti-file-off text-4xl block mb-2 opacity-40"></i>
                    <span class="text-xs uppercase font-black tracking-widest text-gray-400">Belum ada riwayat tagihan
                        sewa</span>
                </div>
            @endforelse
        </div>
    </div>

    {{-- MODAL INTERAKTIF: BAYAR CASH VS TRANSFER --}}
    <div id="payModal" class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-gray-100">
            <div class="flex justify-between items-center pb-3 border-b border-gray-100 mb-4">
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-wide">Pilih Metode Pembayaran</h3>
                <button type="button" onclick="closePayModal()" class="text-gray-400 hover:text-gray-600 text-xl"><i
                        class="ti ti-x"></i></button>
            </div>

            <p class="text-xs text-gray-400 font-semibold mb-4">Periode Tagihan: <span id="modalPeriodText"
                    class="text-gray-900 font-black"></span></p>

            <form id="modalPayForm" action="" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Pilihan Radio Button --}}
                <div class="grid grid-cols-2 gap-3">
                    <label
                        class="border border-gray-200 rounded-2xl p-3 flex flex-col items-center justify-center gap-1.5 cursor-pointer hover:bg-gray-50 transition-all select-none has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/30 group">
                        <input type="radio" name="payment_method" value="cash" id="radioCash" class="sr-only"
                            onchange="toggleMethodFields(this.value)">
                        <i class="ti ti-wallet text-xl text-gray-400 group-has-[:checked]:text-blue-600"></i>
                        <span class="text-xs font-black uppercase text-gray-700 group-has-[:checked]:text-blue-900">Uang
                            Tunai</span>
                    </label>

                    <label
                        class="border border-gray-200 rounded-2xl p-3 flex flex-col items-center justify-center gap-1.5 cursor-pointer hover:bg-gray-50 transition-all select-none has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/30 group">
                        <input type="radio" name="payment_method" value="transfer" id="radioTransfer" class="sr-only"
                            onchange="toggleMethodFields(this.value)">
                        <i class="ti ti-device-computer text-xl text-gray-400 group-has-[:checked]:text-blue-600"></i>
                        <span class="text-xs font-black uppercase text-gray-700 group-has-[:checked]:text-blue-900">Transfer
                            Bank</span>
                    </label>
                </div>

                {{-- Info Jika Memilih Cash --}}
                <div id="cashInfoBox"
                    class="hidden bg-amber-50 border border-amber-100 rounded-2xl p-3.5 text-xs text-amber-800 font-semibold leading-relaxed">
                    📢 **Sistem Tunai:** Silakan langsung bawa uang pas ke ruang Bendahara Sekolah. Beritahu Admin untuk
                    mengubah status invoice ini setelah uang diterima.
                </div>

                {{-- Input File Jika Memilih Transfer --}}
                <div id="transferUploadBox" class="hidden space-y-2">
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-wider block">Unggah Bukti Struk
                        Transfer</label>
                    <div
                        class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center hover:border-blue-500/50 relative cursor-pointer">
                        <input type="file" name="payment_proof" id="fileInput"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            onchange="updateFileNameLabel(this)">
                        <div id="uploadPromptText">
                            <i class="ti ti-photo-plus text-2xl text-gray-400"></i>
                            <p class="text-[10px] font-bold text-gray-400 uppercase mt-1">Pilih Foto Struk</p>
                        </div>
                        <p id="fileNameLabel" class="text-xs text-emerald-600 font-bold hidden"></p>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3.5 bg-[#1b2563] text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-[#151c4b] transition-all shadow-md">
                    Konfirmasi Pembayaran
                </button>
            </form>
        </div>
    </div>

    {{-- JavaScript Kontrol Dinamis Form Modal --}}
    <script>
        function openPayModal(actionUrl, periodText, currentMethod) {
            document.getElementById('modalPayForm').action = actionUrl;
            document.getElementById('modalPeriodText').innerText = periodText;

            // Reset element upload file
            document.getElementById('uploadPromptText').classList.remove('hidden');
            document.getElementById('fileNameLabel').classList.add('hidden');
            document.getElementById('fileInput').required = false;
            document.getElementById('fileInput').value = '';

            // Deteksi apakah user sudah pernah milih 'transfer' sebelumnya
            if (currentMethod === 'transfer') {
                document.getElementById('radioTransfer').checked = true;
                toggleMethodFields('transfer');
            } else {
                // Default atau jika milih cash
                document.getElementById('radioCash').checked = true;
                toggleMethodFields('cash');
            }

            document.getElementById('payModal').classList.remove('hidden');
        }

        function closePayModal() {
            document.getElementById('payModal').classList.add('hidden');
        }

        function toggleMethodFields(method) {
            const cashBox = document.getElementById('cashInfoBox');
            const transferBox = document.getElementById('transferUploadBox');
            const fileInput = document.getElementById('fileInput');

            if (method === 'transfer') {
                cashBox.classList.add('hidden');
                transferBox.classList.remove('hidden');
                fileInput.required = true; // Wajib upload jika transfer bank
            } else {
                cashBox.classList.remove('hidden');
                transferBox.classList.add('hidden');
                fileInput.required = false;
            }
        }

        function updateFileNameLabel(input) {
            if (input.files && input.files[0]) {
                document.getElementById('uploadPromptText').classList.add('hidden');
                const label = document.getElementById('fileNameLabel');
                label.innerText = '✓ ' + input.files[0].name;
                label.classList.remove('hidden');
            }
        }
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection
