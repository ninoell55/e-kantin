{{-- resources/views/admin/invoice/create.blade.php --}}
{{-- Di-include ke index.blade.php sebagai modal --}}

<div class="modal-backdrop" id="modal-create-invoice">
    <div class="modal" style="max-width: 480px !important;">
        <div class="modal-header">
            <span class="modal-title">Catat Pembayaran Tunai</span>
            <button class="modal-close" onclick="closeModal('modal-create-invoice')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.cash-payment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="_form" value="create-invoice">

            <div class="modal-body">

                @if($errors->any() && old('_form') === 'create-invoice')
                <div class="inv-error-list">
                    <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <div class="inv-form-group">
                    <label class="inv-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <path d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                        Pilih Warung <span class="inv-required">*</span>
                    </label>
                    <select name="shop_id" id="inv-shop-id" class="inv-select" required onchange="fillAmount(this)">
                        <option value="">-- Pilih warung vendor --</option>
                        @foreach($vendors ?? [] as $vendor)
                            @if($vendor->shop)
                            <option value="{{ $vendor->shop->id }}"
                                data-amount="{{ $vendor->shop->currentBill->amount ?? 0 }}"
                                {{ old('_form') === 'create-invoice' && old('shop_id') == $vendor->shop->id ? 'selected' : '' }}>
                                {{ $vendor->shop->name }} — {{ $vendor->name }}
                            </option>
                            @endif
                        @endforeach
                    </select>
                    <p class="inv-hint">Pilih warung yang melakukan pembayaran tunai.</p>
                </div>

                <div class="inv-form-group">
                    <label class="inv-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                        Nominal Pembayaran (Rp) <span class="inv-required">*</span>
                    </label>
                    <div class="inv-input-wrap">
                        <span class="inv-prefix">Rp</span>
                        <input type="number" name="amount" id="inv-amount"
                            class="inv-input"
                            value="{{ old('_form') === 'create-invoice' ? old('amount') : '' }}"
                            placeholder="0" min="1000" required>
                    </div>
                    <p class="inv-hint">Nominal akan otomatis terisi dari tagihan terakhir vendor.</p>
                </div>

                <div class="inv-info-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <div>
                        <strong>Pembayaran Tunai (Cash)</strong><br>
                        Invoice akan langsung berstatus <strong>PAID</strong> dan dicatat pada bulan {{ now()->translatedFormat('F Y') }}.
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="inv-btn-cancel" onclick="closeModal('modal-create-invoice')">Batal</button>
                <button type="submit" class="inv-btn-submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Catat Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .inv-form-group { margin-bottom: 20px !important; }
    .inv-label { display: flex !important; align-items: center !important; gap: 7px !important; font-size: 13px !important; font-weight: 600 !important; color: var(--navy) !important; margin-bottom: 8px !important; }
    .inv-label svg { width: 14px !important; height: 14px !important; color: var(--accent) !important; flex-shrink: 0 !important; }
    .inv-required { color: #dc2626 !important; }
    .inv-select { width: 100% !important; padding: 11px 14px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 10px !important; font-family: var(--font) !important; font-size: 14px !important; color: var(--navy) !important; outline: none !important; background: #fff !important; transition: border-color 0.15s !important; }
    .inv-select:focus { border-color: var(--accent) !important; box-shadow: 0 0 0 3px rgba(61,79,214,0.08) !important; }
    .inv-input-wrap { position: relative !important; display: flex !important; align-items: center !important; }
    .inv-prefix { position: absolute !important; left: 14px !important; font-size: 14px !important; font-weight: 600 !important; color: var(--gray-400) !important; pointer-events: none !important; }
    .inv-input { width: 100% !important; padding: 11px 14px 11px 40px !important; border: 1.5px solid #e8eaf0 !important; border-radius: 10px !important; font-family: var(--font) !important; font-size: 14px !important; color: var(--navy) !important; outline: none !important; background: #fff !important; transition: border-color 0.15s !important; }
    .inv-input:focus { border-color: var(--accent) !important; box-shadow: 0 0 0 3px rgba(61,79,214,0.08) !important; }
    .inv-hint { font-size: 12px !important; color: var(--gray-400) !important; margin-top: 5px !important; }
    .inv-info-box { display: flex !important; gap: 10px !important; padding: 12px 14px !important; background: #e6f7ee !important; border-radius: 10px !important; border: 1px solid #bbf7d0 !important; font-size: 12px !important; color: #15803d !important; line-height: 1.5 !important; margin-top: 4px !important; }
    .inv-info-box svg { width: 16px !important; height: 16px !important; flex-shrink: 0 !important; margin-top: 1px !important; }
    .inv-error-list { background: #fef2f2 !important; color: #dc2626 !important; padding: 12px 16px !important; border-radius: 10px !important; margin-bottom: 16px !important; font-size: 13px !important; }
    .inv-error-list ul { padding-left: 16px !important; }
    .inv-btn-cancel { display: inline-flex !important; align-items: center !important; padding: 10px 18px !important; border: 1px solid #e8eaf0 !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; color: var(--navy) !important; background: #fff !important; cursor: pointer !important; font-family: var(--font) !important; }
    .inv-btn-submit { display: inline-flex !important; align-items: center !important; gap: 8px !important; padding: 10px 20px !important; background: #16a34a !important; color: #fff !important; border-radius: 10px !important; font-size: 14px !important; font-weight: 500 !important; border: none !important; cursor: pointer !important; font-family: var(--font) !important; }
    .inv-btn-submit:hover { opacity: 0.88 !important; }
    .inv-btn-submit svg { width: 15px !important; height: 15px !important; }
</style>