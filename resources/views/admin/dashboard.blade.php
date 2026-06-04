{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard - Kantin Admin')

@section('content')
<div class="animate-[fadeUp_0.4s_ease_both] w-full text-[#0B132B]">

    {{-- HEADER --}}
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold pt-1 leading-relaxed">
                Hello, {{ Auth::user()->name }}! <span class="inline-block ml-1">👋</span>
            </h1>
            <p class="text-sm text-gray-500">Berikut adalah ringkasan performa e-kantin hari ini.</p>
        </div>
    </div>

    {{-- ================= BARIS 1: STATS & CHART ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-5">
        
        {{-- KIRI: 4 STAT CARDS (Makan 5 Kolom, tanpa h-full supaya tinggi menyesuaikan otomatis) --}}
        <div class="lg:col-span-5 grid grid-cols-1 sm:grid-cols-2 gap-5">

            {{-- Total Pembayaran --}}
            <div class="bg-white rounded-2xl border border-[#e8eaf0] p-5 flex flex-col justify-between transition-all hover:shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wide">Pembayaran</span>
                    <a href="{{ route('admin.invoice.index') }}" class="w-8 h-8 rounded-full flex items-center justify-center bg-[#f4f5f9] text-gray-500 hover:bg-[#730f00] hover:text-white transition-colors">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                        </svg>
                    </a>
                </div>
                <div>
                    <h3 class="text-2xl font-bold pt-1 leading-relaxed">Rp {{ number_format($totalTagihan ?? 0, 0, ',', '.') }}</h3>
                    <span class="text-xs text-gray-400">Bulan ini</span>
                </div>
            </div>

            {{-- Total Penjual --}}
            <div class="bg-white rounded-2xl border border-[#e8eaf0] p-5 flex flex-col justify-between transition-all hover:shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wide">Penjual</span>
                    <a href="{{ route('admin.vendor.index') }}" class="w-8 h-8 rounded-full flex items-center justify-center bg-[#f4f5f9] text-gray-500 hover:bg-[#730f00] hover:text-white transition-colors">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                        </svg>
                    </a>
                </div>
                <div>
                    <h3 class="text-2xl font-bold pt-1 leading-relaxed">{{ $totalPenjual ?? 0 }}</h3>
                    <span class="text-xs text-gray-400">Vendor terdaftar</span>
                </div>
            </div>

            {{-- Total Kategori --}}
            <div class="bg-white rounded-2xl border border-[#e8eaf0] p-5 flex flex-col justify-between transition-all hover:shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wide">Kategori</span>
                    <a href="{{ route('admin.category.index') }}" class="w-8 h-8 rounded-full flex items-center justify-center bg-[#f4f5f9] text-gray-500 hover:bg-[#730f00] hover:text-white transition-colors">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                        </svg>
                    </a>
                </div>
                <div>
                    <h3 class="text-2xl font-bold pt-1 leading-relaxed">{{ $totalKategori ?? 0 }}</h3>
                    <span class="text-xs text-gray-400">Kategori menu</span>
                </div>
            </div>

            {{-- Total Pengguna --}}
            <div class="bg-white rounded-2xl border border-[#e8eaf0] p-5 flex flex-col justify-between transition-all hover:shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wide">Pengguna</span>
                    <a href="{{ route('admin.costumer.index') }}" class="w-8 h-8 rounded-full flex items-center justify-center bg-[#f4f5f9] text-gray-500 hover:bg-[#730f00] hover:text-white transition-colors">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                        </svg>
                    </a>
                </div>
                <div>
                    <h3 class="text-2xl font-bold pt-1 leading-relaxed">{{ $totalPengguna ?? 0 }}</h3>
                    <span class="text-xs text-gray-400">Customer aktif</span>
                </div>
            </div>

        </div>

        {{-- KANAN: BAR CHART (Dengan Fix Tinggi Pasti agar Bar tidak melar) --}}
        <div class="lg:col-span-7 bg-white rounded-2xl border border-[#e8eaf0] p-6 flex flex-col">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-lg font-bold pt-1 leading-relaxed">Pemasukan</h2>
                    <span class="text-xs text-gray-400">Statistik Tahun {{ now()->year }}</span>
                </div>
                <a href="{{ route('admin.invoice.index') }}" class="w-9 h-9 rounded-full bg-[#f4f5f9] flex items-center justify-center text-gray-500 hover:bg-[#730f00] hover:text-white transition-colors">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                    </svg>
                </a>
            </div>
            
            @php
                $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                $chartData   = array_slice($monthlyRevenue ?? array_fill(0, 12, 0), 4, 8);
                $chartMonths = array_slice($months, 4, 8);
                $maxRev = max($chartData) ?: 1;
                $ySteps = [$maxRev, $maxRev * 0.66, $maxRev * 0.33, 0];
            @endphp
            
            {{-- Wrapper chart dengan tinggi fix 240px agar persen height aman --}}
            <div class="flex h-[240px] w-full gap-3 mt-auto">
                <div class="flex flex-col justify-between items-end pb-[26px] text-[10px] text-gray-400 font-semibold py-1 w-9 shrink-0">
                    @foreach($ySteps as $step)
                        <span>{{ $step >= 1000000 ? number_format($step/1000000,1).'M' : number_format($step/1000,0).'K' }}</span>
                    @endforeach
                </div>
                
                <div class="flex-1 relative">
                    <div class="absolute top-0 bottom-[26px] left-0 right-0 flex flex-col justify-between pointer-events-none">
                        <div class="border-t border-dashed border-[#f0f1f5] w-full"></div>
                        <div class="border-t border-dashed border-[#f0f1f5] w-full"></div>
                        <div class="border-t border-dashed border-[#f0f1f5] w-full"></div>
                        <div class="border-t border-dashed border-[#e8eaf0] w-full"></div> </div>
                    
                    <div class="absolute inset-0 flex justify-around">
                        @foreach($chartMonths as $i => $month)
                        @php $pct = ($chartData[$i] / $maxRev) * 100; @endphp
                        <div class="h-full flex flex-col items-center w-10 relative group">
                            
                            <div class="w-full h-[calc(100%-26px)] flex items-end relative z-10 px-1">
                                <div class="hidden group-hover:block absolute bottom-[calc(100%+8px)] left-1/2 -translate-x-1/2 bg-[#0B132B] text-white text-[10px] font-semibold py-1.5 px-2.5 rounded shadow-lg whitespace-nowrap z-50">
                                    Rp {{ number_format($chartData[$i], 0, ',', '.') }}
                                </div>
                                <div class="w-full bg-[#6b8afc] rounded-t-md transition-all duration-1000 ease-out cursor-pointer hover:bg-[#5271e0]" 
                                     data-height="{{ max($pct, 2) }}" 
                                     style="height:0%;"></div>
                            </div>
                            
                            <div class="h-[26px] flex items-end pb-1 justify-center text-[10px] text-gray-400 font-semibold uppercase">
                                {{ $month }}
                            </div>
                            
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ================= BARIS 2: TABLE & DONUT ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
        
        {{-- KIRI BAWAH: VENDOR TABLE --}}
        <div class="lg:col-span-7 bg-white rounded-2xl border border-[#e8eaf0] p-6 flex flex-col">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-lg font-bold pt-1 leading-relaxed">Daftar Vendor & Pembayaran</h2>
                    <span class="text-xs text-gray-400">{{ count($vendors ?? []) }} vendor terdaftar</span>
                </div>
                <a href="{{ route('admin.vendor.index') }}" class="w-9 h-9 rounded-full bg-[#f4f5f9] flex items-center justify-center text-gray-500 hover:bg-[#730f00] hover:text-white transition-colors">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="7 17 17 7 17 17"/><polyline points="7 7 17 7"/>
                    </svg>
                </a>
            </div>
            <div class="overflow-y-auto max-h-[300px] pr-2">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="border-b-[1.5px] border-[#e8eaf0] sticky top-0 bg-white z-10">
                            <th class="py-3 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Vendor</th>
                            <th class="py-3 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nominal</th>
                            <th class="py-3 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors ?? [] as $vendor)
                        @php
                            $bill = $vendor->shop->currentBill ?? null;
                            $bs   = $bill ? $bill->status : 'unpaid';
                            if ($bs === 'unpaid' && $bill && now()->gt(\Carbon\Carbon::parse($bill->due_date))) $bs = 'overdue';
                        @endphp
                        <tr class="border-b border-dashed border-[#f0f1f5] last:border-none hover:bg-gray-50 transition-colors">
                            <td class="py-3.5 align-middle">
                                <div class="font-bold text-[#0B132B] pt-0.5">{{ $vendor->name }}</div>
                                <div class="text-xs text-gray-400">{{ $vendor->shop->name ?? '-' }}</div>
                            </td>
                            <td class="py-3.5 align-middle font-semibold text-gray-600">Rp {{ number_format($bill->amount ?? 0, 0, ',', '.') }}</td>
                            <td class="py-3.5 align-middle">
                                @if($bs === 'paid')
                                    <span class="inline-flex px-2 py-1 rounded-md text-[10px] font-bold bg-green-50 text-green-600 uppercase">PAID</span>
                                @elseif($bs === 'unpaid')
                                    <span class="inline-flex px-2 py-1 rounded-md text-[10px] font-bold bg-yellow-50 text-yellow-600 uppercase">UNPAID</span>
                                @else
                                    <span class="inline-flex px-2 py-1 rounded-md text-[10px] font-bold bg-red-50 text-red-600 uppercase">OVERDUE</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-8 text-gray-400 text-sm">Belum ada vendor terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- KANAN BAWAH: DONUT STATUS PEMBAYARAN --}}
        <div class="lg:col-span-5 bg-white rounded-2xl border border-[#e8eaf0] p-6 flex flex-col">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-lg font-bold pt-1 leading-relaxed">Status Pembayaran</h2>
                    <span class="text-xs text-gray-400">Ringkasan semua tagihan</span>
                </div>
            </div>
            <div class="flex-1 flex flex-col items-center justify-center py-4">
                @php
                    $pc = $paidCount ?? 0; $uc = $unpaidCount ?? 0; $oc = $overdueCount ?? 0;
                    $tot = $pc + $uc + $oc ?: 1;
                    $pPct = round(($pc/$tot)*100); $uPct = round(($uc/$tot)*100); $oPct = round(($oc/$tot)*100);
                    $r=65; $cx=80; $cy=80; $circ=2*M_PI*$r;
                    $pD=($pPct/100)*$circ; $uD=($uPct/100)*$circ; $oD=($oPct/100)*$circ;
                @endphp
                <div class="flex flex-col sm:flex-row items-center justify-center gap-8 w-full">
                    <div class="relative w-[160px] h-[160px] shrink-0">
                        <svg width="160" height="160" viewBox="0 0 160 160" class="-rotate-90">
                            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#f0f1f5" stroke-width="22"/>
                            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#6b8afc" stroke-width="22"
                                stroke-dasharray="{{ $pD }} {{ $circ }}" stroke-dashoffset="0" class="transition-all duration-1000 ease-out"/>
                            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#facc15" stroke-width="22"
                                stroke-dasharray="{{ $uD }} {{ $circ }}" stroke-dashoffset="{{ -$pD }}" class="transition-all duration-1000 ease-out"/>
                            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#f87171" stroke-width="22"
                                stroke-dasharray="{{ $oD }} {{ $circ }}" stroke-dashoffset="{{ -$pD-$uD }}" class="transition-all duration-1000 ease-out"/>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="font-bold text-3xl pt-1 leading-none">{{ $tot == 1 && $pc + $uc + $oc == 0 ? 0 : $tot }}</span>
                            <span class="text-xs text-gray-400 mt-1">Invoice</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 w-full max-w-[130px]">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#6b8afc]"></div>
                                <span class="text-sm font-medium text-gray-600">Lunas</span>
                            </div>
                            <span class="font-bold text-sm">{{ $pPct }}%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#facc15]"></div>
                                <span class="text-sm font-medium text-gray-600">Menunggu</span>
                            </div>
                            <span class="font-bold text-sm">{{ $uPct }}%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#f87171]"></div>
                                <span class="text-sm font-medium text-gray-600">Overdue</span>
                            </div>
                            <span class="font-bold text-sm">{{ $oPct }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animasi naik perlahan untuk bar chart
    setTimeout(() => {
        document.querySelectorAll('[data-height]').forEach((bar) => {
            const h = bar.getAttribute('data-height');
            bar.style.height = h + '%';
        });
    }, 150);
});
</script>
@endsection