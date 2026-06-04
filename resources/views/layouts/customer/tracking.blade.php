@include('layouts.navigation.customer.top')

<div class="mb-6">
    <h1 class="text-2xl font-black text-[#1b2563] flex items-center gap-2">
        <i class="fas fa-truck text-[#730f00]"></i>
        Tracking Pesanan
    </h1>
    <p class="text-sm text-gray-500">Pantau status pesananmu secara real-time</p>
</div>

<!-- Status Overview Card -->
<div class="bg-gradient-to-r from-[#1b2563] to-[#730f00] rounded-2xl p-5 mb-6 text-white shadow-xl">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-white/70 text-xs">Nomor Pesanan</p>
            <p class="font-bold text-lg">#FOODY-2406-001</p>
            <p class="text-white/60 text-xs mt-1">Dibuat: 03 Juni 2026 • 12:30 WIB</p>
        </div>
        <div class="bg-[#ffc61a]/20 rounded-full px-3 py-1 text-xs font-semibold">
            <i class="fas fa-clock mr-1"></i> Estimasi: 15-20 menit
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column - Order Items -->
    <div class="lg:col-span-2 space-y-5">
        <!-- Order Items Card -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-bold text-[#1b2563] flex items-center gap-2 mb-4">
                <i class="fas fa-receipt text-[#730f00]"></i>
                Ringkasan Pesanan
            </h3>
            
            <div class="space-y-3">
                <!-- Item 1 -->
                <div class="flex gap-3 pb-3 border-b border-gray-100">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#ffc61a]/20 to-[#730f00]/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-burger text-2xl text-[#730f00]"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h4 class="font-bold text-[#1b2563]">Nasi Goreng Spesial</h4>
                            <span class="font-bold text-[#730f00]">Rp15.000</span>
                        </div>
                        <p class="text-xs text-gray-500">Best Seller • 30% OFF</p>
                        <p class="text-xs text-gray-400 mt-1">Jumlah: 1x</p>
                    </div>
                </div>
                
                <!-- Item 2 -->
                <div class="flex gap-3 pb-3 border-b border-gray-100">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#ffc61a]/20 to-[#730f00]/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-mug-hot text-2xl text-[#730f00]"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h4 class="font-bold text-[#1b2563]">Es Teh Manis Segar</h4>
                            <span class="font-bold text-[#730f00]">Rp6.000</span>
                        </div>
                        <p class="text-xs text-gray-500">Minuman segar</p>
                        <p class="text-xs text-gray-400 mt-1">Jumlah: 2x</p>
                    </div>
                </div>
            </div>
            
            <!-- Total -->
            <div class="mt-4 pt-3 border-t-2 border-dashed border-gray-200">
                <div class="flex justify-between font-bold">
                    <span>Total Pesanan</span>
                    <span class="text-xl text-[#730f00]">Rp27.000</span>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">*Sudah termasuk diskon 30%</p>
            </div>
        </div>
        
        <!-- Delivery Info Card -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-bold text-[#1b2563] flex items-center gap-2 mb-4">
                <i class="fas fa-location-dot text-[#730f00]"></i>
                Informasi Pengiriman
            </h3>
            <div class="flex gap-3">
                <div class="w-8 h-8 bg-[#ffc61a]/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-school text-[#730f00] text-sm"></i>
                </div>
                <div>
                    <p class="font-semibold text-sm">Kelas XII RPL 2</p>
                    <p class="text-xs text-gray-500">Gedung Utama Lantai 2 • SMK Negeri 1</p>
                    <p class="text-xs text-gray-400 mt-1">Catatan: Tolong antar ke meja paling belakang</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Column - Status Timeline -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl p-5 shadow-md sticky top-24">
            <h3 class="font-bold text-[#1b2563] flex items-center gap-2 mb-5">
                <i class="fas fa-chart-line text-[#730f00]"></i>
                Status Pesanan
            </h3>
            
            <!-- Timeline Progress -->
            <div class="relative">
                <!-- Vertical Line -->
                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                
                <!-- Progress Line (animated) -->
                <div class="absolute left-5 top-0 w-0.5 bg-[#730f00] transition-all duration-500" id="progressLine" style="height: 45%"></div>
                
                <!-- Step 1 -->
                <div class="relative flex items-start gap-4 pb-8 group cursor-pointer" data-step="1">
                    <div class="relative z-10 w-10 h-10 rounded-full bg-[#730f00] text-white flex items-center justify-center shadow-lg step-icon">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-[#1b2563]">Pesanan Dibuat</p>
                        <p class="text-xs text-gray-400">12:30 WIB</p>
                        <p class="text-xs text-green-600 mt-1">✓ Selesai</p>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="relative flex items-start gap-4 pb-8 group cursor-pointer" data-step="2">
                    <div class="relative z-10 w-10 h-10 rounded-full bg-[#730f00] text-white flex items-center justify-center shadow-lg step-icon">
                        <i class="fas fa-credit-card text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-[#1b2563]">Pembayaran Berhasil</p>
                        <p class="text-xs text-gray-400">12:31 WIB</p>
                        <p class="text-xs text-green-600 mt-1">✓ Selesai</p>
                    </div>
                </div>
                
                <!-- Step 3 (Current) -->
                <div class="relative flex items-start gap-4 pb-8 group cursor-pointer" data-step="3">
                    <div class="relative z-10 w-10 h-10 rounded-full bg-[#ffc61a] text-[#1b2563] flex items-center justify-center shadow-lg animate-pulse step-icon">
                        <i class="fas fa-utensils text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-[#1b2563] flex items-center gap-2">
                            Sedang Dimasak
                            <span class="bg-[#ffc61a] text-[10px] px-2 py-0.5 rounded-full animate-pulse">Proses</span>
                        </p>
                        <p class="text-xs text-gray-400">Estimasi selesai: 12:50 WIB</p>
                        <div class="mt-2 bg-gray-100 rounded-full h-1.5 w-full overflow-hidden">
                            <div class="bg-[#ffc61a] h-full rounded-full transition-all duration-1000" style="width: 65%"></div>
                        </div>
                        <p class="text-xs text-[#730f00] mt-1">⏳ 65% • 7 menit lagi</p>
                    </div>
                </div>
                
                <!-- Step 4 -->
                <div class="relative flex items-start gap-4 pb-8 opacity-50 group cursor-pointer" data-step="4">
                    <div class="relative z-10 w-10 h-10 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center shadow step-icon">
                        <i class="fas fa-box-open text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-gray-500">Siap Diambil</p>
                        <p class="text-xs text-gray-400">Menunggu</p>
                    </div>
                </div>
                
                <!-- Step 5 -->
                <div class="relative flex items-start gap-4 opacity-50 group cursor-pointer" data-step="5">
                    <div class="relative z-10 w-10 h-10 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center shadow step-icon">
                        <i class="fas fa-check-double text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-gray-500">Pesanan Selesai</p>
                        <p class="text-xs text-gray-400">Belum</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Action Buttons -->
<div class="grid grid-cols-2 gap-4 mt-6">
    <button class="bg-white border-2 border-[#730f00] text-[#730f00] font-bold py-3 rounded-xl hover:bg-[#730f00] hover:text-white transition flex items-center justify-center gap-2">
        <i class="fas fa-headset"></i> Hubungi Kantin
    </button>
    <button class="btn-primary bg-[#1b2563] text-white font-bold py-3 rounded-xl hover:bg-[#730f00] transition flex items-center justify-center gap-2">
        <i class="fas fa-undo-alt"></i> Batalkan Pesanan
    </button>
</div>

<!-- Estimated Time Banner -->
<div class="mt-5 bg-[#ffc61a]/10 rounded-xl p-4 border border-[#ffc61a]/30">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-[#ffc61a] rounded-full flex items-center justify-center">
            <i class="fas fa-hourglass-half text-[#1b2563]"></i>
        </div>
        <div class="flex-1">
            <p class="text-sm font-semibold text-[#1b2563]">Estimasi Waktu Tiba</p>
            <div class="flex items-center gap-2">
                <span class="text-2xl font-black text-[#730f00]">12:50</span>
                <span class="text-xs text-gray-500">WIB</span>
                <span class="text-xs bg-white px-2 py-0.5 rounded-full text-[#730f00]">+/- 5 menit</span>
            </div>
        </div>
        <i class="fas fa-bell text-[#ffc61a] text-2xl"></i>
    </div>
</div>

<script>
// Animate progress line based on current step
document.addEventListener('DOMContentLoaded', () => {
    const steps = document.querySelectorAll('[data-step]');
    const progressLine = document.getElementById('progressLine');
    const currentStep = 3; // Currently at "Sedang Dimasak"
    const totalSteps = 5;
    const progressPercentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
    
    setTimeout(() => {
        if(progressLine) {
            progressLine.style.height = `${progressPercentage}%`;
        }
    }, 300);
    
    // Auto-refresh simulation (every 10 seconds)
    let timeLeft = 7; // minutes
    const timerElement = document.querySelector('.text-xs.text-[#730f00]');
    
    const interval = setInterval(() => {
        if(timeLeft > 0) {
            timeLeft--;
            if(timerElement) {
                timerElement.textContent = `⏳ ${Math.floor((timeLeft / 7) * 100)}% • ${timeLeft} menit lagi`;
            }
            
            // Update progress bar
            const progressBar = document.querySelector('.bg-gray-100.rounded-full .bg-[#ffc61a]');
            if(progressBar) {
                const newWidth = ((7 - timeLeft) / 7) * 100;
                progressBar.style.width = `${newWidth}%`;
            }
        } else {
            // When cooking is done, move to next step
            clearInterval(interval);
            // Simulate moving to "Siap Diambil"
            const step4 = document.querySelector('[data-step="4"]');
            const step4Icon = step4?.querySelector('.step-icon');
            const step4Text = step4?.querySelector('.font-bold');
            
            if(step4) {
                step4.classList.remove('opacity-50');
                step4Icon?.classList.remove('bg-gray-300', 'text-gray-500');
                step4Icon?.classList.add('bg-[#730f00]', 'text-white');
                step4Text?.classList.remove('text-gray-500');
                step4Text?.classList.add('text-[#1b2563]');
                
                // Update progress line
                if(progressLine) {
                    progressLine.style.height = '75%';
                }
            }
            
            // Update current step indicator
            const currentStepDiv = document.querySelector('[data-step="3"]');
            const currentIcon = currentStepDiv?.querySelector('.step-icon');
            currentIcon?.classList.remove('animate-pulse', 'bg-[#ffc61a]', 'text-[#1b2563]');
            currentIcon?.classList.add('bg-[#730f00]', 'text-white');
            
            const statusBadge = currentStepDiv?.querySelector('.bg-[#ffc61a]');
            if(statusBadge) {
                statusBadge.textContent = 'Selesai';
                statusBadge.classList.remove('animate-pulse', 'bg-[#ffc61a]');
                statusBadge.classList.add('bg-green-500', 'text-white');
            }
        }
    }, 7000); // Update every 7 seconds for demo
    
    // Click handlers for step details
    steps.forEach(step => {
        step.addEventListener('click', () => {
            const stepNum = step.getAttribute('data-step');
            // Show detail modal or additional info
            console.log(`View details for step ${stepNum}`);
        });
    });
});
</script>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(1.05); }
}
.animate-pulse {
    animation: pulse 1.5s ease-in-out infinite;
}
.btn-primary {
    transition: all 0.3s ease;
}
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px -5px rgba(115, 15, 0, 0.3);
}
</style>

@include('layouts.navigation.customer.bottom')