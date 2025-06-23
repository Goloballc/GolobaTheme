{!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.before') !!}

<div class="w-full px-[60px] max-1180:px-8" id="goloba-header">
    <!-- Primera línea del header -->
    <div class="flex min-h-[78px] w-full justify-between items-center">
        <div class="flex items-center gap-x-10 max-[1180px]:gap-x-5">
            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.before') !!}
            <a href="{{ route('shop.home.index') }}" aria-label="@lang('shop::app.components.layouts.header.bagisto')">
                <img src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                     width="131" height="29" alt="{{ config('app.name') }}">
            </a>
            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.after') !!}
        </div>

        <div class="flex-1 flex justify-center">
            <div class="relative w-full max-w-[445px]">
                <form action="{{ route('shop.search.index') }}" class="flex items-center" role="search">
                    <label for="organic-search" class="sr-only">
                        @lang('shop::app.components.layouts.header.search')
                    </label>
                    <div class="icon-search pointer-events-none absolute top-1/2 left-3 -translate-y-1/2 text-xl"></div>
                    <input type="text" name="query" value="{{ request('query') }}"
                           class="block w-full rounded-lg border border-transparent bg-zinc-100 pl-11 pr-11 py-3 text-xs font-medium text-gray-900 transition-all hover:border-gray-400 focus:border-gray-400"
                           minlength="{{ core()->getConfigData('catalog.products.search.min_query_length') }}"
                           maxlength="{{ core()->getConfigData('catalog.products.search.max_query_length') }}"
                           placeholder="@lang('shop::app.components.layouts.header.search-text')"
                           aria-label="@lang('shop::app.components.layouts.header.search-text')" aria-required="true"
                           pattern="[^\]+" required>
                    <button type="submit" class="hidden"
                            aria-label="@lang('shop::app.components.layouts.header.submit')"></button>
                    @if (core()->getConfigData('catalog.products.settings.image_search'))
                        @include('shop::search.images.index')
                    @endif
                </form>
            </div>
        </div>

        <div class="flex items-center gap-x-6 pl-6">
            @if(core()->getConfigData('catalog.products.settings.compare_option'))
                <a href="{{ route('shop.compare.index') }}">
                    <span class="icon-compare text-2xl"></span>
                </a>
            @endif
            @if(core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                @include('shop::checkout.cart.mini-cart')
            @endif
            <x-shop::dropdown position="bottom-right">
                <x-slot:toggle>
                    <span class="icon-users text-2xl cursor-pointer" role="button" tabindex="0"></span>
                </x-slot>
{{-- Guest Dropdown --}}
                @guest('customer')
                    <x-slot:content>
                        <div class="grid gap-2.5">
                            <p class="font-dmserif text-xl">
                                @lang('shop::app.components.layouts.header.welcome-guest')
                            </p>

                            <p class="text-sm">
                                @lang('shop::app.components.layouts.header.dropdown-text')
                            </p>
                        </div>

                        <p class="mt-3 w-full border border-zinc-200"></p>

                        <div class="mt-6 flex gap-4">
                            <a href="{{ route('shop.customer.session.create') }}"
                                class="primary-button m-0 mx-auto block w-max rounded-2xl px-7 text-center text-base max-md:rounded-lg">
                                @lang('shop::app.components.layouts.header.sign-in')
                            </a>

                            <a href="{{ route('shop.customers.register.index') }}"
                                class="secondary-button m-0 mx-auto block w-max rounded-2xl border-2 px-7 text-center text-base max-md:rounded-lg max-md:py-3">
                                @lang('shop::app.components.layouts.header.sign-up')
                            </a>
                        </div>
                    </x-slot>
                @endguest

                {{-- Authenticated Customer Dropdown --}}
                @auth('customer')
                    <x-slot:content class="!p-0">
                        <div class="grid gap-2.5 p-5 pb-0">
                            <p class="font-dmserif text-xl">
                                @lang('shop::app.components.layouts.header.welcome')
                                {{ auth()->guard('customer')->user()->first_name }}
                            </p>

                            <p class="text-sm">
                                @lang('shop::app.components.layouts.header.dropdown-text')
                            </p>
                        </div>

                        <p class="mt-3 w-full border border-zinc-200"></p>

                        <div class="mt-2.5 grid gap-1 pb-2.5">
                            <a class="cursor-pointer px-5 py-2 text-base hover:bg-gray-100"
                                href="{{ route('shop.customers.account.profile.index') }}">
                                @lang('shop::app.components.layouts.header.profile')
                            </a>

                            <a class="cursor-pointer px-5 py-2 text-base hover:bg-gray-100"
                                href="{{ route('shop.customers.account.orders.index') }}">
                                @lang('shop::app.components.layouts.header.orders')
                            </a>

                            @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                                <a class="cursor-pointer px-5 py-2 text-base hover:bg-gray-100"
                                    href="{{ route('shop.customers.account.wishlist.index') }}">
                                    @lang('shop::app.components.layouts.header.wishlist')
                                </a>
                            @endif

                            <x-shop::form method="DELETE" action="{{ route('shop.customer.session.destroy') }}"
                                id="customerLogout" />

                            <a class="cursor-pointer px-5 py-2 text-base hover:bg-gray-100"
                                href="{{ route('shop.customer.session.destroy') }}"
                                onclick="event.preventDefault(); document.getElementById('customerLogout').submit();">
                                @lang('shop::app.components.layouts.header.logout')
                            </a>
                        </div>
                    </x-slot>
                @endauth
            </x-shop::dropdown>
        </div>
    </div>

    <!-- Segunda línea -->
    <div class="flex min-h-[40px] w-full items-center justify-center gap-x-10 max-[1180px]:gap-x-5 pt-2 pb-2">
        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.before') !!}
        <v-desktop-category>
            <div class="shimmer h-6 w-24 rounded" role="presentation"></div>
        </v-desktop-category>
        <a href="#" class="cursor-pointer px-5 text-base font-semibold text-black hover:text-[#e91e63] transition-colors">Ofertas</a>
        <a href="#" class="cursor-pointer px-5 text-base font-semibold text-black hover:text-[#e91e63] transition-colors">Ayuda</a>
        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.after') !!}
    </div>
</div>

@pushOnce('scripts')
<script type="text/x-template" id="v-desktop-category-template">
    <div class="shimmer h-6 w-24 rounded" role="presentation" v-if="isLoading"></div>
    <div class="relative" v-else>
        <div class="group relative flex h-[48px] items-center"
             @mouseenter="showCategories = true"
             @mouseleave="showCategories = false">
            <span ref="categoryButton" class="cursor-pointer px-5 text-base font-semibold text-black hover:text-[#e91e63] transition-colors">Categorías</span>
            <div v-show="showCategories"
                 class="fixed z-[1000] w-[90vw] max-w-[1200px] left-1/2 -translate-x-1/2 shadow-xl"
                 style="top: 135px;">
                <div class="flex">
                    <div class="w-64 bg-pinkGoloba text-white">
                        <ul class="py-4">
                            <li v-for="(category, index) in categories" :key="category.id"
                                @mouseenter="hoveredCategory = index" class="relative">
                                <a :href="category.url" class="block px-6 py-3 text-sm hover:bg-[#d81b60] transition-colors"
                                   :class="{ 'bg-[#d81b60]': hoveredCategory === index }">
                                    @{{ category.name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="flex-1 flex justify-center">
                        <div class="bg-white p-8 w-full overflow-x-auto max-w-[calc(100vw-300px)]">
                            <div v-if="hoveredCategory !== null && categories[hoveredCategory]">
                                <h3 class="text-xl font-bold text-black border-b-2 border-black pb-2 mb-6 inline-block">
                                    @{{ categories[hoveredCategory].name }}
                                </h3>
                                <div class="grid grid-cols-4 gap-8">
                                    <div v-for="secondLevel in categories[hoveredCategory].children" :key="secondLevel.id" class="space-y-2">
                                        <a :href="secondLevel.url"
                                           class="block text-base font-semibold text-gray-900 hover:text-[#e91e63] transition-colors">
                                            @{{ secondLevel.name }}
                                        </a>
                                        <ul v-if="secondLevel.children.length > 0" class="space-y-1">
                                            <li v-for="thirdLevel in secondLevel.children" :key="thirdLevel.id">
                                                <a :href="thirdLevel.url"
                                                   class="block text-sm text-gray-600 hover:text-gray-900 transition-colors">
                                                    @{{ thirdLevel.name }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="text-gray-500 text-center py-8">
                                <p>Selecciona una categoría para ver las subcategorías</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="module">
app.component('v-desktop-category', {
    template: '#v-desktop-category-template',
    data() {
        return {
            isLoading: true,
            categories: [],
            showCategories: false,
            hoveredCategory: null,
            menuTop: 0,
        };
    },
    mounted() {
        this.get();
        this.$nextTick(() => this.updateMenuPosition());
        window.addEventListener('resize', this.updateMenuPosition);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.updateMenuPosition);
    },
    methods: {
        get() {
            this.$axios.get("{{ route('shop.api.categories.tree') }}")
                .then(response => {
                    this.isLoading = false;
                    this.categories = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        updateMenuPosition() {
            const btn = this.$refs.categoryButton;
            if (btn) {
                const rect = btn.getBoundingClientRect();
                this.menuTop = rect.bottom + window.scrollY;
            }
        }
    }
});
</script>
@endPushOnce

{!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.after') !!}
