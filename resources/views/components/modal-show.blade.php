<div class="modal-container">
    <a class="button is-info is-inverted open-modal {{ $tooltip ? 'has-tooltip-bottom has-tooltip-arrow has-tooltip-info' : '' }}" data-target="{{ $id }}" data-tooltip="{{ $tooltip }}">
        <i class="{{ $icon }}"></i>
    </a>
    <div class="modal" id="{{ $id }}">
        <div class="modal-background close-modal"></div>
        <div class="modal-content box">
            <p class="subtitle has-text-centered has-text-primary">{{ $title }}</p>
            <div class="divider"></div>
            {{ $slot }}
        </div>
        <button class="modal-close is-large close-modal" aria-label="close"></button>
    </div>
</div>