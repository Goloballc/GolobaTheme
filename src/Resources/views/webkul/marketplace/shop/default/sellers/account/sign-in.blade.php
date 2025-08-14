<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('marketplace::app.shop.sellers.account.login.page-title')"/>

    <meta name="keywords" content="@lang('marketplace::app.shop.sellers.account.login.page-title')"/>
@endPush

<x-marketplace::shop.layouts.full
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
    background-class="bg-transparent"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('marketplace::app.shop.sellers.account.login.page-title')
    </x-slot>

    <!-- Picture Element with Responsive Background -->
    <picture class="fixed inset-0 -z-10">
        <!-- PC/Desktop (1366px+) -->
        <source 
            media="(min-width: 1366px)" 
            srcset="{{ bagisto_asset('images/bg_login_pc.webp') }}"
        >
        
        <!-- Tablet (768px - 1365px) -->
        <source 
            media="(min-width: 768px)" 
            srcset="{{ bagisto_asset('images/bg_login_tablet.webp') }}"
        >
        
        <!-- Mobile (hasta 767px) -->
        <source 
            media="(max-width: 767px)" 
            srcset="{{ bagisto_asset('images/bg_login_mobile.webp') }}"
        >
        
        <!-- Fallback image -->
        <img 
            src="{{ bagisto_asset('images/bg_login_pc.webp') }}" 
            alt="Background" 
            class="h-full w-full object-cover object-top"
        >
    </picture>

    <!-- Picture Element with Responsive Background -->
    <picture class="fixed inset-0 -z-10">
        <!-- PC/Desktop (1366px+) -->
        <source 
            media="(min-width: 1366px)" 
            srcset="{{ bagisto_asset('images/bg_login_pc.webp') }}"
        >
        
        <!-- Tablet (768px - 1365px) -->
        <source 
            media="(min-width: 768px)" 
            srcset="{{ bagisto_asset('images/bg_login_tablet.webp') }}"
        >
        
        <!-- Mobile (hasta 767px) -->
        <source 
            media="(max-width: 767px)" 
            srcset="{{ bagisto_asset('images/bg_login_mobile.webp') }}"
        >
        
        <!-- Fallback image -->
        <img 
            src="{{ bagisto_asset('images/bg_login_pc.webp') }}" 
            alt="Background" 
            class="h-full w-full object-cover object-top"
        >
    </picture>

    <div class="container mt-20 max-1180:px-5 relative z-10">
        {!! view_render_event('marketplace.seller.account.sign_in.logo.before') !!}
        
        <!-- Company Logo -->
        <!-- <div class="flex items-center gap-x-14 max-[1180px]:gap-x-9">
            <a
                href="{{ route('shop.home.index') }}"
                class="m-[0_auto_20px_auto]"
                aria-label="@lang('marketplace::app.shop.sellers.account.login.bagisto')"
            >
                <img
                    src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                    alt="{{ config('app.name') }}"
                    width="131"
                    height="29"
                >
                <h1>Theme</h1>
            </a>
        </div> -->

        {!! view_render_event('marketplace.seller.account.sign_in.logo.after') !!}

        <!-- Form Container -->
        <div
            class="bg-white m-auto w-full max-w-[870px] rounded-xl shadow-md p-16 px-[90px] max-md:px-8 max-md:py-8 max-sm:p-4"
        >
            <h1 class="font-medium text-4xl max-sm:text-2xl text-center">
                @lang('marketplace::app.shop.sellers.account.login.page-title')
            </h1>
            
            <p class="mt-4 text-xl text-[#6E6E6E] max-sm:text-base text-center">
                @lang('marketplace::app.shop.sellers.account.login.form-login-text')
            </p>

            {!! view_render_event('marketplace.seller.account.sign_in.before') !!}
            
            <div class="mt-14 rounded max-sm:mt-8">
                <x-shop::form :action="route('marketplace.seller.session.create')">
                    {!! view_render_event('marketplace.seller.account.sign_in.form_controls.before') !!}
                    
                    <!-- Email -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('marketplace::app.shop.sellers.account.login.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            class="bg-grayGolobaSemiLight !p-[20px_25px] !rounded-full"
                            name="email"
                            rules="required|email"
                            value=""
                            :label="trans('marketplace::app.shop.sellers.account.login.email')"
                            placeholder="email@example.com"
                            aria-label="@lang('marketplace::app.shop.sellers.account.login.email')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="email" />
                    </x-shop::form.control-group>

                    {!! view_render_event('marketplace.seller.account.sign_in.form.email_field.after') !!}

                    <!-- Password -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('marketplace::app.shop.sellers.account.login.password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            class="bg-grayGolobaSemiLight !p-[20px_25px] !rounded-full"
                            id="password"
                            name="password"
                            rules="required|min:6"
                            value=""
                            :label="trans('marketplace::app.shop.sellers.account.login.password')"
                            :placeholder="trans('marketplace::app.shop.sellers.account.login.password')"
                            aria-label="@lang('marketplace::app.shop.sellers.account.login.password')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="password" />
                    </x-shop::form.control-group>

                    {!! view_render_event('marketplace.seller.account.sign_in.form.password_field.after') !!}

                    <div class="flex justify-between">
                        <div class="flex select-none items-center gap-1.5">
                            <input
                                type="checkbox"
                                id="show-password"
                                class="peer hidden"
                                onchange="switchVisibility()"
                            />

                            <label
                                class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-magentaGoloba peer-checked:text-magentaGoloba"
                                for="show-password"
                            ></label>

                            <label
                                class="cursor-pointer select-none text-base text-magentaGoloba max-sm:text-xs ltr:pl-0 rtl:pr-0"
                                for="show-password"
                            >
                                @lang('marketplace::app.shop.sellers.account.login.show-password')
                            </label>
                        </div>

                        {!! view_render_event('marketplace.seller.account.sign_in.form.password_visibility_field.after') !!}

                        <div class="block">
                            <a
                                href="{{ route('marketplace.seller.forgot_password.create') }}"
                                class="cursor-pointer text-base text-magentaGoloba max-sm:text-xs"
                            >
                                <span>
                                    @lang('marketplace::app.shop.sellers.account.login.forgot-pass')
                                </span>
                            </a>
                        </div>

                        {!! view_render_event('marketplace.seller.account.sign_in.form.password_forgot.after') !!}
                    </div>

                    {!! view_render_event('marketplace.seller.account.sign_in.form.password.visibility_forgot.after') !!}

                    <!-- Captcha -->
                    @if (core()->getConfigData('customer.captcha.credentials.status'))
                        <div class="mt-5 flex">
                            {!! Captcha::render() !!}
                        </div>
                    @endif

                    {!! view_render_event('marketplace.seller.account.sign_in.form.captcha.after') !!}

                    <!-- Submit Button -->
                    <div class="mt-8 flex flex-wrap items-center gap-9">
                        <button
                            class="primary-button m-0 block w-full max-w-full rounded-2xl px-11 py-4 text-center text-base ltr:ml-0 rtl:mr-0"
                            type="submit"
                        >
                            @lang('marketplace::app.shop.sellers.account.login.button-title')
                        </button>
                    </div>

                    <?php // {!! view_render_event('marketplace.seller.account.sign_in.form_controls.after') !!} ?>
                </x-shop::form>
            </div>

            {!! view_render_event('marketplace.seller.account.sign_in.after') !!}
            
            <p class="mt-5 font-medium text-[#6E6E6E]">
                @lang('marketplace::app.shop.sellers.account.login.new-seller')

                <a
                    class="text-magentaGoloba"
                    href="{{ route('marketplace.seller.register.create') }}"
                >
                    @lang('marketplace::app.shop.sellers.account.login.create-your-account')
                </a>

                {!! view_render_event('marketplace.seller.account.sign_in.create_your_account.after') !!}
            </p>

            {!! view_render_event('marketplace.seller.account.sign_in.create_your_account.paragraph.after') !!}
        </div>

        {!! view_render_event('marketplace.seller.account.sign_in.form_container.after') !!}

        <p class="mb-4 mt-8 text-center text-xs text-[#6E6E6E]">
            @lang('marketplace::app.shop.sellers.account.login.footer', ['current_year' => date('Y') ])
        </p>

        {!! view_render_event('marketplace.seller.account.sign_in.footer.after') !!}
    </div>

    @push('scripts')
        {!! Captcha::renderJS() !!}

        <script>
            function switchVisibility() {
                let passwordField = document.getElementById("password");

                passwordField.type = passwordField.type === "password"
                    ? "text"
                    : "password";
            }
        </script>
    @endpush
</x-marketplace::shop.layouts.full>