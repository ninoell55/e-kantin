{{-- resources/views/admin/costumer/detail.blade.php --}}
{{-- Di-include ke index.blade.php sebagai modal --}}

<div class="modal-backdrop" id="modal-detail">
    <div class="modal" style="max-width: 480px !important;">
        <div class="modal-header">
            <span class="modal-title">Detail Customer</span>
            <button class="modal-close" onclick="closeModal('modal-detail')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="detail-header-modal">
            <div class="detail-avatar" id="detail-avatar"></div>
            <div class="detail-name" id="detail-name"></div>
            <div class="detail-email" id="detail-email"></div>
        </div>

        <div class="detail-body-modal">
            <div class="detail-row">
                <span class="detail-label">ID Number</span>
                <span class="detail-value"><span class="id-badge" id="detail-id-number"></span></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Role</span>
                <span class="detail-value" id="detail-role"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value" id="detail-status"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">WhatsApp</span>
                <span class="detail-value" id="detail-phone"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Bergabung</span>
                <span class="detail-value" id="detail-joined"></span>
            </div>
        </div>

        <div class="modal-footer" style="justify-content: space-between !important;">
            <button class="btn-cancel" onclick="closeModal('modal-detail')">Tutup</button>
            <button id="detail-toggle-btn" class="btn-action-detail"
                data-id="" data-name="" data-action=""
                onclick="openToggleModal(this)">
            </button>
        </div>
    </div>
</div>