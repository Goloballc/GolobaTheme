<!-- SEO Meta Content -->
@push('meta')
    <meta
        name="description"
        content="@lang('shop::app.customers.signup-form.page-title')"
    />

    <meta
        name="keywords"
        content="@lang('shop::app.customers.signup-form.page-title')"
    />
@endPush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
    background-class="bg-transparent"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.signup-form.page-title')
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

	<div class="container mt-20 max-1180:px-5 max-md:mt-12 relative z-10">
        {!! view_render_event('bagisto.shop.customers.sign-up.logo.before') !!}

        <!-- Company Logo -->
        <!-- <div class="flex items-center gap-x-14 max-[1180px]:gap-x-9">
            <a
                href="{{ route('shop.home.index') }}"
                class="m-[0_auto_20px_auto]"
                aria-label="@lang('shop::app.customers.signup-form.bagisto')"
            >
                <img
                    src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                    alt="{{ config('app.name') }}"
                    width="131"
                    height="29"
                >
            </a>
        </div> -->

        {!! view_render_event('bagisto.shop.customers.sign-up.logo.before') !!}

        <!-- Form Container -->
		<div class="bg-white m-auto w-full max-w-[870px] rounded-xl shadow-md p-16 px-[90px] max-md:px-8 max-md:py-8 max-sm:border-none max-sm:p-4">
			<h1 class="font-medium text-center text-4xl max-md:text-3xl max-sm:text-xl">
                @lang('shop::app.customers.signup-form.page-title')
            </h1>

			<p class="mt-4 text-xl text-center text-zinc-500 max-sm:mt-0 max-sm:text-sm">
                @lang('shop::app.customers.signup-form.form-signup-text')
            </p>

            <div class="mt-14 rounded max-sm:mt-8">
                <!-- Usar formulario que permite errores del servidor -->
                <x-shop::form 
                    :action="route('shop.customers.register.store')"
                    method="POST"
                >
                    {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.signup-form.first-name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            class="bg-grayGolobaSemiLight px-6 py-4 max-md:py-3 max-sm:py-2 !rounded-full"
                            name="first_name"
                            rules="required"
                            :value="old('first_name')"
                            :label="trans('shop::app.customers.signup-form.first-name')"
                            :placeholder="trans('shop::app.customers.signup-form.first-name')"
                            :aria-label="trans('shop::app.customers.signup-form.first-name')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="first_name" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.first_name.after') !!}

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.signup-form.last-name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            class="bg-grayGolobaSemiLight px-6 py-4 max-md:py-3 max-sm:py-2 !rounded-full"
                            name="last_name"
                            rules="required"
                            :value="old('last_name')"
                            :label="trans('shop::app.customers.signup-form.last-name')"
                            :placeholder="trans('shop::app.customers.signup-form.last-name')"
                            :aria-label="trans('shop::app.customers.signup-form.last-name')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="last_name" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.last_name.after') !!}

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.signup-form.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            class="bg-grayGolobaSemiLight px-6 py-4 max-md:py-3 max-sm:py-2 !rounded-full"
                            name="email"
                            rules="required|email"
                            :value="old('email')"
                            :label="trans('shop::app.customers.signup-form.email')"
                            placeholder="email@example.com"
                            :aria-label="trans('shop::app.customers.signup-form.email')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="email" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.email.after') !!}

                    <x-shop::form.control-group class="mb-6">
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.signup-form.password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            class="bg-grayGolobaSemiLight px-6 py-4 max-md:py-3 max-sm:py-2 !rounded-full"
                            name="password"
                            rules="required|min:6"
                            :value="old('password')"
                            :label="trans('shop::app.customers.signup-form.password')"
                            :placeholder="trans('shop::app.customers.signup-form.password')"
                            ref="password"
                            :aria-label="trans('shop::app.customers.signup-form.password')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="password" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.password.after') !!}

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label>
                            @lang('shop::app.customers.signup-form.confirm-pass')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            class="bg-grayGolobaSemiLight px-6 py-4 max-md:py-3 max-sm:py-2 !rounded-full"
                            name="password_confirmation"
                            rules="confirmed:@password"
                            value=""
                            :label="trans('shop::app.customers.signup-form.password')"
                            :placeholder="trans('shop::app.customers.signup-form.confirm-pass')"
                            :aria-label="trans('shop::app.customers.signup-form.confirm-pass')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="password_confirmation" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.password_confirmation.after') !!}

                    <!-- Campo de Teléfono -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.signup-form.phone')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="tel"
                            class="bg-grayGolobaSemiLight px-6 py-4 max-md:py-3 max-sm:py-2 !rounded-full"
                            name="phone"
                            rules="required|phone|max:20"
                            :value="old('phone')"
                            :label="trans('shop::app.customers.signup-form.phone')"
                            :placeholder="trans('shop::app.customers.signup-form.phone')"
                            :aria-label="trans('shop::app.customers.signup-form.phone')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="phone" />
                        
                        @error('phone')
                            <div class="text-red-500 text-xs italic mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </x-shop::form.control-group>

                    <!-- Campo de Instagram URL -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label>
                            @lang('shop::app.customers.signup-form.instagram-url')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="url"
                            class="bg-grayGolobaSemiLight px-6 py-4 max-md:py-3 max-sm:py-2 !rounded-full"
                            name="instagram_url"
                            rules="url|max:255"
                            :value="old('instagram_url')"
                            :label="trans('shop::app.customers.signup-form.instagram-url')"
                            placeholder="https://instagram.com/tu_usuario"
                            :aria-label="trans('shop::app.customers.signup-form.instagram-url')"
                        />

                        <x-shop::form.control-group.error control-name="instagram_url" />
                    </x-shop::form.control-group>

                    @if (core()->getConfigData('customer.captcha.credentials.status'))
                        <div class="mb-5 flex">
                            {!! Captcha::render() !!}
                        </div>
                    @endif

                    @if (core()->getConfigData('customer.settings.create_new_account_options.news_letter'))
                        <div class="flex select-none items-center gap-1.5">
                            <input
                                type="checkbox"
                                name="is_subscribed"
                                id="is-subscribed"
                                class="peer hidden"
                            />

                            <label
                                class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-magentaGoloba peer-checked:text-magentaGoloba max-sm:text-xl"
                                for="is-subscribed"
                            ></label>

                            <label
                                class="cursor-pointer select-none text-base text-magentaGoloba max-sm:text-sm ltr:pl-0 rtl:pr-0"
                                for="is-subscribed"
                            >
                                @lang('shop::app.customers.signup-form.subscribe-to-newsletter')
                            </label>
                        </div>
                    @endif
                    <!-- Checkbox: Aceptar política -->
                    <x-shop::form.control-group>
                        <div class="flex select-none items-center gap-1.5 mt-4">
                            <x-shop::form.control-group.control
                                type="checkbox"
                                name="accept_policy"
                                id="accept-policy"
                                value="1"
                                rules="required"
                                :label="trans('shop::app.customers.signup-form.accept-policy')"
                                :checked="old('accept_policy')"
                            />
                            <label
                                class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-magentaGoloba peer-checked:text-magentaGoloba max-sm:text-xl"
                                for="accept-policy"
                            ></label>
                            
                            <label
                                class="cursor-pointer select-none text-base text-magentaGoloba max-sm:text-sm ltr:pl-0 rtl:pr-0"
                                for="accept-policy"
                            >
                                @lang('shop::app.customers.signup-form.accept-policy')
                            </label>
                        </div>
                        
                        <x-shop::form.control-group.error control-name="accept_policy" />
                    </x-shop::form.control-group>
                    
                    <!-- Checkbox: Mayor de edad -->
                    <x-shop::form.control-group>
                        <div class="flex select-none items-center gap-1.5 mt-4">
                            <x-shop::form.control-group.control
                                type="checkbox"
                                name="is_adult"
                                id="is-adult"
                                value="1"
                                rules="required"
                                :label="trans('shop::app.customers.signup-form.is-adult')"
                                :checked="old('is_adult')"
                            />

                            <label
                                class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-magentaGoloba peer-checked:text-magentaGoloba max-sm:text-xl"
                                for="is-adult"
                            ></label>
                            
                            <label
                                class="cursor-pointer select-none text-base text-magentaGoloba max-sm:text-sm ltr:pl-0 rtl:pr-0"
                                for="is-adult"
                            >
                                @lang('shop::app.customers.signup-form.is-adult')
                            </label>
                        </div>
                        
                        <x-shop::form.control-group.error control-name="is_adult" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.newsletter_subscription.after') !!}

                    <div class="mt-8 flex flex-wrap items-center gap-9 max-sm:justify-center max-sm:gap-5">
                        <button
                            class="primary-button m-0 mx-auto block w-full max-w-full rounded-2xl px-11 py-4 text-center text-base max-md:max-w-full max-md:rounded-lg max-md:py-3 max-sm:py-1.5 ltr:ml-0 rtl:mr-0"
                            type="submit"
                        >
                            @lang('shop::app.customers.signup-form.button-title')
                        </button>

                        <!-- <div class="flex flex-wrap gap-4"> -->
                            <?php // {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!} ?>
                        <!-- </div> -->
                    </div>

                    {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}

                </x-shop::form>
            </div>

			<p class="mt-5 font-medium text-zinc-500 max-sm:text-center max-sm:text-sm">
                @lang('shop::app.customers.signup-form.account-exists')

                <a class="text-magentaGoloba"
                    href="{{ route('shop.customer.session.index') }}"
                >
                    @lang('shop::app.customers.signup-form.sign-in-button')
                </a>
            </p>
		</div>

        <!-- <p class="mb-4 mt-8 text-center text-xs text-zinc-500">
            @lang('shop::app.customers.signup-form.footer', ['current_year'=> date('Y') ])
        </p> -->
	</div>

    @push('scripts')
        {!! Captcha::renderJS() !!}
    @endpush
</x-shop::layouts>