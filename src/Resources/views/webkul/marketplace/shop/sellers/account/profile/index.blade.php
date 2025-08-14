@php
    $seller = auth()->guard('seller')->user();
@endphp

<x-marketplace::shop.layouts>
    <!-- Page Title -->
    <x-slot:title>
        @lang('marketplace::app.shop.sellers.account.manage-profile.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @section('breadcrumbs')
        <x-marketplace::shop.breadcrumbs name="seller_profile" />
    @endsection

    {!! view_render_event('marketplace.seller.account.profile.edit.before', ['seller' => $seller]) !!}

    <!-- Profile Edit Form -->
    <x-marketplace::shop.form
        :action="route('goloba-theme.marketplace.seller.account.profile.update', $seller->seller_id)"
        enctype="multipart/form-data"
    >
        @method('PUT')

        {!! view_render_event('marketplace.seller.account.profile.edit.edit_form_controls.before', ['seller' => $seller]) !!}

        <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
            <p class="text-2xl font-medium">
                @lang('marketplace::app.shop.sellers.account.manage-profile.title')
            </p>

            <div class="flex items-center gap-x-2.5 text-center">
                {!! view_render_event('marketplace.seller.account.profile.edit.button.before', ['seller' => $seller]) !!}
                
                <!-- Collection Button -->
                <a
                    href="{{route('marketplace.seller.show', $seller->shop_url)}}"
                    class="secondary-button px-5 py-2.5"
                >
                    @lang('marketplace::app.shop.sellers.account.manage-profile.collection-page')
                </a>

                <!-- Seller Button -->
                <a
                    href="{{route('marketplace.seller_central.index')}}"
                    class="secondary-button px-5 py-2.5"
                >
                    @lang('marketplace::app.shop.sellers.account.manage-profile.seller-page')
                </a>

                <!-- Update Button -->
                @if (seller()->hasPermission('profile.update'))
                    <button class="primary-button px-5 py-2.5">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.save-btn')
                    </button>
                @endif

                {!! view_render_event('marketplace.seller.account.profile.edit.button.after', ['seller' => $seller]) !!}
            </div>
        </div>

        <v-seller-banner-logo>
            <!-- Banner -->
            <div class="mb-7 mt-8 h-[250px] md:h-[306px]">
                <x-shop::media.images.lazy
                    class="h-[250px] w-full object-cover md:h-[306px] md:rounded-lg"
                    alt="marketplace banner"
                    width="1140"
                    height="306"
                />
            </div>

            <!-- Logo -->
            <div class="flex gap-2">
                <div class="relative max-h-20 min-w-20 max-w-20 rounded-xl border border-[#E9E9E9]">
                    <x-shop::media.images.lazy
                        class="h-20 max-h-20 min-w-20 max-w-20 rounded-xl object-cover"
                        alt="seller logo"
                        width="80"
                        height="80"
                    />
                </div>

                <div class="grid">
                    <h1 class="text-3xl font-medium leading-[48px]">
                        {{$seller->shop_title}}
                    </h1>
                    
                    <h6 class="text-base font-medium leading-6 text-[#757575]">
                        {{ $seller->full_address }}
                    </h6>
                </div>
            </div>
        </v-seller-banner-logo>
        
        <!-- Full Pannel -->
        <div class="mt-3.5 flex gap-6 max-xl:flex-wrap">
            <!-- Left Section -->
            <div class="flex flex-1 flex-col gap-6 max-xl:flex-auto">
                <!-- Shop Information -->
                <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">

                    <h3 class="mb-6 text-xl font-medium leading-8 text-navyBlue">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.shop.general-info')
                    </h3>
                    
                    {!! view_render_event('marketplace.seller.account.profile.edit.shop_title_field.before', ['seller' => $seller]) !!}
                    
                    <!-- Shop Title -->
                    <div class="flex gap-4 max-sm:flex-wrap">
                        <x-marketplace::shop.form.control-group class="w-full">
                            <x-marketplace::shop.form.control-group.label class="required">
                                @lang('marketplace::app.shop.sellers.account.manage-profile.shop.shop-title')
                            </x-marketplace::shop.form.control-group.label>

                            <x-marketplace::shop.form.control-group.control
                                type="text"
                                name="shop_title"
                                :value="old('shop_title') ?: $seller->shop_title"
                                rules="required"
                                :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.shop-title')"
                                :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.shop-title')"
                            />

                            <x-marketplace::shop.form.control-group.error control-name="shop_title" />
                        </x-marketplace::shop.form.control-group>
                    </div>

                    {!! view_render_event('marketplace.seller.account.profile.edit.shop_title_field.after', ['seller' => $seller]) !!}
                    
                    <!-- Shop URL -->
                    <div class="flex gap-4 max-sm:flex-wrap">
                        <x-marketplace::shop.form.control-group class="w-full">
                            <x-marketplace::shop.form.control-group.label class="required">
                                @lang('marketplace::app.shop.sellers.account.manage-profile.shop.url')
                            </x-marketplace::shop.form.control-group.label>

                            <x-marketplace::shop.form.control-group.control
                                type="text"
                                name="url"
                                :value="old('url') ?: $seller->shop_url"
                                rules="required"
                                :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.url')"
                                :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.url')"
                            />

                            <x-marketplace::shop.form.control-group.error control-name="url" />
                        </x-marketplace::shop.form.control-group>
                    </div>

                    {!! view_render_event('marketplace.seller.account.profile.edit.url_field.after', ['seller' => $seller]) !!}

                    <div class="flex gap-4 max-sm:flex-wrap">
                        <!-- Name -->
                        <x-marketplace::shop.form.control-group class="w-full">
                            <x-marketplace::shop.form.control-group.label class="required">
                                @lang('marketplace::app.shop.sellers.account.manage-profile.shop.name')
                            </x-marketplace::shop.form.control-group.label>

                            <x-marketplace::shop.form.control-group.control
                                type="text"
                                name="name"
                                rules="required"
                                :value="old('name') ?: $seller->name"
                                :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.name')"
                                :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.name')"
                            />

                            <x-marketplace::shop.form.control-group.error control-name="name" />
                        </x-marketplace::shop.form.control-group>
                    </div>

                    {!! view_render_event('marketplace.seller.account.profile.edit.name_field.after', ['seller' => $seller]) !!}

                    <div class="flex gap-4 max-sm:flex-wrap">
                        <!-- Email -->
                        <x-marketplace::shop.form.control-group class="w-full">
                            <x-marketplace::shop.form.control-group.label class="required">
                                @lang('marketplace::app.shop.sellers.account.manage-profile.shop.email')
                            </x-marketplace::shop.form.control-group.label>

                            <x-marketplace::shop.form.control-group.control
                                type="text"
                                name="email"
                                rules="required"
                                :value="old('email') ?: $seller->email"
                                :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.email')"
                                :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.email')"
                            />

                            <x-marketplace::shop.form.control-group.error control-name="email" />
                        </x-marketplace::shop.form.control-group>
                    </div>

                    {!! view_render_event('marketplace.seller.account.profile.edit.email_field.after', ['seller' => $seller]) !!}

                    <!-- Phone -->
                    <div class="flex gap-4 max-sm:flex-wrap">
                        <x-marketplace::shop.form.control-group class="w-full">
                            <x-marketplace::shop.form.control-group.label class="required">
                                @lang('marketplace::app.shop.sellers.account.manage-profile.shop.phone-number')
                            </x-marketplace::shop.form.control-group.label>

                            <x-marketplace::shop.form.control-group.control
                                type="text"
                                name="phone"
                                :value="old('phone') ?: $seller->phone"
                                rules="required|numeric"
                                :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.phone-number')"
                                :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.phone-number')"
                            />
                            <x-marketplace::shop.form.control-group.error control-name="phone" />
                        </x-marketplace::shop.form.control-group>
                    </div>
                </div>

                {!! view_render_event('marketplace.seller.account.profile.edit.phone_field.after', ['seller' => $seller]) !!}

                <!-- Información fiscal y documentos -->
                <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">
                    <h3 class="mb-6 text-xl font-medium leading-8 text-navyBlue">
                        Información fiscal y documentos
                    </h3>
                    <div class="flex gap-4 max-sm:flex-wrap">
                        <x-marketplace::shop.form.control-group class="w-full">
                            <x-marketplace::shop.form.control-group.label class="required">
                                Régimen
                            </x-marketplace::shop.form.control-group.label>

                            <x-marketplace::shop.form.control-group.control
                                type="select"
                                name="regime"
                                rules="required"
                                :value="$seller->regime"
                            >
                                <option value="">Selecciona un régimen</option>
                                <option value="Régimen simple" selected>Régimen simple</option>
                                <option value="Común">Común</option>
                                <option value="Gran contribuyente">Gran contribuyente</option>
                            </x-marketplace::shop.form.control-group.control>
                        </x-marketplace::shop.form.control-group>  
                    </div>
                    <div class="flex gap-4 max-sm:flex-wrap mt-8">
                        <div class="mb-4 w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-700">
                                Cedula de ciudadanía
                            </label>
                            <div class="space-y-4">
                                <v-file-upload
                                    ref="fileUpload"
                                    :multiple="true"
                                    :max-file-size="10485760"
                                    name="citizenship_card"
                                    :current-file="'{{ $seller->citizenship_card }}'"
                                    accepted-types="image/*,.pdf,.doc,.docx"
                                    upload-url="/api/files/upload"
                                    @files-selected="onFilesSelected"
                                    @upload-success="onUploadSuccess"
                                    @upload-error="onUploadError"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4 max-sm:flex-wrap">
                        <div class="mb-4 w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-700">
                                RUT
                            </label>
                            <div class="space-y-4">
                                <v-file-upload
                                    ref="fileUpload"
                                    :multiple="true"
                                    :max-file-size="10485760"
                                    name="rut"
                                    :current-file="'{{ $seller->rut }}'"
                                    accepted-types="image/*,.pdf,.doc,.docx"
                                    upload-url="/api/files/upload"
                                    @files-selected="onFilesSelected"
                                    @upload-success="onUploadSuccess"
                                    @upload-error="onUploadError"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4 max-sm:flex-wrap">
                        <div class="mb-4 w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-700">
                                Certificación bancaria expedido por entidad financiera (No mayor a 30 días)
                            </label>
                            <div class="space-y-4">
                                <v-file-upload
                                    ref="fileUpload"
                                    :multiple="true"
                                    :max-file-size="10485760"
                                    name="bank_certification"
                                    :current-file="'{{ $seller->bank_certification }}'"
                                    accepted-types="image/*,.pdf,.doc,.docx"
                                    upload-url="/api/files/upload"
                                    @files-selected="onFilesSelected"
                                    @upload-success="onUploadSuccess"
                                    @upload-error="onUploadError"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">

                    <h3 class="mb-6 text-xl font-medium leading-8 text-navyBlue">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.shop.about-store')
                    </h3>

                    <x-marketplace::shop.form.control-group>
                        <x-marketplace::shop.form.control-group.label class="required">
                            @lang('marketplace::app.shop.sellers.account.manage-profile.shop.about-store')
                        </x-marketplace::shop.form.control-group.label>

                        <x-marketplace::shop.form.control-group.control
                            type="textarea"
                            name="description"
                            :value="old('description') ?: $seller->description"
                            id="content"
                            rules="required"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.about-store')"
                            :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.about-store')"
                            :tinymce="true"
                        />

                        <x-marketplace::shop.form.control-group.error control-name="description" />
                    </x-marketplace::shop.form.control-group>
                </div>

                {!! view_render_event('marketplace.seller.account.profile.edit.description_field.after', ['seller' => $seller]) !!}

                <!-- Meta Information -->
                <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">

                    <h3 class="mb-6 text-xl font-medium leading-8 text-navyBlue">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.meta-info.title')
                    </h3>

                    <x-marketplace::shop.form.control-group>
                        <x-marketplace::shop.form.control-group.label>
                            @lang('marketplace::app.shop.sellers.account.manage-profile.meta-info.meta-title')
                        </x-marketplace::shop.form.control-group.label>

                        <x-marketplace::shop.form.control-group.control
                            type="text"
                            name="meta_title"
                            id="meta_title"
                            :value="old('meta_title') ?: $seller->meta_title"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.meta-info.meta-title')"
                            placeholder="Título que verán los clientes al buscar tus productos"
                        />

                        <x-marketplace::shop.form.control-group.error control-name="meta_title" />
                    </x-marketplace::shop.form.control-group>

                    <x-marketplace::shop.form.control-group>
                        <x-marketplace::shop.form.control-group.label>
                            @lang('marketplace::app.shop.sellers.account.manage-profile.meta-info.meta-keyword')
                        </x-marketplace::shop.form.control-group.label>

                        <x-marketplace::shop.form.control-group.control
                            type="text"
                            name="meta_keywords"
                            id="meta_keywords"
                            :value="old('meta_keywords') ?: $seller->meta_keywords"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.meta-info.meta-keyword')"
                            placeholder="Palabra o frase que tus clientes usarían para encontrar este producto"
                        />

                        <x-marketplace::shop.form.control-group.error control-name="meta_keywords" />
                    </x-marketplace::shop.form.control-group>

                    <x-marketplace::shop.form.control-group>
                        <x-marketplace::shop.form.control-group.label>
                            @lang('marketplace::app.shop.sellers.account.manage-profile.meta-info.meta-description')
                        </x-marketplace::shop.form.control-group.label>

                        <x-marketplace::shop.form.control-group.control
                            type="textarea"
                            name="meta_description"
                            id="meta_description"
                            :value="old('meta_description') ?: $seller->meta_description"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.meta-info.meta-description')"
                            placeholder="Describe el producto para atraer a los clientes"
                        />

                        <x-marketplace::shop.form.control-group.error control-name="meta_description" />
                    </x-marketplace::shop.form.control-group>
                </div>

                {!! view_render_event('marketplace.seller.account.profile.edit.meta_title_field.after', ['seller' => $seller]) !!}
                
                <!-- Policy -->
                {{-- <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">
                    <h3 class="mb-6 text-xl font-medium leading-8 text-navyBlue">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.policy.title')
                    </h3>

                    <x-marketplace::shop.form.control-group>
                        <x-marketplace::shop.form.control-group.label>
                            @lang('marketplace::app.shop.sellers.account.manage-profile.policy.privacy')
                        </x-marketplace::shop.form.control-group.label>

                        <x-marketplace::shop.form.control-group.control
                            type="textarea"
                            name="privacy_policy"
                            id="privacy_policy"
                            :value="old('privacy_policy') ?: $seller->privacy_policy"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.policy.privacy')"
                            :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.policy.privacy')"
                            :tinymce="true"
                        />

                        <x-marketplace::shop.form.control-group.error control-name="privacy_policy" />
                    </x-marketplace::shop.form.control-group>

                    {!! view_render_event('marketplace.seller.account.profile.edit.privacy_policy_field.after', ['seller' => $seller]) !!}

                    <x-marketplace::shop.form.control-group>
                        <x-marketplace::shop.form.control-group.label>
                            @lang('marketplace::app.shop.sellers.account.manage-profile.policy.shipping')
                        </x-marketplace::shop.form.control-group.label>

                        <x-marketplace::shop.form.control-group.control
                            type="textarea"
                            name="shipping_policy"
                            id="shipping_policy"
                            :value="old('privacy_policy') ?: $seller->privacy_policy"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.policy.shipping')"
                            :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.policy.shipping')"
                            :tinymce="true"
                        />

                        <x-marketplace::shop.form.control-group.error control-name="shipping_policy" />
                    </x-marketplace::shop.form.control-group>

                    {!! view_render_event('marketplace.seller.account.profile.edit.shipping_policy_field.after', ['seller' => $seller]) !!}

                    <x-marketplace::shop.form.control-group>
                        <x-marketplace::shop.form.control-group.label>
                            @lang('marketplace::app.shop.sellers.account.manage-profile.policy.return')
                        </x-marketplace::shop.form.control-group.label>

                        <x-marketplace::shop.form.control-group.control
                            type="textarea"
                            name="return_policy"
                            id="return_policy"
                            :value="old('return_policy') ?: $seller->return_policy"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.policy.return')"
                            :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.policy.return')"
                            :tinymce="true"
                        />

                        <x-marketplace::shop.form.control-group.error control-name="return_policy" />
                    </x-marketplace::shop.form.control-group>

                    {!! view_render_event('marketplace.seller.account.profile.edit.return_policy_field.after', ['seller' => $seller]) !!}
                </div>

                {!! view_render_event('marketplace.seller.account.profile.edit.policy_fields.after', ['seller' => $seller]) !!} --}}
            </div>

<!-- Right Section -->
            <div class="flex w-[360px] max-w-full flex-col gap-6 max-xl:flex-auto">
                {!! view_render_event('marketplace.seller.account.profile.edit.address_container.before', ['seller' => $seller]) !!}
                
                <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">
                    <h3 class="mb-6 text-xl font-medium leading-8 text-navyBlue">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.shop.store-address')
                    </h3>

                    {!! view_render_event('marketplace.seller.account.profile.edit.address_fields.before', ['seller' => $seller]) !!}

<!-- Country, Departamento (State) y Ciudad con Código DANE -->
<div class="flex gap-4 max-sm:flex-wrap">
    <x-marketplace::shop.form.control-group class="w-full">
        <x-marketplace::shop.form.control-group.label class="required">
            País
        </x-marketplace::shop.form.control-group.label>

        <x-marketplace::shop.form.control-group.control
            type="select"
            name="country"
            rules="required"
            :value="'CO'"
            
        >
            <option value="CO" selected>Colombia</option>
        </x-marketplace::shop.form.control-group.control>

        <x-marketplace::shop.form.control-group.error control-name="country" />
    </x-marketplace::shop.form.control-group>
</div>

<!-- Departamento -->
<div class="flex gap-4 max-sm:flex-wrap">
    <x-marketplace::shop.form.control-group class="w-full">
        <x-marketplace::shop.form.control-group.label class="required">
            Departamento
        </x-marketplace::shop.form.control-group.label>

        <x-marketplace::shop.form.control-group.control
            type="select"
            name="state"
            v-model="departamento"
            @change="updateCiudades"
            rules="required"
        >
            <option value="">Selecciona un departamento</option>
            <option v-for="(ciudades, nombre) in catalogo" :value="nombre">
                @{{ nombre }}
            </option>
        </x-marketplace::shop.form.control-group.control>


        <x-marketplace::shop.form.control-group.error control-name="state" />
    </x-marketplace::shop.form.control-group>
</div>
                    
<!-- Ciudad -->
<div class="flex gap-4 max-sm:flex-wrap">
    <x-marketplace::shop.form.control-group class="w-full">
        <x-marketplace::shop.form.control-group.label class="required">
            Ciudad
        </x-marketplace::shop.form.control-group.label>

        <x-marketplace::shop.form.control-group.control
            type="select"
            name="city"
            v-model="ciudadSeleccionada"
            @change="updateDane"
            rules="required"
        >
            <option value="">Selecciona una ciudad</option>
            <option
                v-for="ciudad in ciudades"
                :value="ciudad.name"
                :key="ciudad.dane"
            >
                @{{ ciudad.name }}
            </option>
        </x-marketplace::shop.form.control-group.control>

        <x-marketplace::shop.form.control-group.error control-name="city" />
    </x-marketplace::shop.form.control-group>
</div>

                    {!! view_render_event('marketplace.seller.account.profile.edit.city_fields.after', ['seller' => $seller]) !!}


<!-- Addresses -->
                    <x-marketplace::shop.form.control-group.label class="required">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.shop.address')
                    </x-marketplace::shop.form.control-group.label>

                    @php $addresses = explode(PHP_EOL, $seller->address); @endphp

                    @for ($i = 0; $i < (core()->getConfigData('marketplace.settings.general.street_lines') ?? 1); $i++)
                        <x-marketplace::shop.form.control-group>
                            <x-marketplace::shop.form.control-group.control
                                type="text"
                                name="address[{{ $i }}]"
                                :value="old('address.{{ $i }}') ?: $addresses[$i] ?? ''"
                                
                                :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.street-address')"
                                :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.street-address')"
                            />
                            <x-marketplace::shop.form.control-group.error control-name="address[{{ $i }}]" />
                        </x-marketplace::shop.form.control-group>
                    @endfor

                    {!! view_render_event('marketplace.seller.account.profile.edit.address_fields.after', ['seller' => $seller]) !!}

<!-- Postcode -->                        
                    <div class="flex gap-4 max-sm:flex-wrap">
                        <x-marketplace::shop.form.control-group class="w-full">
                            <x-marketplace::shop.form.control-group.label class="required">
                                @lang('marketplace::app.shop.sellers.account.manage-profile.shop.postcode')
                            </x-marketplace::shop.form.control-group.label>

                            <x-marketplace::shop.form.control-group.control
                            type="text"
                            name="postcode"
                            v-model="postcode"
                            rules="required"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.postcode')"
                            :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.postcode')"
                            readonly
                        	/>

                                  <p class="text-sm text-gray-500 mt-1">
            Para calcular el costo de los envíos se asume que todos serán realizados desde la zona representada por este código DANE.</p>
                            <x-marketplace::shop.form.control-group.error control-name="postcode" />
                        </x-marketplace::shop.form.control-group>
                    </div>

                    {!! view_render_event('marketplace.seller.account.profile.edit.postcode_fields.after', ['seller' => $seller]) !!}
                    


                </div>

                {!! view_render_event('marketplace.seller.account.profile.edit.address_container.after', ['seller' => $seller]) !!}
                
                <!-- Social Links -->
                <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">

                    <h3 class="mb-6 text-xl font-medium leading-8 text-navyBlue">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.profile.social-link-title')
                    </h3>

                    @php
                        $socialLinks = ['facebook', 'twitter', 'pinterest', 'linkedin', 'instagram', 'tiktok']
                    @endphp
                    
                    {!! view_render_event('marketplace.seller.account.profile.edit.social_link_fields.before', ['seller' => $seller]) !!}
                    
                    @foreach($socialLinks as $socialLink)
                        <x-marketplace::shop.form.control-group>
                            <x-marketplace::shop.form.control-group.label @class(['required' => $socialLink === 'instagram'])>
                                @lang('marketplace::app.shop.sellers.account.manage-profile.profile.social-links', ['name' => Str::title($socialLink)])
                            </x-marketplace::shop.form.control-group.label>

                            <x-marketplace::shop.form.control-group.control
                                type="text"
                                name="{{ $socialLink }}"
				:rules="$socialLink === 'instagram' ? 'required' : ''"
                                :value="old($socialLink) ?: $seller->$socialLink"
                                :label="trans('marketplace::app.shop.sellers.account.manage-profile.profile.social-links', ['name' => $socialLink])"
                                :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.profile.social-links', ['name' => $socialLink])"
                            />

                            <x-marketplace::shop.form.control-group.error control-name="{{ $socialLink }}" />
                        </x-marketplace::shop.form.control-group>
                    @endforeach

                    {!! view_render_event('marketplace.seller.account.profile.edit.social_link_fields.after', ['seller' => $seller]) !!}
                </div>

                {!! view_render_event('marketplace.seller.account.profile.edit.social_links_container.after', ['seller' => $seller]) !!}
                
                @if (core()->getConfigData('marketplace.settings.general.enable_minimum_order_amount'))
                    <!-- Minimum Order Amount -->
                    <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">
                        <h3 class="mb-6 text-xl font-medium leading-8 text-navyBlue">
                            @lang('marketplace::app.shop.sellers.account.manage-profile.minimum-order-amount.title')
                        </h3>

                        {!! view_render_event('marketplace.seller.account.profile.edit.min_order_amount_field.before', ['seller' => $seller]) !!}

                        <x-marketplace::shop.form.control-group>
                            <x-marketplace::shop.form.control-group.label>
                                @lang('marketplace::app.shop.sellers.account.manage-profile.minimum-order-amount.title')
                            </x-marketplace::shop.form.control-group.label>

                            <x-marketplace::shop.form.control-group.control
                                type="text"
                                name="min_order_amount"
                                :value="old('min_order_amount') ?: $seller->min_order_amount"
                                :label="trans('marketplace::app.shop.sellers.account.manage-profile.minimum-order-amount.title')"
                                :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.minimum-order-amount.title')"
                            />

                            <x-marketplace::shop.form.control-group.error control-name="min_order_amount" />
                        </x-marketplace::shop.form.control-group>

                        {!! view_render_event('marketplace.seller.account.profile.edit.min_order_amount_field.after', ['seller' => $seller]) !!}
                    </div>
                @endif

                {!! view_render_event('marketplace.seller.account.profile.edit.min_order_amount_container.after', ['seller' => $seller]) !!}

                <!-- Google Analytics Id -->
                <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">
                    <p class="mb-6 text-xl font-medium leading-8 text-navyBlue">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.google-analytics-id.title')
                    </p>

                    {!! view_render_event('marketplace.seller.account.profile.edit.google_analytics_id_field.before', ['seller' => $seller]) !!}

                    <x-marketplace::shop.form.control-group>
                        <x-marketplace::shop.form.control-group.label>
                            Ingresa tu ID de Google Analytics para obtener estadísticas
                        </x-marketplace::shop.form.control-group.label>

                        <x-marketplace::shop.form.control-group.control
                            type="text"
                            name="google_analytics_id"
                            :value="old('google_analytics_id') ?: $seller->google_analytics_id"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.google-analytics-id.title')"
                            :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.google-analytics-id.title')"
                        />

                        <x-marketplace::shop.form.control-group.error control-name="google_analytics_id" />
                    </x-marketplace::shop.form.control-group>
                    
                    {!! view_render_event('marketplace.seller.account.profile.edit.google_analytics_id_field.after', ['seller' => $seller]) !!}
                </div>

                {!! view_render_event('marketplace.seller.account.profile.edit.google_analytics_id_container.after', ['seller' => $seller]) !!}

                <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">
                        <v-toggle-switch
                            label="@lang('marketplace::app.shop.sellers.account.manage-profile.responsible-for-vat.title')"
                            name="responsible_for_vat"
                            :initial-value="{{ $seller->responsible_for_vat ?? 0 }}"
                        ></v-toggle-switch>
                    </div>

                    <div class="box-shadow rounded-xl border border-[#E9E9E9] bg-white p-5">
                        <v-toggle-switch
                            label="@lang('marketplace::app.shop.sellers.account.manage-profile.electronic-biller.title')"
                            name="electronic_biller"
                            :initial-value="{{ $seller->electronic_biller ?? 0 }}"
                        ></v-toggle-switch>
                    </div>
            </div>
        </div>

        {!! view_render_event('marketplace.seller.account.profile.edit.edit_form_controls.after', ['seller' => $seller]) !!}
    </x-marketplace::shop.form>

    {!! view_render_event('marketplace.seller.account.profile.edit.after', ['seller' => $seller]) !!}
    
    @pushOnce('scripts')
        <script type="text/x-template" id="v-seller-country-state-template">
            <!-- Country -->
            <div class="flex gap-4 max-sm:flex-wrap">
                <x-marketplace::shop.form.control-group class="w-full">
                    <x-marketplace::shop.form.control-group.label class="required">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.shop.country')
                    </x-marketplace::shop.form.control-group.label>

                    <x-marketplace::shop.form.control-group.control
                        type="select"
                        name="country"
                        rules="required"
                        ::value="country"
                        v-model="country"
                        :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.country')"
                    >
                        <option value="">
                            @lang('marketplace::app.shop.sellers.account.manage-profile.shop.select')
                        </option>

                        @foreach (core()->countries() as $country)
                            <option 
                                {{ $country->code === config('app.default_country') ? 'selected' : '' }}  
                                value="{{ $country->code }}"
                            >
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </x-marketplace::shop.form.control-group.control>

                    <x-marketplace::shop.form.control-group.error control-name="country" />
                </x-marketplace::shop.form.control-group>
            </div>

            {!! view_render_event('marketplace.seller.account.profile.edit.country_fields.after', ['seller' => $seller]) !!}

            <!-- State -->
            <div class="flex gap-4 max-sm:flex-wrap">
                <x-marketplace::shop.form.control-group class="w-full">
                    <x-marketplace::shop.form.control-group.label class="required">
                        @lang('marketplace::app.shop.sellers.account.manage-profile.shop.state')
                    </x-marketplace::shop.form.control-group.label>

                    <template v-if="currentCountryStates?.length">
                        <x-marketplace::shop.form.control-group.control
                            type="select"
                            name="state"
                            rules="required"
                            ::value="state"
                            :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.state')"
                        >
                            <option 
                                v-for='state in currentCountryStates'
                                :value="state.code"
                                v-text="state.default_name"
                            >
                            </option>
                        </x-marketplace::shop.form.control-group.control>
                    </template>

                    <template v-else>
                        <x-marketplace::shop.form.control-group.control
                            type="text"
                            name="state"
                            ::value="state"
                            rules="required"
                            :label="trans('marketplace::app.shop.sellers.account.manage-profile.shop.state')"
                            :placeholder="trans('marketplace::app.shop.sellers.account.manage-profile.shop.state')"
                        />
                    </template>

                    <x-marketplace::shop.form.control-group.error control-name="state" />
                </x-marketplace::shop.form.control-group>
            </div>

            {!! view_render_event('marketplace.seller.account.profile.edit.state_fields.after', ['seller' => $seller]) !!}
        </script>

        <script type="module">
            app.component('v-seller-country-state', {
                template: '#v-seller-country-state-template',

                data() {
                    return {
                        country: @json(old('country') ?: $seller->country),

                        state: @json(old('state') ?: $seller->state),

                        currentCountryStates: [],
                        
                        allCountryStates: @json(core()->groupedStatesByCountries()),
                    }
                },

                mounted() {
                    this.updateStates();
                },

                watch: {
                    country(newVal, oldVal) {
                        this.currentCountryStates = this.allCountryStates[newVal];
                    }
                },

                methods: {
                    updateStates() {
                        this.currentCountryStates = this.allCountryStates[this.country];
                    },
                }
            })
        </script>

        <script type="text/x-template" id="v-seller-banner-logo-template">
            <!-- Banner -->
            <div class="relative mb-7 mt-8 h-[250px] md:h-[306px]">
                <img
                    class="h-[250px] w-full object-cover md:h-[306px] md:rounded-lg"
                    :src="images.banner_url ? images.banner_url : default_images.banner"
                    alt="Seller banner"
                    width="1140"
                    height="306"
                >

                <div class="absolute right-0 top-8 -translate-x-2.5 -translate-y-3.5 transform">
                    <x-shop::dropdown>
                        <x-slot:toggle>
                            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-[#FFFFFF] bg-opacity-50">
                                <span class="icon-more cursor-pointer text-2xl"></span>
                            </div>
                        </x-slot:toggle>

                        <x-slot:content class="!p-0">
                            <div class="grid max-h-[258px] w-[374px] max-w-[374px]">
                                <div class="border-b p-5">
                                    <div class="flex justify-between">
                                        <p class="text-2xl font-medium leading-9 text-[#151515]">
                                            @lang('marketplace::app.shop.sellers.account.manage-profile.profile.banner')
                                        </p>
                                        <span class="mp-cancel-icon cursor-pointer text-2xl"></span>
                                    </div>
    
                                    <p class="text-base font-normal leading-5">
                                        @lang('marketplace::app.shop.sellers.account.manage-profile.profile.banner-description')
                                    </p>
                                </div>

                                <div class="cursor-pointer px-5 hover:bg-gray-100">
                                    <label
                                        for="banner"
                                        class="flex items-center gap-4 py-5"
                                    >
                                        <span class="mp-upload-icon text-2xl"></span>

                                        <p class="text-lg font-medium text-[#3D2D2D]">
                                            @lang('marketplace::app.shop.sellers.account.manage-profile.profile.upload-new-banner')
                                        </p>
                                    </label>
                                </div>

                                <input
                                    type="hidden"
                                    name="banner[]"
                                    v-if="! uploadedFiles.bannerPicked"
                                />

                                <input
                                    type="file"
                                    class="hidden"
                                    id="banner"
                                    name="banner[]"
                                    accept="image/*"
                                    ref="banner"
                                    @change="setBanner()"
                                >

                                <div class="cursor-pointer px-5 hover:bg-gray-100">
                                    <button
                                        type="button"
                                        class="flex w-full items-center gap-4 py-5"
                                        :disabled="! hasBanner"
                                        @click="removeImage('banner')"
                                    >
                                        <span class="mp-delete-icon text-2xl"></span>

                                        <p class="text-lg font-medium text-[#3D2D2D]">
                                            @lang('marketplace::app.shop.sellers.account.manage-profile.profile.delete-banner')
                                        </p>
                                    </button>
                                </div>
                            </div>
                        </x-slot:content>
                    </x-shop::dropdown>
                </div>
            </div>

            <!-- Logo -->
            <div class="flex gap-2">
                <div class="relative max-h-20 min-w-20 max-w-20 rounded-xl border border-[#E9E9E9]">
                    <img
                        class="h-20 max-h-20 min-w-20 max-w-20 rounded-xl object-cover"
                        :src="images.logo_url ? images.logo_url : default_images.logo"
                        alt="seller logo"
                        width="80"
                        height="80"
                    >
                    
                    <div class="absolute left-[70px] top-[70px] -translate-x-4 -translate-y-5 transform">
                        <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'left' : 'right' }}">
                            <x-slot:toggle>
                                <div class="flex items-center justify-center rounded-full bg-[#FFFFFF] bg-opacity-50">
                                    <span class="icon-more cursor-pointer text-2xl"></span>
                                </div>
                            </x-slot:toggle>

                            <x-slot:content class="!p-0">
                                <div class="grid max-h-[258px] w-[300px] max-w-[300px]">
                                    <div class="border-b p-5">
                                        <div class="flex justify-between">
                                            <p class="text-2xl font-medium leading-9 text-[#151515]">
                                                @lang('marketplace::app.shop.sellers.account.manage-profile.profile.logo')
                                            </p>
                                            <span class="mp-cancel-icon cursor-pointer text-2xl"></span>
                                        </div>
        
                                        <p class="text-base font-normal leading-5">
                                            @lang('marketplace::app.shop.sellers.account.manage-profile.profile.logo-description')
                                        </p>
                                    </div>
    
                                    <div class="cursor-pointer px-5 hover:bg-gray-100">
                                        <label
                                            for="logo"
                                            class="flex items-center gap-4 py-5"
                                        >
                                            <span class="mp-upload-icon text-2xl"></span>
    
                                            <p class="text-lg font-medium text-[#3D2D2D]">
                                                @lang('marketplace::app.shop.sellers.account.manage-profile.profile.upload-new-logo')
                                            </p>
                                        </label>
                                    </div>
    
                                    <input
                                        type="hidden"
                                        name="logo[]"
                                        v-if="! uploadedFiles.logoPicked"
                                    />
    
                                    <input
                                        type="file"
                                        class="hidden"
                                        id="logo"
                                        name="logo[]"
                                        accept="image/*"
                                        ref="logo"
                                        @change="setLogo()"
                                    >
    
                                    <div class="cursor-pointer px-5 hover:bg-gray-100">
                                        <button
                                            type="button"
                                            class="flex w-full items-center gap-4 py-5"
                                            :disabled="! hasLogo"
                                            @click="removeImage('logo')"
                                        >
                                            <span class="mp-delete-icon text-2xl"></span>
    
                                            <p class="text-lg font-medium text-[#3D2D2D]">
                                                @lang('marketplace::app.shop.sellers.account.manage-profile.profile.delete-logo')
                                            </p>
                                        </button>
                                    </div>
                                </div>
                            </x-slot:content>
                        </x-shop::dropdown>
                    </div>
                </div> 
                <div class="grid">
                    <h1 class="text-3xl font-medium leading-[48px]">
                        {{$seller->shop_title}}
                    </h1>

                    <h6 class="text-base font-medium leading-6 text-[#757575]">
                        {{ $seller->full_address }}
                    </h6>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-seller-banner-logo', {
                template: '#v-seller-banner-logo-template',

                data() {
                    return {
                        images: {
                            logo_url: @json($seller->logo_url),
                            banner_url: @json($seller->banner_url),
                        },

                        uploadedFiles: {
                            logoPicked: false,
                            bannerPicked: false,
                        },

                        default_images: {
                            banner: "{{bagisto_asset('images/default-banner.webp', 'marketplace')}}",
                            logo: "{{bagisto_asset('images/default-logo.webp', 'marketplace')}}",
                        },
                    }
                },

                computed: {
                    hasBanner() {
                        return this.images.banner_url;
                    },

                    hasLogo() {
                        return this.images.logo_url;
                    }
                },

                methods: {
                    setLogo() {
                        const file = this.$refs.logo.files[0];

                        let url = window.URL.createObjectURL(file);

                        this.images.logo_url = url;

                        this.uploadedFiles.logoPicked = true;
                    },

                    setBanner() {
                        const file = this.$refs.banner.files[0];

                        let url = window.URL.createObjectURL(file);

                        this.images.banner_url = url;

                        this.uploadedFiles.bannerPicked = true;
                    },

                    removeImage(type) {
                        if (type == 'logo') {
                            this.images.logo_url = null;

                            this.$refs.logo.val = null;

                            this.uploadedFiles.logoPicked = true;
                        } else {
                            this.images.banner_url = null;

                            this.$refs.banner.val = null;

                            this.uploadedFiles.bannerPicked = true;
                        }
                    }
                }
            })
        </script>
      
