<!-- Estimate Tax and Shipping -->
{!! view_render_event('bagisto.shop.checkout.cart.summary.estimate_shipping.before') !!}

<x-shop::accordion
    class="overflow-hidden rounded-xl border max-md:rounded-lg max-md:!border-none max-md:!bg-gray-100"
    :is-active="false"
>
    <x-slot:header class="font-semibold max-md:py-3 max-md:font-medium max-sm:p-2 max-sm:text-sm">
        @lang('shop::app.checkout.cart.summary.estimate-shipping.title')
    </x-slot>

    <x-slot:content class="p-4 pt-0 max-md:rounded-t-none max-md:border max-md:border-t-0 max-md:pt-4">
        <v-estimate-tax-shipping
            :cart="cart"
            @processed="setCart"
        ></v-estimate-tax-shipping>
    </x-slot>
</x-shop::accordion>

{!! view_render_event('bagisto.shop.checkout.cart.summary.estimate_shipping.after') !!}

@pushOnce('scripts')
    <script type="text/x-template" id="v-estimate-tax-shipping-template">
        <!-- Destination Location Form -->
        <x-shop::form
            v-slot="{ meta, errors, handleSubmit }"
            as="div"
        >
            <form @change="handleSubmit($event, estimateShipping)">
                <p class="mb-4 max-sm:text-sm">
                    @lang('shop::app.checkout.cart.summary.estimate-shipping.info')
                </p>

                <!-- Country -->
                <x-shop::form.control-group class="!mb-2.5">
                    <x-shop::form.control-group.label class="required">
                        País
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="select"
                        name="country"
                        v-model="selectedCountry"
                        rules="required"
                        :label="'País'"
                        :placeholder="'País'"
                    >
                        <option value="">Seleccione un país</option>
                        <option value="CO">Colombia</option>
                    </x-shop::form.control-group.control>

                    <x-shop::form.control-group.error name="country" />
                </x-shop::form.control-group>

                <!-- State -->
                <x-shop::form.control-group>
                    <x-shop::form.control-group.label class="required">
                        Departamento
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="select"
                        name="state"
                        v-model="selectedDepartamento"
                        rules="required"
                        :label="'Departamento'"
                        :placeholder="'Departamento'"
                    >
                        <option value="">Seleccione un departamento</option>

                        <option
                            v-for="(ciudades, departamento) in departamentos"
                            :key="departamento"
                            :value="departamento"
                        >
                            @{{ departamento }}
                        </option>
                    </x-shop::form.control-group.control>

                    <x-shop::form.control-group.error name="state" />
                </x-shop::form.control-group>

                <!-- City -->
                <x-shop::form.control-group>
                    <x-shop::form.control-group.label class="required">
                        Ciudad
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="select"
                        name="city"
                        v-model="selectedCiudad"
                        rules="required"
                        :label="'Ciudad'"
                        :placeholder="'Ciudad'"
                    >
                        <option value="">Seleccione una ciudad</option>

                        <option
                            v-for="ciudad in ciudadesDisponibles"
                            :key="ciudad.dane"
                            :value="ciudad.name"
                        >
                            @{{ ciudad.name }}
                        </option>
                    </x-shop::form.control-group.control>

                    <x-shop::form.control-group.error name="city" />
                </x-shop::form.control-group>

                <!-- Postcode -->
                <x-shop::form.control-group class="!mb-0">
                    <x-shop::form.control-group.label class="required">
                        @lang('shop::app.checkout.cart.summary.estimate-shipping.postcode')
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="text"
                        name="postcode"
                        v-model="daneCode"
                        readonly
                        rules="required|postcode"
                        :label="trans('shop::app.checkout.cart.summary.estimate-shipping.postcode')"
                        :placeholder="trans('shop::app.checkout.cart.summary.estimate-shipping.postcode')"
                    />

                    <x-shop::form.control-group.error control-name="postcode" />
                </x-shop::form-control-group>

                <!-- Estimated Shipping Methods -->
                <div
                    class="mt-4 grid rounded-xl border border-zinc-200"
                    v-if="methods.length"
                >
                    <template v-for="method in methods">
                        {!! view_render_event('bagisto.shop.checkout.onepage.shipping.before') !!}

                        <div
                            class="relative select-none border-b border-zinc-200 last:border-b-0 max-md:max-w-full max-md:flex-auto"
                            v-for="rate in method.rates"
                        >
                            <div class="absolute top-5 ltr:left-4 rtl:right-4">
                                <x-shop::form.control-group.control
                                    type="radio"
                                    name="shipping_method"
                                    ::for="rate.method"
                                    ::id="rate.method"
                                    ::value="rate.method"
                                    ::label="rate.method"
                                />
                            </div>

                            <label 
                                class="block cursor-pointer p-4 pl-12"
                                :for="rate.method"
                            >
                                <p class="text-2xl font-semibold max-md:text-lg">
                                    @{{ rate.base_formatted_price }}
                                </p>

                                <p class="mt-2.5 text-xs font-medium max-md:mt-0">
                                    <span class="font-medium">@{{ rate.method_title }}</span> - @{{ rate.method_description }}
                                </p>
                            </label>
                        </div>

                        {!! view_render_event('bagisto.shop.checkout.onepage.shipping.after') !!}
                    </template>
                </div>
            </form>                    
        </x-shop::form>
    </script>

    <script type="module">
        app.component('v-estimate-tax-shipping', {
            template: '#v-estimate-tax-shipping-template',

            props: ['cart'],

            data() {
                return {
                    selectedCountry: 'CO',
                    selectedDepartamento: '',
                    selectedCiudad: '',
                    daneCode: '',
                    departamentos: {},
                    ciudadesDisponibles: [],
                    methods: [],
                    isStoring: false,
                };
            },

            watch: {
                selectedDepartamento(nuevoDepartamento) {
                    this.selectedCiudad = '';
                    this.daneCode = '';

                    if (nuevoDepartamento && this.departamentos[nuevoDepartamento]) {
                        this.ciudadesDisponibles = this.departamentos[nuevoDepartamento];
                    } else {
                        this.ciudadesDisponibles = [];
                    }
                },

                selectedCiudad(nuevaCiudad) {
                    if (this.selectedDepartamento && nuevaCiudad) {
                        const ciudad = this.departamentos[this.selectedDepartamento]?.find(ci => ci.name === nuevaCiudad);
                        this.daneCode = ciudad?.dane || '';
                    } else {
                        this.daneCode = '';
                    }
                }
            },

            mounted() {
                fetch('/data/departamentos_colombia.json')
                    .then(response => response.json())
                    .then(data => {
                        this.departamentos = data;
                    });
            },

            methods: {
                estimateShipping(params, { setErrors }) {
                    this.isStoring = true;

                    Object.keys(params).forEach(key => params[key] == null && delete params[key]);

                    this.$axios.post('{{ route('shop.api.checkout.cart.estimate_shipping') }}', params)
                        .then((response) => {
                            this.isStoring = false;

                            this.methods = response.data.data.shipping_methods;

                            this.$emit('processed', response.data.data.cart);
                        })
                        .catch(error => {
                            this.isStoring = false;

                            if (error.response.status == 422) {
                                setErrors(error.response.data.errors);
                            }
                        });
                },
            },
        });
    </script>
@endPushOnce