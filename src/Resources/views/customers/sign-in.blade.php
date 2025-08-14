<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.customers.login-form.page-title')"/>

    <meta name="keywords" content="@lang('shop::app.customers.login-form.page-title')"/>
@endPush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
    :backgroundClass="'bg-transparent'"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.login-form.page-title')
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

    <div class="container pt-20 max-1180:px-5 max-md:pt-12 relative z-10 flex h-screen">
        {!! view_render_event('bagisto.shop.customers.login.logo.before') !!}

        <!-- Company Logo -->
        <!-- <div class="flex items-center gap-x-14 max-[1180px]:gap-x-9">
            <a
                href="{{ route('shop.home.index') }}"
                class="m-[0_auto_20px_auto]"
                aria-label="@lang('shop::app.customers.login-form.bagisto')"
            >
                <img
                    src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                    alt="{{ config('app.name') }}"
                    width="131"
                    height="29"
                >
            </a>
        </div> -->

        {!! view_render_event('bagisto.shop.customers.login.logo.after') !!}

        <!-- Form Container -->
        <div class="bg-white m-auto w-full max-w-[520px] rounded-[3rem] shadow-md p-16 px-12 max-md:px-8 max-md:py-8 max-sm:p-4">
            <h1 class="font-bold text-center text-magentaGoloba text-3xl max-md:text-3xl max-sm:text-xl">
                @lang('shop::app.customers.login-form.page-title')
            </h1>

            <!-- <p class="mt-4 text-xl text-zinc-500 max-sm:mt-0 max-sm:text-sm">
                @lang('shop::app.customers.login-form.form-login-text')
            </p> -->

            {!! view_render_event('bagisto.shop.customers.login.before') !!}

            <div class="mt-14 rounded max-sm:mt-8">
                <x-shop::form :action="route('shop.customer.session.create')">

                    {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                    <!-- Email -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required font-semibold">
                            @lang('shop::app.customers.login-form.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            class="bg-grayGolobaSemiLight px-6 py-4 max-md:py-3 max-sm:py-2 !rounded-full"
                            name="email"
                            rules="required|email"
                            value=""
                            :label="trans('shop::app.customers.login-form.email')"
                            placeholder="email@example.com"
                            :aria-label="trans('shop::app.customers.login-form.email')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="email" />
                    </x-shop::form.control-group>

                    <!-- Password -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required font-semibold">
                            @lang('shop::app.customers.login-form.password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            class="bg-grayGolobaSemiLight px-6 py-4 max-md:py-3 max-sm:py-2 !rounded-full"
                            id="password"
                            name="password"
                            rules="required|min:6"
                            value=""
                            :label="trans('shop::app.customers.login-form.password')"
                            :placeholder="trans('shop::app.customers.login-form.password')"
                            :aria-label="trans('shop::app.customers.login-form.password')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="password" />
                    </x-shop::form.control-group>

                    <div class="flex justify-between max-sm:justify-center max-sm:gap-4 max-sm:flex-wrap">
                        <div class="flex select-none items-center gap-1.5">
                            <input
                                type="checkbox"
                                id="show-password"
                                class="peer hidden"
                                onchange="switchVisibility()"
                            />

                            <label
                                class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-navyBlue peer-checked:text-navyBlue max-sm:text-xl"
                                for="show-password"
                            ></label>

                            <label
                                class="cursor-pointer select-none text-base text-zinc-500 max-sm:text-sm ltr:pl-0 rtl:pr-0"
                                for="show-password"
                            >
                                @lang('shop::app.customers.login-form.show-password')
                            </label>
                        </div>

                        <div class="block">
                            <a
                                href="{{ route('shop.customers.forgot_password.create') }}"
                                class="cursor-pointer text-base text-magentaGoloba max-sm:text-sm"
                            >
                                <span>
                                    @lang('shop::app.customers.login-form.forgot-pass')
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Captcha -->
                    @if (core()->getConfigData('customer.captcha.credentials.status'))
                        <div class="mt-5 flex">
                            {!! Captcha::render() !!}
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="mt-8 flex flex-wrap items-center gap-9 max-sm:justify-center max-sm:gap-5 max-sm:text-center">
                        <button
                            class="primary-button m-0 mx-auto block w-full max-w-full rounded-2xl px-11 py-4 text-center text-base max-md:max-w-full max-md:rounded-lg max-md:py-3 max-sm:py-1.5 ltr:ml-0 rtl:mr-0"
                            type="submit"
                        >
                            @lang('shop::app.customers.login-form.button-title')
                        </button>

                       <?php // {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!} ?>
                    </div>
                </x-shop::form>
            </div>

            {!! view_render_event('bagisto.shop.customers.login.after') !!}

            <p class="mt-5 font-medium text-zinc-500 max-sm:text-center max-sm:text-sm">
                @lang('shop::app.customers.login-form.new-customer')

                <a
                    class="text-magentaGoloba"
                    href="{{ route('shop.customers.register.index') }}"
                >
                    @lang('shop::app.customers.login-form.create-your-account')
                </a>
            </p>
        </div>

        <!-- <p class="mb-4 mt-8 text-center text-xs text-zinc-500">
            @lang('shop::app.customers.login-form.footer', ['current_year'=> date('Y') ])
        </p> -->
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
</x-shop::layouts>