<!-- Carga de Catalogo de Departamentos, Ciudades y C. DANE -->      
      <script type="module">
    app.mixin({
        data() {
            return {
                catalogo: {},
                departamento: '',
                ciudades: {},
                ciudadSeleccionada: '',
                codigoDane: '',
              	postcode: '', 
            };
        },

          mounted() {
              fetch('/data/departamentos_colombia.json')
                  .then(response => response.json())
                  .then(data => {
                      this.catalogo = data;

                      // Preseleccionar valores si ya hay datos guardados
                      this.departamento = @json($seller->state);
                      this.ciudades = this.catalogo[this.departamento] || [];
                      this.ciudadSeleccionada = @json($seller->city);

                      const ciudad = this.ciudades.find(c => c.name === this.ciudadSeleccionada);
                      this.codigoDane = ciudad ? ciudad.dane : '';

                      // <-- Esta parte asegura que se escriba en el campo del formulario
                      this.postcode = @json($seller->postcode) || this.codigoDane;
                  });
          },

        methods: {
            updateCiudades() {
                this.ciudades = this.catalogo[this.departamento] || {};
                this.ciudadSeleccionada = '';
                this.codigoDane = '';
            },
              updateDane() {
                  const ciudad = this.ciudades.find(c => c.name === this.ciudadSeleccionada);
                  this.codigoDane = ciudad ? ciudad.dane : '';

                  this.postcode = this.codigoDane;
              }
        }
    });
