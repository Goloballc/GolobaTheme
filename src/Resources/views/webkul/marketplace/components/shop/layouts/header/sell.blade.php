@if (core()->getConfigData('marketplace.settings.general.status'))
    <a
        href="{{ route('marketplace.seller_central.index') }}"
        aria-label="Sell"
        class="" {{-- Oculto de manera temporal --}}
    >
        <span class="mp-store-icon inline-block cursor-pointer text-[24px]"></span>
    </a>
@endif