</script>
      
    <script type="text/x-template" id="v-toggle-switch-template">
        <div class="flex items-center justify-between">
            <label class="text-xl font-medium leading-8 text-navyBlue">
                @{{ label }}
            </label>
            <button
                type="button"
                @click="toggle"
                :class="[
                    'border-2 hover:border-gray-400 focus:border-gray-400 relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A259C4]',
                    isActive ? 'bg-[#B12C9E]' : 'bg-gray-300'
                ]"
            >
                <span
                    :class="[
                        'inline-block h-5 w-5 transform rounded-full bg-white shadow transition-transform',
                        isActive ? 'translate-x-5' : 'translate-x-0'
                    ]"
                ></span>
            </button>
            <input type="hidden" :name="name" :value="isActive ? 1 : 0">
        </div>
    </script>
    <script type="module">
        app.component('v-toggle-switch', {
            template: '#v-toggle-switch-template',

            props: {
                label: {
                    type: String,
                    required: true
                },
                name: {
                    type: String,
                    required: true
                },
                initialValue: {
                    type: [Boolean, Number, String],
                    default: false
                }
            },

            data() {
                return {
                    isActive: false
                }
            },

            mounted() {
                this.isActive = Boolean(Number(this.initialValue));
            },

            methods: {
                toggle() {
                    this.isActive = !this.isActive;
                }
            }
        });
    </script>
    <!-- Plantilla del componente -->
    <script type="text/x-template" id="v-file-upload-template">
        <input
            ref="fileInput"
            type="file"
            :name="name"
            :accept="acceptedTypes"
            :multiple="multiple"
            :value="value"
            class="block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:border-0
                file:text-sm file:font-semibold
                file:bg-gray-50 file:text-[#B12C9E]
                hover:file:bg-blue-100
                focus:outline-none focus:ring-2 focus:ring-gray-100"
        />
       <div
            v-if="currentFile"
            class="flex items-center gap-2 bg-gray-50 px-3 py-2 mb-3"
            style="margin-top: 4px;"
        >
           <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 16px;">
           <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
           <g id="SVGRepo_iconCarrier"> 
           <path d="M7 0H2V16H14V7H7V0Z" fill="#99a1af"></path> 
           <path d="M9 0V5H14L9 0Z" fill="#99a1af"></path> 
           </g></svg>
            <span class="text-sm text-gray-400 truncate max-w-xs">
                Archivo actual:
                <a
                    :href="fileUrl"
                    target="_blank"
                    class="underline"
                >
                    @{{ fileName }}
                </a>
            </span>
        </div>
    </script>

    <script type="module">
        app.component('v-file-upload', {
        template: '#v-file-upload-template',
        
        props: {
            acceptedTypes: {
            type: String,
            default: '*'
            },
            multiple: {
            type: Boolean,
            default: false
            },
            maxFileSize: {
            type: Number,
            default: 5 * 1024 * 1024 // 5MB por defecto
            },
            name: {
                type: String,
                default: 'file'
            },
            uploadUrl: {
            type: String,
            default: '/api/upload'
            },
            currentFile: {
                type: String,
                default: null
            }
        },

        data() {
            return {
            selectedFiles: [],
            loading: false,
            loadingMessage: 'Subiendo archivos...',
            message: '',
            error: ''
            };
        },

        computed: {
            fileUrl() {
                // Si currentFile es solo la ruta, ajústalo aquí
                if (typeof this.currentFile === 'string') {
                return '/storage/' + this.currentFile;
                }
                // Si es un objeto, ajústalo según tu estructura
                return this.currentFile.url || '';
            },
            fileName() {
                if (typeof this.currentFile === 'string') {
                return this.currentFile.split('/').pop();
                }
                return this.currentFile.name || '';
            }
        },
        methods: {
            handleFileChange(event) {
            const files = Array.from(event.target.files);
            this.clearMessages();
            
            // Validar archivos
            const validFiles = files.filter(file => this.validateFile(file));
            
            if (this.multiple) {
                this.selectedFiles = [...this.selectedFiles, ...validFiles];
            } else {
                this.selectedFiles = validFiles.slice(0, 1);
            }

            // Emitir evento con los archivos seleccionados
            this.$emit('files-selected', this.selectedFiles);
            },

            validateFile(file) {
            if (file.size > this.maxFileSize) {
                this.error = `El archivo ${file.name} excede el tamaño máximo permitido (${this.formatFileSize(this.maxFileSize)})`;
                return false;
            }
            return true;
            },

            removeFile(index) {
            this.selectedFiles.splice(index, 1);
            this.$emit('files-selected', this.selectedFiles);
            
            // Limpiar el input si no hay archivos
            if (this.selectedFiles.length === 0) {
                this.$refs.fileInput.value = '';
            }
            },

            async uploadFiles() {
            if (this.selectedFiles.length === 0) {
                this.error = 'Por favor selecciona al menos un archivo.';
                return;
            }

            this.loading = true;
            this.clearMessages();
            
            const formData = new FormData();
            
            if (this.multiple) {
                this.selectedFiles.forEach((file, index) => {
                formData.append(`files[${index}]`, file);
                });
            } else {
                formData.append('file', this.selectedFiles[0]);
            }

            try {
                const response = await axios.post(this.uploadUrl, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: (progressEvent) => {
                    const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    this.loadingMessage = `Subiendo archivos... ${percentCompleted}%`;
                }
                });

                this.message = 'Archivos subidos correctamente.';
                this.selectedFiles = [];
                this.$refs.fileInput.value = '';
                
                // Emitir evento de éxito
                this.$emit('upload-success', response.data);
                
            } catch (err) {
                this.error = err.response?.data?.message || 'Error al subir los archivos.';
                this.$emit('upload-error', err);
            } finally {
                this.loading = false;
                this.loadingMessage = 'Subiendo archivos...';
            }
            },

            formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            },

            clearMessages() {
            this.message = '';
            this.error = '';
            },

            // Método público para que el componente padre pueda triggear la subida
            triggerUpload() {
            this.uploadFiles();
            },

            // Método público para limpiar archivos
            clearFiles() {
            this.selectedFiles = [];
            this.$refs.fileInput.value = '';
            this.clearMessages();
            this.$emit('files-selected', []);
            }
        }
        });
    </script>
    @endPushOnce
</x-marketplace::shop.layouts>
